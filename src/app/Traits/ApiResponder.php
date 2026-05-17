<?php

namespace App\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Throwable;

trait ApiResponder
{
    /**
     * Success response with pagination
     */
    protected function respondWithPagination(LengthAwarePaginator $paginator, array $extraData = []): JsonResponse
    {
        return response()->json(array_merge([
            'success' => true,
            'data' => $paginator->items(),
            'meta' => [
                'pagination' => [
                    'current_page' => $paginator->currentPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'last_page' => $paginator->lastPage(),
                    'from' => $paginator->firstItem(),
                    'to' => $paginator->lastItem(),
                    'has_more_pages' => $paginator->hasMorePages(),
                    'next_page_url' => $paginator->nextPageUrl(),
                    'previous_page_url' => $paginator->previousPageUrl(),
                ]
            ]
        ], $extraData));
    }

    /**
     * Success response with custom data (no pagination)
     */
    protected function respondSuccess($data = null, string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    /**
     * Error response with exception handling
     */
    protected function respondError(
        Throwable $e,
        ?string $customMessage = null,
        int $defaultStatus = 500,
        ?int $customStatus = null
    ): JsonResponse {
        $status = $customStatus ?? ($e->getCode() && is_int($e->getCode()) && $e->getCode() >= 100 && $e->getCode() < 600
            ? $e->getCode()
            : $defaultStatus);

        $message = $customMessage ?? $e->getMessage();

        // Log the exception if needed
        if ($this->shouldLogException($e)) {
            logger()->error($e->getMessage(), ['exception' => $e]);
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => config('app.debug') ? [
                'type' => get_class($e),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ] : null,
        ], $status);
    }

    /**
     * Validation error response
     */
    protected function respondValidationError($errors, string $message = 'Validation failed', int $status = 422): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }

    /**
     * Not found response
     */
    protected function respondNotFound(string $message = 'Resource not found'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], 404);
    }

    /**
     * Unauthorized response
     */
    protected function respondUnauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], 401);
    }

    /**
     * Forbidden response
     */
    protected function respondForbidden(string $message = 'Forbidden'): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], 403);
    }

    /**
     * Execute a callable and handle exceptions automatically
     */
    protected function safeCall(callable $callback, ?string $errorMessage = null, int $defaultStatus = 500)
    {
        try {
            return $callback();
        } catch (Throwable $e) {
            return $this->respondError($e, $errorMessage, $defaultStatus);
        }
    }

    /**
     * Determine if exception should be logged
     */
    protected function shouldLogException(Throwable $e): bool
    {
        // Don't log validation exceptions or common client errors
        $skipLogging = method_exists($e, 'getStatusCode') && in_array($e->getStatusCode(), [400, 401, 403, 404, 422]);
        return !$skipLogging;
    }
}
