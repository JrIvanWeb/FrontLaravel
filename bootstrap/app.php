<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserHasRole;
use App\Exceptions\ApiException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withCommands([
        __DIR__.'/../app/Console/Commands',
    ])
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api(prepend: [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request, Throwable $exception): bool =>
                $request->is('api/*') || $request->expectsJson()
        );

        $exceptions->render(function (Throwable $exception, Request $request) {
            if (!$request->is('api/*') && !$request->expectsJson()) {
                return null;
            }

            $status = 500;
            $payload = [
                'success' => false,
                'code' => 'INTERNAL_ERROR',
                'message' => 'Ocurrió un error inesperado.',
                'errors' => (object) [],
            ];

            if ($exception instanceof ValidationException) {
                $status = 422;
                $payload['code'] = 'VALIDATION_ERROR';
                $payload['message'] = 'Los datos enviados no son válidos.';
                $payload['errors'] = $exception->errors();
            } elseif ($exception instanceof AuthenticationException) {
                $status = 401;
                $payload['code'] = 'AUTHENTICATION_REQUIRED';
                $payload['message'] = 'Debes iniciar sesión para realizar esta acción.';
            } elseif ($exception instanceof AuthorizationException) {
                $status = 403;
                $payload['code'] = 'FORBIDDEN';
                $payload['message'] = 'No tienes permiso para realizar esta acción.';
            } elseif ($exception instanceof ApiException) {
                $status = $exception->status;
                $payload['code'] = $exception->errorCode;
                $payload['message'] = $exception->getMessage();
                $payload['errors'] = $exception->errors ?: (object) [];
            } elseif ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException) {
                $status = 404;
                $payload['code'] = 'NOT_FOUND';
                $payload['message'] = 'No se encontró el recurso solicitado.';
            } elseif ($exception instanceof QueryException) {
                $sqlState = $exception->errorInfo[0] ?? null;

                if (in_array($sqlState, ['23000', '23505'], true)) {
                    $status = 409;
                    $payload['code'] = 'DATA_CONFLICT';
                    $payload['message'] = 'El registro entra en conflicto con datos existentes o relaciones.';
                }

                if (config('app.debug')) {
                    $payload['debug'] = [
                        'exception' => $exception::class,
                        'sql_state' => $sqlState,
                    ];
                }
            } elseif ($exception instanceof HttpExceptionInterface) {
                $status = $exception->getStatusCode();
                $payload['code'] = 'HTTP_ERROR';
                $payload['message'] = match ($status) {
                    400 => 'La solicitud no es válida.',
                    405 => 'El método HTTP no está permitido para este recurso.',
                    408 => 'La solicitud tardó demasiado en completarse.',
                    413 => 'El contenido enviado supera el tamaño permitido.',
                    415 => 'El formato enviado no es compatible.',
                    429 => 'Se realizaron demasiadas solicitudes. Inténtalo más tarde.',
                    default => 'No se pudo procesar la solicitud.',
                };
            }

            if ($status >= 500 && config('app.debug') && !($exception instanceof QueryException)) {
                $payload['debug'] = [
                    'exception' => $exception::class,
                    'detail' => $exception->getMessage(),
                ];
            }

            return response()->json($payload, $status);
        });
    })->create();
