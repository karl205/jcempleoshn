<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Services\AyudaService;
use App\Support\ApiResponse;
use App\Support\Bitacora;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminAyudaController extends Controller
{
    protected $service;

    public function __construct(AyudaService $service)
    {
        $this->service = $service;
    }

    /*
    |--------------------------------------------------------------------------
    | Consumo (cualquier usuario logueado en el admin, sin permiso especial)
    |--------------------------------------------------------------------------
    */

    // GET /admin/ayuda-items/consulta
    public function consulta()
    {
        $data = $this->service->listarActivosPorSeccion('admin');

        return ApiResponse::success(
            $data,
            'Listado de ayuda administrativa',
            'AYUDA_ADMIN_LIST'
        );
    }

    // GET /admin/ayuda-items/{id}/consulta/ver
    public function verConsulta($id)
    {
        $item = $this->service->obtenerActivoPorSeccion($id, 'admin');

        if (!$item) {
            abort(404);
        }

        return $this->servirArchivo($item, inline: true);
    }

    // GET /admin/ayuda-items/{id}/consulta/descargar
    public function descargarConsulta($id)
    {
        $item = $this->service->obtenerActivoPorSeccion($id, 'admin');

        if (!$item) {
            abort(404);
        }

        return $this->servirArchivo($item, inline: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Gestión (requiere permiso ayuda.gestionar)
    |--------------------------------------------------------------------------
    */

    // GET /admin/ayuda-items
    public function index()
    {
        $data = $this->service->listarTodos();

        return ApiResponse::success(
            $data,
            'Listado de ayuda',
            'AYUDA_LIST'
        );
    }

    // POST /admin/ayuda-items
    public function store(Request $request)
    {
        $request->validate([
            'seccion'     => 'required|in:publico,admin',
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'orden'       => 'nullable|integer',
            'archivo'     => 'required|file|mimes:pdf|max:10240', // 10MB
        ]);

        $nombreArchivo = $this->guardarArchivo($request->file('archivo'));

        $id = $this->service->crear([
            'seccion'     => $request->seccion,
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden'       => $request->orden ?? 0,
            'archivo'     => $nombreArchivo,
        ]);

        Bitacora::registrar(
            'ayuda_items',
            'crear',
            'Creó el documento de ayuda "' . $request->titulo . '" (' . $request->seccion . ')'
        );

        return ApiResponse::success(
            ['id' => $id],
            'Documento de ayuda creado correctamente',
            'AYUDA_CREATED'
        );
    }

    // PUT /admin/ayuda-items/{id}
    public function update(Request $request, $id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            return ApiResponse::error('Documento no encontrado', 'AYUDA_NOT_FOUND', 404);
        }

        $request->validate([
            'seccion'     => 'required|in:publico,admin',
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'orden'       => 'nullable|integer',
            'archivo'     => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'seccion'     => $request->seccion,
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'orden'       => $request->orden ?? 0,
        ];

        // Si suben un PDF nuevo, reemplaza el archivo físico anterior
        if ($request->hasFile('archivo')) {
            $data['archivo'] = $this->guardarArchivo($request->file('archivo'));
            $this->borrarArchivoFisico($item->archivo);
        }

        $this->service->actualizar($id, $data);

        Bitacora::registrar(
            'ayuda_items',
            'actualizar',
            'Actualizó el documento de ayuda ID ' . $id . ' "' . $request->titulo . '"'
        );

        return ApiResponse::success(
            null,
            'Documento de ayuda actualizado correctamente',
            'AYUDA_UPDATED'
        );
    }

    // PATCH /admin/ayuda-items/{id}/desactivar
    public function desactivar($id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            return ApiResponse::error('Documento no encontrado', 'AYUDA_NOT_FOUND', 404);
        }

        $this->service->desactivar($id);

        Bitacora::registrar(
            'ayuda_items',
            'desactivar',
            'Desactivó el documento de ayuda "' . $item->titulo . '"'
        );

        return ApiResponse::success(null, 'Documento desactivado correctamente', 'AYUDA_DEACTIVATED');
    }

    // PATCH /admin/ayuda-items/{id}/activar
    public function activar($id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            return ApiResponse::error('Documento no encontrado', 'AYUDA_NOT_FOUND', 404);
        }

        $this->service->activar($id);

        Bitacora::registrar(
            'ayuda_items',
            'activar',
            'Activó el documento de ayuda "' . $item->titulo . '"'
        );

        return ApiResponse::success(null, 'Documento activado correctamente', 'AYUDA_ACTIVATED');
    }

    // DELETE /admin/ayuda-items/{id}
    public function destroy($id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            return ApiResponse::error('Documento no encontrado', 'AYUDA_NOT_FOUND', 404);
        }

        $this->borrarArchivoFisico($item->archivo);
        $this->service->eliminar($id);

        Bitacora::registrar(
            'ayuda_items',
            'eliminar',
            'Eliminó el documento de ayuda "' . $item->titulo . '"'
        );

        return ApiResponse::success(null, 'Documento eliminado correctamente', 'AYUDA_DELETED');
    }

    // GET /admin/ayuda-items/{id}/ver  (gestión: cualquier item, sin importar sección/estado)
    public function ver($id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            abort(404);
        }

        return $this->servirArchivo($item, inline: true);
    }

    // GET /admin/ayuda-items/{id}/descargar
    public function descargar($id)
    {
        $item = $this->service->obtener($id);

        if (!$item) {
            abort(404);
        }

        return $this->servirArchivo($item, inline: false);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers de archivo
    |--------------------------------------------------------------------------
    */

    private function guardarArchivo($archivo): string
    {
        $carpeta = storage_path('app/ayuda');

        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        $nombre = Str::random(30) . '.pdf';
        $archivo->move($carpeta, $nombre);

        return $nombre;
    }

    private function borrarArchivoFisico(?string $nombreArchivo): void
    {
        if (!$nombreArchivo) {
            return;
        }

        $path = storage_path("app/ayuda/{$nombreArchivo}");

        if (file_exists($path)) {
            unlink($path);
        }
    }

    private function servirArchivo($item, bool $inline)
    {
        $path = storage_path("app/ayuda/{$item->archivo}");

        if (!file_exists($path)) {
            abort(404);
        }

        return $inline
            ? response()->file($path)
            : response()->download($path, $item->titulo . '.pdf');
    }
}