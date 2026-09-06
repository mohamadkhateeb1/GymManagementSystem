<?php

use App\Http\Middleware\GuardAwareAuth;
use App\Http\Middleware\GuardAwareGuest;
use App\Http\Middleware\SetFortifyGuard;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest' => GuardAwareGuest::class,
            'guard.auth' => GuardAwareAuth::class,
        ]);

        $middleware->web(
            append: [
                SetFortifyGuard::class,
            ]
        );

        $middleware->redirectGuestsTo(function (Request $request) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return route('admin.login');
            }

            if ($request->is('employee/*') || $request->is('employee')) {
                return route('employee.login');
            }

            return route('login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    })
    ->create();