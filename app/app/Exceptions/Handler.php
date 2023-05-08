<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return $this->handleException($request, $exception);
    }

    public function handleException($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {
            return ApiResponse::errorResponse('The specified method for the request is invalid', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        if ($exception instanceof NotFoundHttpException) {
            return ApiResponse::errorResponse('The specified URL cannot be found', Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof RouteNotFoundException) {
            return ApiResponse::errorResponse('401 Unauthorized Error!', Response::HTTP_UNAUTHORIZED);
        }

        if ($exception instanceof HttpException) {
            return ApiResponse::errorResponse($exception->getMessage(), $exception->getStatusCode());
        }

        if ($exception instanceof ValidationException) {
            return ApiResponse::errorResponse($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($exception instanceof AuthenticationException) {
            return ApiResponse::errorResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
        return ApiResponse::errorResponse('Unexpected Exception. Try later ' . $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
