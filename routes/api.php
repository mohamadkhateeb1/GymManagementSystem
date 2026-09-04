<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\WorkoutController;
use App\Http\Controllers\Api\DietController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);
Route::get('/media/{path}', function (string $path) {
    $fullPath = storage_path('app/public/' . $path);

    if (! file_exists($fullPath)) {
        abort(404);
    }

    return response()->file($fullPath, [
        'Access-Control-Allow-Origin' => '*',
    ]);
})->where('path', '.*');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subscription', [SubscriptionController::class, 'show']);
    Route::get('/workouts', [WorkoutController::class, 'index']);
    Route::get('/diet', [DietController::class, 'index']);
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn']);

    // 👤 الملف الشخصي للاعب
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::put('/profile/password', [ProfileController::class, 'updatePassword']);

    // 🔔 إشعارات اللاعب (اقتراب/انتهاء الاشتراك)
    // 🔔 إشعارات اللاعب — تُرسَل وتُحذف من الجدول فوراً بمجرد استلامها
    Route::get('/notifications', [NotificationController::class, 'index']);
});
