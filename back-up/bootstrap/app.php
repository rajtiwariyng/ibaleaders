<?php

use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\AdminGuestMiddleware;
use App\Http\Middleware\FrontendUserAuthMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
//use Spatie\Permission\Middlewares\Role;
//use Spatie\Permission\Middlewares\RoleMiddleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin_auth' => AdminAuthMiddleware::class,
            'admin_guest' => AdminGuestMiddleware::class,
            'user_auth' => FrontendUserAuthMiddleware::class,
            'redirectIfAuthenticated' => RedirectIfAuthenticated::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();