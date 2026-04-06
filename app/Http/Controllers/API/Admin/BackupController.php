<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class BackupController extends Controller
{
    // private $path = 'backups';

    public function index()
    {
        $path = storage_path('app/backups');

        // Si no existe la carpeta
        if (!File::exists($path)) {
            return response()->json([
                'success' => true,
                'data' => []
            ]);
        }

        $files = File::files($path);

        $data = collect($files)
            ->sortByDesc(fn($file) => $file->getMTime())
            ->values() // resetear índices
            ->map(function ($file) {
                return [
                    'nombre' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'fecha' => $file->getMTime() * 1000,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function create()
    {
        $filename = 'backup_' . now()->format('Ymd_His') . '.sql';

        $path = storage_path("app/backups/$filename");

        // Ajusta credenciales
        $mysqldump = '"C:\\xampp\\mysql\\bin\\mysqldump.exe"';

        $command = sprintf(
            '%s -u%s %s %s --routines --triggers --events --single-transaction --quick --lock-tables=false > "%s"',
            $mysqldump,
            env('DB_USERNAME'),
            env('DB_PASSWORD') ? '-p' . env('DB_PASSWORD') : '',
            env('DB_DATABASE'),
            $path
        );

        exec($command);

        return response()->json([
            'message' => 'Backup generado',
            'file' => $filename
        ]);
    }

    public function download($file)
    {
        $path = storage_path("app/backups/$file");

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }

    public function delete($file)
    {
        $path = storage_path("app/backups/$file");

        if (file_exists($path)) {
            unlink($path);
        }

        return response()->json([
            'message' => 'Backup eliminado'
        ]);
    }
}