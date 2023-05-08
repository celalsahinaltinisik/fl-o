<?php

namespace App\Helpers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ApiResponse
{
    /**
     * Summary of successResponse
     * @param mixed $data
     * @param mixed $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse(mixed $data, $message = null, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Summary of errorResponse
     * @param mixed $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($message = null, int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return response()->json([
            'status' => 'Error',
            'message' => $message,
            'user_message' => $message,
            'data' => null
        ], $code);
    }
}
