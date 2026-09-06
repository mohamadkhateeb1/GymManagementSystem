<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StaticPagesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StaticPagesController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [StaticPagesController::class, 'playerDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/*
|--------------------------------------------------------------------------
| General Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});




require __DIR__ . '/admin.php';




require __DIR__ . '/employee.php';

require __DIR__ . '/multi_auth.php';