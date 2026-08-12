<?php

use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\PlayerMonitorController;
use App\Http\Controllers\Employee\TrainingPlanController;
use App\Http\Controllers\Employee\DietPlanController;
use App\Http\Controllers\Employee\PlanController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:employee')->group(function () {

    // ==========================================
    // 1. لوحة التحكم الرئيسية للمدرب (Dashboard) والـ Toggle
    // ==========================================
    Route::get('employee/dashboard', [DashboardController::class, 'index'])->name('employee.dashboard');

    // 🎯 المسار التفاعلي الجديد للبصمة (حضور / انصراف) عند المدرب
    Route::post('employee/attendance/toggle', [DashboardController::class, 'toggleAttendance'])->name('employee.dashboard.attendance.toggle');


    // ==========================================
    // 2. مراقبة اللاعبين والأتمتة الحية للمستويات
    // ==========================================
    Route::get('employee/monitoring', [PlayerMonitorController::class, 'index'])->name('employee.monitoring');
    Route::get('employee/monitoring/{id}', [PlayerMonitorController::class, 'show'])->name('employee.monitoring.show');
    Route::post('employee/monitoring/{playerId}/assign-level', [PlayerMonitorController::class, 'assignLevel'])->name('employee.monitoring.assign-level');


    // ==========================================
    // 3. الإضافات الحصرية (المخصصة للاعب معين مباشرة من ملفه)
    // ==========================================
    Route::post('employee/monitoring/{playerId}/custom-training', [PlayerMonitorController::class, 'storeCustomTraining'])->name('employee.monitoring.custom-training');
    Route::post('employee/monitoring/{playerId}/custom-diet', [PlayerMonitorController::class, 'storeCustomDiet'])->name('employee.monitoring.custom-diet');
    Route::post('employee/monitoring/{playerId}/rate', [PlayerMonitorController::class, 'storeRating'])->name('employee.monitoring.store-rating');
    Route::post('employee/monitoring/{playerId}/custom-progress', [PlayerMonitorController::class, 'storeCustomProgress'])->name('employee.monitoring.custom-progress');


    // ==========================================
    // 4. بنك الخطط التدريبية العامة (مستوى مخصص لكل خطة)
    // ==========================================
    Route::get('employee/training-bank', [TrainingPlanController::class, 'index'])->name('employee.training.bank');
    Route::post('employee/training-bank/store', [TrainingPlanController::class, 'store'])->name('employee.training.bank.store');
    Route::delete('employee/training-bank/{id}', [TrainingPlanController::class, 'destroy'])->name('employee.training.bank.destroy');
    Route::get('employee/training-bank/{id}', [TrainingPlanController::class, 'show'])->name('employee.training.bank.show');


    // ==========================================
    // 5. بنك الوجبات والخطط الغذائية العامة (مستوى مخصص لكل وجبة)
    // ==========================================
    Route::get('employee/diet-bank', [DietPlanController::class, 'index'])->name('employee.diet.bank');
    Route::post('employee/diet-bank/store', [DietPlanController::class, 'store'])->name('employee.diet.bank.store');
    Route::delete('employee/diet-bank/{id}', [DietPlanController::class, 'destroy'])->name('employee.diet.bank.destroy');


    // ==========================================
    // 6. إدارة التمارين داخل كل خطة تدريبية
    // ==========================================
    Route::prefix('training-bank')->group(function () {
        Route::get('/{planId}/exercises', [PlanController::class, 'index'])->name('employee.training.exercises.index');
        Route::post('/{planId}/exercises', [PlanController::class, 'store'])->name('employee.training.exercises.store');
        Route::delete('/exercises/{id}', [PlanController::class, 'destroy'])->name('employee.training.exercises.destroy');
        // ==========================================
        // 7. مكتبة التمارين العامة (للاطلاع على التمارين فقط، بدون تعديل)
        // ==========================================
        Route::prefix('exercise-library')->group(function () {
            Route::get('/', [PlanController::class, 'library'])->name('employee.exercise.library');
            Route::get('/{id}', [PlanController::class, 'showExercise'])->name('employee.exercise.show');
        });
    });
});
