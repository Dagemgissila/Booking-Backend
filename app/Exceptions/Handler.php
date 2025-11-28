<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{


    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*') || $request->expectsJson()) {

            // Handle validation errors
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors'  => $exception->errors(), // detailed errors
                ], 422);
            }

            // Handle other exceptions
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage(),
            ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
        }

        return parent::render($request, $exception);
    }
}
