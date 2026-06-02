<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TowFactorAuthenticatorController;
use App\Http\Controllers\TowFactorAuthenticatorControllerAdmins;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// داش بورد للاعبين
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 2fa employee
Route::get('admin/2fa', [TowFactorAuthenticatorController::class, 'index'])->name('admin.2fa');
Route::get('employee/2fa', [TowFactorAuthenticatorController::class, 'index'])->name('employee.2fa');

require __DIR__.'/admin.php';
require __DIR__.'/employee.php';