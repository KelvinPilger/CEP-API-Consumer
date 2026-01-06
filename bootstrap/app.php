<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ModelNotFoundException $e, Request $request) {
            return response()->json([
                'code' => Response::HTTP_NOT_FOUND,
                'success' => false,
                'message' => 'O registro informado não pode ser encontrado, ou foi excluído.',
            ], Response::HTTP_NOT_FOUND);

            return null;
        });

        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
                return response()->json([
                    'code' => Response::HTTP_NOT_FOUND,
                    'success' => false,
                    'message' => 'A rota ou recurso não foi encontrado.',
                ], Response::HTTP_NOT_FOUND);

            return null;
        });
    })->create();
