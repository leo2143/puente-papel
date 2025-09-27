<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Registrar middleware para autenticación web
        $middleware->alias([
            'web.auth' => \App\Http\Middleware\WebAuth::class,
        ]);
        
        // Aplicar middleware WebAuth a todas las rutas web
        $middleware->web(append: [
            \App\Http\Middleware\WebAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();