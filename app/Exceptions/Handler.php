<?php

namespace App\Exceptions;

use App\Base\Response\apiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use apiResponse;

    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    public function render($request, Throwable $e): Response
    {
        $response = null;

        if ($this->isApi($request)) {
            $response = $this->handleApiException($e);
        } elseif ($e instanceof AuthenticationException) {
            $response = $request->routeIs('admin.show.login')
                ? parent::render($request, $e)
                : redirect()->guest(route('admin.show.login'));
        } elseif ($this->isNotFoundLike($e)) {
            $response = response()->view('errors.not_found', [], 404);
        } elseif (!config('app.debug')) {
            logError($e);
            $response = response()->view('errors.not_found', [], 500);
        }

        return $response ?? parent::render($request, $e);
    }

    private function isApi(Request $request): bool
    {
        return $request->expectsJson() || $request->is('api/*');
    }

    private function isNotFoundLike(Throwable $e): bool
    {
        return $e instanceof ModelNotFoundException
            || $e instanceof NotFoundHttpException
            || $e instanceof MethodNotAllowedHttpException;
    }

    protected function handleApiException(Throwable $e): JsonResponse
    {
        $statusCode = match (true) {
            $e instanceof ModelNotFoundException => JsonResponse::HTTP_NOT_FOUND,
            $e instanceof NotFoundHttpException,
            $e instanceof MethodNotAllowedHttpException => JsonResponse::HTTP_NOT_FOUND,
            $e instanceof AuthenticationException       => JsonResponse::HTTP_UNAUTHORIZED,
            $e instanceof \Illuminate\Validation\ValidationException => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            default                                     => JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
        };

        $message = match (true) {
            $e instanceof ModelNotFoundException,
            $e instanceof NotFoundHttpException         => trans('api.notFound'),
            $e instanceof MethodNotAllowedHttpException => trans('api.notFound'),
            $e instanceof AuthenticationException       => trans('api.youAreNotAuthorized'),
            $e instanceof \Illuminate\Validation\ValidationException => $e->getMessage(),
            default => trans('api.somethingWentWrong'),
        };

        $errors = match (true) {
            $e instanceof ModelNotFoundException        => ['model' => $e->getMessage()],
            $e instanceof NotFoundHttpException         => ['http' => $e->getMessage()],
            $e instanceof MethodNotAllowedHttpException => ['http' => $e->getMessage()],
            $e instanceof AuthenticationException       => ['auth' => $e->getMessage()],
            $e instanceof \Illuminate\Validation\ValidationException => $e->errors(),
            default => config('app.debug') ? [
                'exception' => get_class($e),
                'message'   => $e->getMessage(),
                'file'      => $e->getFile(),
                'line'      => $e->getLine(),
            ] : [],
        };

        return $this->failed($message, $errors, $statusCode);
    }
}
