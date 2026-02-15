<?php

namespace App\Support;

class ApiResponse
{
    public static function success($data = null, string $message = 'OK', string $code = 'SUCCESS', int $status = 200)
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    public static function error(string $message, string $code = 'ERROR', int $status = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'message' => $message,
            'errors' => $errors
        ], $status);
    }
}
