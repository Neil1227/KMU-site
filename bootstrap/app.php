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
        // Register global middleware here
        $middleware->append([
            \App\Http\Middleware\TrackPageViews::class,
        ]);

        // Optional: keep aliases for named routes
        $middleware->alias([
            'admin.auth' => \App\Http\Middleware\AdminAuth::class,
            'admin.guest' => \App\Http\Middleware\AdminGuest::class,
        ]);
    })


    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
