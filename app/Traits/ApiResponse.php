<?php

namespace App\Traits;

use App\Enums\HttpStatusCode;

trait ApiResponse
{
    /**
     * success
     *
     * @param  mixed  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'statusText' => 'successful',
            'statusCode' => HttpStatusCode::SUCCESSFUL,
            'data' => $body,
        ], HttpStatusCode::SUCCESSFUL->value);
    }

    /**
     * forbidden
     *
     * @param  mixed  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function forbidden($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'statusText' => 'forbidden',
            'statusCode' => HttpStatusCode::FORBIDDEN,
            'data' => $body,
        ], HttpStatusCode::FORBIDDEN->value);
    }

    /**
     * notFound
     *
     * @param  array|null  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'stausText' => 'Resource Not Found',
            'statusCode' => HttpStatusCode::NOT_FOUND,
            'data' => $body,
        ], HttpStatusCode::NOT_FOUND->value);
    }

    /**
     * badRequest
     *
     * @param  array|null  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function badRequest($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'stausText' => 'Bad Request',
            'statusCode' => HttpStatusCode::BAD_REQUEST,
            'data' => $body,
        ], HttpStatusCode::BAD_REQUEST->value);
    }

    /**
     * created
     *
     * @param  mixed  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function created($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'stausText' => 'Resource Created',
            'statusCode' => HttpStatusCode::CREATED,
            'data' => $body,
        ], HttpStatusCode::CREATED->value);
    }

    /**
     * Server Error
     *
     * @param  array|null  $body
     * @return \Illuminate\Http\JsonResponse
     */
    public function serverError($body = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'stausText' => 'Server Error',
            'statusCode' => HttpStatusCode::SERVER_ERROR,
            'data' => $body,
        ], HttpStatusCode::SERVER_ERROR->value);
    }

    /**
     * Custom Error
     *
     * @param  string  $type
     * @param  int  $statusCode
     * @param  string|null  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function customError($type, int $statusCode, $message = null): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'error_type' => $type,
            'message' => $message,
        ], $statusCode);
    }
}