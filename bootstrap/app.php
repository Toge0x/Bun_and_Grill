<?php
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AdminOnly;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web:      __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health:   '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'auth'       => Authenticate::class,
            'admin.only' => AdminOnly::class,
        ]);
       
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
