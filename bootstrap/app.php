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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
        // a) Jika didaftarkan sebagai Alias / Route Middleware:
        'checkrole' => \App\Http\Middleware\CheckRole::class,
        'admin' => \App\Http\Middleware\Admin::class,
        ]);
        // b) Jika ingin dijadikan Global Middleware (aktif di semua request):
        // $middleware->append(\App\Http\Middleware\Admin::class);

        // c) Jika ingin dimasukkan ke Middleware Group (contoh: group web):
        // $middleware->appendToGroup('web', [
        //     \App\Http\Middleware\Admin::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
