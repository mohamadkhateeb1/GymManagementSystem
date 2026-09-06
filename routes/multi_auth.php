<?php

use App\Http\Controllers\Auth\MultiGuardAuthenticationController;
use App\Http\Controllers\Auth\MultiGuardTwoFactorController;
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


/*
|--------------------------------------------------------------------------
| 🆕 المصادقة الثنائية — روابط صريحة مستقلة لكل حارس
|--------------------------------------------------------------------------
| بديل مباشر عن روابط Fortify الداخلية (/user/two-factor-authentication)
| اللي ما بتعرف تحدد الحارس الصحيح إطلاقاً. الحارس هون محدَّد صراحة
| بكل Route، بلا أي تخمين أو اعتماد على الجلسة/الرابط.
|--------------------------------------------------------------------------
*/

Route::middleware('auth:admin')->group(function () {
    Route::post('/admin/2fa/enable', [MultiGuardTwoFactorController::class, 'enableAdmin'])
        ->name('admin.two-factor.enable');

    Route::post('/admin/2fa/confirm', [MultiGuardTwoFactorController::class, 'confirmAdmin'])
        ->name('admin.two-factor.confirm');

    Route::delete('/admin/2fa/disable', [MultiGuardTwoFactorController::class, 'disableAdmin'])
        ->name('admin.two-factor.disable');
});

Route::middleware('auth:employee')->group(function () {
    Route::post('/employee/2fa/enable', [MultiGuardTwoFactorController::class, 'enableEmployee'])
        ->name('employee.two-factor.enable');

    Route::post('/employee/2fa/confirm', [MultiGuardTwoFactorController::class, 'confirmEmployee'])
        ->name('employee.two-factor.confirm');

    Route::delete('/employee/2fa/disable', [MultiGuardTwoFactorController::class, 'disableEmployee'])
        ->name('employee.two-factor.disable');
});