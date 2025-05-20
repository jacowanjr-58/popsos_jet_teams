<?php

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
// Global middleware
$middleware->append([

]);

// Named (alias) middleware
$middleware->alias([

'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
'auth.session' => \Laravel\Jetstream\Http\Middleware\AuthenticateSession::class,
'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,

// Spatie Permissions
'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
]);
})
->withExceptions(function (Exceptions $exceptions) {
// Custom exception handling can go here
})
->create();
