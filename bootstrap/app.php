<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'modul'          => \App\Http\Middleware\CheckModul::class,
            'role'           => \App\Http\Middleware\CheckRole::class,
            'hero_carousel'  => \App\Http\Middleware\CheckHeroCarousel::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            '/sitemap.xml',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
