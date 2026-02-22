<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Support\ApiResponse;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class PerfilCvController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/perfil/cv",
     *     summary="Obtener CV completo del usuario",
     *     tags={"Perfil - CV"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response=200, description="CV obtenido correctamente"),
     *     @OA\Response(response=401, description="No autenticado")
     * )
     */
    public function show()
    {
        $userId = auth()->id();

        $result = DB::select('CALL usp_perfil_cv_completo(?)', [$userId]);

        if (empty($result) || !$result[0]->success) {
            return ApiResponse::error(
                $result[0]->message ?? 'Error al obtener CV.',
                'CV_ERROR',
                422
            );
        }

        return ApiResponse::success(
            json_decode($result[0]->data),
            'CV obtenido correctamente.',
            'CV_OBTAINED'
        );
    }
}