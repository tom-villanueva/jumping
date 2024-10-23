<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Log all exceptions to a file in storage/logs
    $exceptions->render(function (\Exception $e, Request $request) {
        // Log exception details to a file
        Log::channel('daily')->error($e->getMessage(), [
            'exception' => $e,
            'url' => $request->url(),
            'input' => $request->all()
        ]);

        // Handle specific exceptions
        if ($e instanceof NotFoundHttpException && $request->is('api/*')) {
            $id = $request->route('id');
            if ($id != null) {
                $type = explode('/', $request->path())[1];
                return response()->json([
                    'message' => 'No se encuentra el registro.',
                    'errors' => ["not found" => ["No se encuentra el registro en $type para el id $id"]]
                ], 404);
            } else {
                return response()->json([
                    'message' => 'No se encuentra la ruta.',
                    'errors' => ["not found" => ["No se encuentra la ruta."]]
                ], 404);
            }
        }

        // Return the default exception response for other exceptions
        return null;
    });
    })->create();
