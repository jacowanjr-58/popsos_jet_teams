<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/* use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\EventController; */
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Controllers\FranchiseController;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum', config('jetstream.auth_session'), 'verified', EnsureUserHasRole::class,
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),])->group(function () {
    Route::get('/dashboard', function () {return Inertia::render('Dashboard'); })->name('dashboard');
    Route::get('/request-role', [RoleRequestController::class, 'create'])->name('role.request');
    Route::post('/request-role', [RoleRequestController::class, 'store'])->name('role.request.store');
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::middleware('permission:role.approve')->group(function () {
        Route::get('/role-requests', [\App\Http\Controllers\RoleRequestController::class, 'index'])->name('role-request.index');
        Route::post('/role-requests/{roleRequest}/approve', [\App\Http\Controllers\RoleRequestController::class, 'approve'])->name('role-request.approve');
        Route::post('/role-requests/{roleRequest}/reject', [\App\Http\Controllers\RoleRequestController::class, 'reject'])->name('role-request.reject');


        Route::get('/permissions/assign/{user}', [PermissionController::class, 'edit'])->middleware('can:assign permissions')->name('permissions.assign');
        Route::post('/permissions/assign/{user}', [PermissionController::class, 'update'])->middleware('can:assign permissions');


    });



        Route::middleware(['auth', 'can:add-franchise'])->group(function () {
            Route::resource('franchise', FranchiseController::class);
        });

   /*  Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard'); */

    // Inventory Routes
   /*  Route::middleware('permission:view inventory')->group(function () {
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    }); */

   /*  Route::middleware('permission:order pops')->group(function () {
        Route::get('/inventory/order', [InventoryController::class, 'order'])->name('inventory.order');
    }); */

    // Events Routes
   /*  Route::middleware('permission:add events')->group(function () {
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    }); */

    // Role Approval Routes
    /* Route::middleware('permission:approve roles')->group(function () {
        Route::get('/role-requests', [RoleRequestController::class, 'index'])->name('role-request.index');
        Route::post('/role-requests/{id}/approve', [RoleRequestController::class, 'approve'])->name('role-request.approve');
        Route::post('/role-requests/{id}/reject', [RoleRequestController::class, 'reject'])->name('role-request.reject');
    }); */

});
