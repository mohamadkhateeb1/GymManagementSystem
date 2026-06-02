<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    
    // dashboard
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');
    })->name('admin.dashboard');

    // roles
    Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.delete');

    // admins
    Route::resource('admins', AdminController::class)->names([
        'index' => 'admins.index',
        'create' => 'admins.create',
        'store' => 'admins.store',
        'edit' => 'admins.edit',
        'update' => 'admins.update',
        'destroy' => 'admins.destroy',
    ]);
    // employees
    Route::resource('employees', EmployeeController::class)->names([
        'index' => 'employees.index',
        'create' => 'employees.create',
        'store' => 'employees.store',
        'edit' => 'employees.edit',
        'update' => 'employees.update',
        'destroy' => 'employees.destroy',
    ]);
    // players
    Route::resource('players', PlayerController::class)->names([
        'index' => 'players.index',
        'create' => 'players.create',
        'store' => 'players.store',
        'edit' => 'players.edit',
        'update' => 'players.update',
        'destroy' => 'players.destroy',
    ]);
});