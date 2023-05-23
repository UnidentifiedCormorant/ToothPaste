<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $this->reportable(function (Throwable $e) {

        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (!$request->expectsJson()) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundException(
                $exception->getMessage(),
                $exception->getCode(),
                $exception
            );

            return new JsonResponse(
                $this->convertExceptionToArray($exception),
                404,
                $this->isHttpException($exception) ? $exception->getHeaders() : [],
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
            );
        }

        if ($exception instanceof AuthenticationException) {
            return \response(["message" => "Ошибка доступа. Авторизируйтесь"], 403);
        } else if ($exception instanceof ValidationException) {
            $messages = collect($exception->errors())->flatten();
            return \response([
                "message" => $messages->implode("<br />"),
                "messages" => $messages,
                "errors" => $exception->errors()
            ], 422);
        }
        $code = $exception->getCode();

        $render = parent::render($request, $exception);

        return $code >= 100 && $code < 600 ? $render->setStatusCode($code) : $render;
    }
}
