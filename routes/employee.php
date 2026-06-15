<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\PlayerMonitorController;
use App\Http\Controllers\Employee\TrainingPlanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:employee')->group(function () {
    Route::get('employee/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');
    Route::get('employee/monitoring', [PlayerMonitorController::class, 'index'])->name('employee.monitoring');
    // Route::get('employee/training', [TrainingPlanController::class, 'index'])->name('employee.training');
    // Route::post('employee/training', [TrainingPlanController::class, 'store'])->name('employee.training.store');
    Route::get('employee/training/{playerId}', [PlayerMonitorController::class, 'addTrainingPlan'])->name('employee.training.create');
    Route::post('/player/{playerId}/store-plan', [PlayerMonitorController::class, 'storeTrainingPlan'])->name('employee.training.store');
    Route::get('employee/monitoring/{id}', [PlayerMonitorController::class, 'show'])->name('employee.monitoring.show');
    
});