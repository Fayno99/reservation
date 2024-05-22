<?php

use App\Http\Middleware\IfNotAdmin;
use App\Http\Middleware\IfNotAssistant;
use App\Http\Middleware\IfNonManager;
use App\Http\Middleware\VerifyOrganizationToken;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.manager' => IfNonManager::class,
            'auth.assistant' => IfNotAssistant::class,
            'auth.admin' => IfNotAdmin::class,
            'verify.token' => VerifyOrganizationToken::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
