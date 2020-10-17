<?php


namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable; // <-- ADD THIS
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception) // <-- USE Throwable HERE
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception) // AND HERE
    {
        if ($exception instanceof \DomainException && $request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], Response::HTTP_BAD_REQUEST);
        }
        return parent::render($request, $exception);
    }
}