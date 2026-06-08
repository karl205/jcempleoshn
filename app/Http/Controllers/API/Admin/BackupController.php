<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Support\Bitacora;
use Illuminate\Support\Facades\File;

class BackupController extends Controller
{
    public function index()
    {
        $path = storage_path('app/backups');

        if (!File::exists($path)) {
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }

        $files = File::files($path);

        $data = collect($files)
            ->sortByDesc(fn($file) => $file->getMTime())
            ->values()
            ->map(function ($file) {
                return [
                    'nombre' => $file->getFilename(),
                    'size'   => $file->getSize(),
                    'fecha'  => $file->getMTime() * 1000,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

   public function create()
{
    $filename  = 'backup_' . now()->format('Ymd_His') . '.sql';
    $path      = storage_path("app/backups/$filename");
    $errorPath = storage_path("app/backups/error.log");

    if (!file_exists(storage_path('app/backups'))) {
        mkdir(storage_path('app/backups'), 0777, true);
    }

    $mysqldump = 'C:\\xampp\\mysql\\bin\\mysqldump.exe';

    $command = '"' . $mysqldump . '" -hlocalhost -uroot jcempleoshn --routines --triggers --events --single-transaction --quick --lock-tables=false > "' . $path . '" 2>"' . $errorPath . '"';

    exec($command, $output, $returnCode);

    $errorMsg = file_exists($errorPath) ? file_get_contents($errorPath) : 'sin detalle';

    if ($returnCode !== 0 || !file_exists($path) || filesize($path) === 0) {
        return response()->json([
            'success' => false,
            'message' => 'Error al generar backup',
            'detalle' => $errorMsg,
            'codigo'  => $returnCode
        ], 500);
    }

    if (file_exists($errorPath)) {
        unlink($errorPath);
    }

    Bitacora::registrar(
        'backups',
        'crear',
        'Generó backup de la base de datos: "' . $filename . '"'
    );

    return response()->json([
        'message' => 'Backup generado',
        'file'    => $filename
    ]);
}
    public function download($file)
    {
        $path = storage_path("app/backups/$file");

        if (!file_exists($path)) {
            abort(404);
        }

        Bitacora::registrar(
            'backups',
            'descargar',
            'Descargó el backup "' . $file . '"'
        );

        return response()->download($path);
    }

    public function delete($file)
    {
        $path = storage_path("app/backups/$file");

        if (file_exists($path)) {
            unlink($path);
        }

        Bitacora::registrar(
            'backups',
            'eliminar',
            'Eliminó el backup "' . $file . '"'
        );

        return response()->json([
            'message' => 'Backup eliminado'
        ]);
    }
}