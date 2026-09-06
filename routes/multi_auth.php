<?php

use App\Http\Controllers\Auth\MultiGuardAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get(
        '/admin/login',
        [MultiGuardAuthenticationController::class, 'adminLogin']
    )->name('admin.login');

    Route::post(
        '/admin/login',
        [MultiGuardAuthenticationController::class, 'authenticateAdmin']
    )->name('admin.login.store');

    Route::get(
        '/employee/login',
        [MultiGuardAuthenticationController::class, 'employeeLogin']
    )->name('employee.login');

    Route::post(
        '/employee/login',
        [MultiGuardAuthenticationController::class, 'authenticateEmployee']
    )->name('employee.login.store');
});

Route::post(
    '/admin/logout',
    [MultiGuardAuthenticationController::class, 'adminLogout']
)->middleware('auth:admin')->name('admin.logout');

Route::post(
    '/employee/logout',
    [MultiGuardAuthenticationController::class, 'employeeLogout']
)->middleware('auth:employee')->name('employee.logout');