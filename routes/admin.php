<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionsController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth:admin'])->group(function () {

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // roles
    Route::delete('/roles/destroy-all', [RoleController::class, 'destroy_all'])->name('admin.roles.destroy_all');
    Route::resource('roles', RoleController::class)->names([
        'index' => 'admin.roles',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.delete',
    ]);


    // admins
    Route::resource('admins', AdminController::class)->names([
        'index' => 'admins.index',
        'create' => 'admins.create',
        'store' => 'admins.store',
        'edit' => 'admins.edit',
        'update' => 'admins.update',
        'destroy' => 'admins.destroy',
        'show' => 'admins.show',

    ]);
    Route::delete('/admin/destroy-all', [AdminController::class, 'destroy_all'])->name('admins.destroy_all');

    // employees
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index',
        'create' => 'employees.create',
        'store' => 'employees.store',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy',
        'show' => 'employees.show',
    ]);
    Route::delete('/employee/destroy-all', [EmployeeController::class, 'destroy_all'])->name('employees.destroy_all');

    // players
    Route::resource('players', PlayerController::class)->names([
        'index' => 'players.index',
        'create' => 'players.create',
        'store' => 'players.store',
        'edit' => 'players.edit',
        'update' => 'players.update',
        'destroy' => 'players.destroy',
    ]);
    // subscriptions
    Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('admin.subscriptions.index');
});
