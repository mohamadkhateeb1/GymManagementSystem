<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\PlayerMonitorController;
use App\Http\Controllers\Employee\TrainingPlanController;
use App\Http\Controllers\Employee\DietPlanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:employee')->group(function () {
    // لوحة التحكم الرئيسية
    Route::get('employee/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    // مراقبة اللاعبين والتحكم الفردي وتطبيق الأتمتة الفورية
    Route::get('employee/monitoring', [PlayerMonitorController::class, 'index'])->name('employee.monitoring');
    Route::get('employee/monitoring/{id}', [PlayerMonitorController::class, 'show'])->name('employee.monitoring.show');
    Route::post('employee/monitoring/{playerId}/assign-level', [PlayerMonitorController::class, 'assignLevel'])->name('employee.monitoring.assign-level');

    // بنك الخطط التدريبية (مستوى مخصص لكل خطة داخل القسم)
    Route::get('employee/training-bank', [TrainingPlanController::class, 'index'])->name('employee.training.bank');
    Route::post('employee/training-bank/store', [TrainingPlanController::class, 'store'])->name('employee.training.bank.store');
    Route::delete('employee/training-bank/{id}', [TrainingPlanController::class, 'destroy'])->name('employee.training.bank.destroy');

    // بنك الوجبات والخطط الغذائية (مستوى مخصص لكل وجبة داخل القسم)
    Route::get('employee/diet-bank', [DietPlanController::class, 'index'])->name('employee.diet.bank');
    Route::post('employee/diet-bank/store', [DietPlanController::class, 'store'])->name('employee.diet.bank.store');
    Route::delete('employee/diet-bank/{id}', [DietPlanController::class, 'destroy'])->name('employee.diet.bank.destroy');
});
