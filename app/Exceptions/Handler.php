<?php

namespace App\Exceptions;

use App\Events\GateFailed;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (ValidationException $e) {
            return $this->getValidationException($e);
        });

        $this->renderable(function (ThrottleRequestsException $e) {
            return $this->getThrottleRequestException($e);
        });

        $this->renderable(function (Throwable $e) {
            return $this->getFailedOperationException($e);
        });
    }

    private function getValidationException(ValidationException $e): JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'errors' => $e->validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function getFailedOperationException(\Throwable $e): JsonResponse
    {
        return response()->json([
            'message' => trans('exception.technical_operation_exception'),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    private function getThrottleRequestException(ThrottleRequestsException $e): JsonResponse
    {
        GateFailed::dispatch();

        return response()->json(null, Response::HTTP_TOO_MANY_REQUESTS, $e->getHeaders());
    }
}
