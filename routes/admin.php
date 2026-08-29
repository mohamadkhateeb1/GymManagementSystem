<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminEmployeeAttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PlanTypeController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\PlayerAttendanceController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubscriptionsController;
use App\Http\Controllers\Admin\FinancialReportController;
use App\Http\Controllers\Admin\FinancialArchiveController;
use App\Http\Controllers\Admin\TwoFactorAuthenticatorController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
    ->middleware(['auth:admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Two Factor Authentication
        |--------------------------------------------------------------------------
        */

        Route::get('/2fa', [TwoFactorAuthenticatorController::class, 'index'])
            ->name('admin.2fa');


        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        Route::delete('/roles/destroy-all', [RoleController::class, 'destroy_all'])
            ->name('admin.roles.destroy_all');

        Route::resource('roles', RoleController::class)->names([
            'index' => 'admin.roles',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.delete',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Admins
        |--------------------------------------------------------------------------
        */

        Route::resource('admins', AdminController::class)->names([
            'index' => 'admins.index',
            'create' => 'admins.create',
            'store' => 'admins.store',
            'edit' => 'admins.edit',
            'update' => 'admins.update',
            'destroy' => 'admins.destroy',
            'show' => 'admins.show',
        ]);

        Route::delete('/admin/destroy-all', [AdminController::class, 'destroy_all'])
            ->name('admins.destroy_all');


        /*
        |--------------------------------------------------------------------------
        | Employees
        |--------------------------------------------------------------------------
        */

        Route::resource('employees', EmployeeController::class)->names([
            'index' => 'employees.index',
            'create' => 'employees.create',
            'store' => 'employees.store',
            'edit' => 'employees.edit',
            'update' => 'employees.update',
            'destroy' => 'employees.destroy',
            'show' => 'employees.show',
        ]);

        Route::delete('/employee/destroy-all', [EmployeeController::class, 'destroy_all'])
            ->name('employees.destroy_all');


        /*
        |--------------------------------------------------------------------------
        | Players
        |--------------------------------------------------------------------------
        */

        Route::resource('players', PlayerController::class)->names([
            'index' => 'players.index',
            'create' => 'players.create',
            'store' => 'players.store',
            'edit' => 'players.edit',
            'update' => 'players.update',
            'destroy' => 'players.destroy',
        ]);

        Route::delete('/player/destroy-all', [PlayerController::class, 'destroy_all'])
            ->name('players.destroyAll');

        Route::post(
            '/players/{player}/toggle-subscription',
            [SubscriptionsController::class, 'toggleByPlayer']
        )->name('players.toggle-subscription');


        /*
        |--------------------------------------------------------------------------
        | Subscriptions
        |--------------------------------------------------------------------------
        */

        Route::get('/subscriptions', [SubscriptionsController::class, 'index'])
            ->name('subscriptions.index');

        Route::post('/subscriptions/renew/{id}', [SubscriptionsController::class, 'renew'])
            ->name('subscriptions.renew');

        Route::post('/subscriptions/store', [SubscriptionsController::class, 'store'])
            ->name('subscriptions.store');

        Route::post('/subscriptions/{id}/toggle', [SubscriptionsController::class, 'toggleStatus'])
            ->name('admin.subscriptions.toggle');

        Route::post(
            '/subscriptions/{membership}/archive',
            [FinancialArchiveController::class, 'archiveMembership']
        )->name('admin.subscriptions.archive');


        /*
        |--------------------------------------------------------------------------
        | Plan Types
        |--------------------------------------------------------------------------
        */

        Route::prefix('plan-types')
            ->name('admin.plan-types.')
            ->group(function () {

                Route::get('/', [PlanTypeController::class, 'index'])
                    ->name('index');

                Route::post('/', [PlanTypeController::class, 'store'])
                    ->name('store');

                Route::put('/{planType}', [PlanTypeController::class, 'update'])
                    ->name('update');

                Route::post('/{planType}/toggle', [PlanTypeController::class, 'toggleActive'])
                    ->name('toggle');
            });


        /*
        |--------------------------------------------------------------------------
        | Financial Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/financial-reports',
            [FinancialReportController::class, 'index']
        )->name('admin.financial-reports.index');

        Route::post(
            '/financial-reports/{payment}/archive',
            [FinancialArchiveController::class, 'archivePayment']
        )->name('admin.financial-reports.archive');


        /*
        |--------------------------------------------------------------------------
        | Financial Archive
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/financial-archive',
            [FinancialArchiveController::class, 'index']
        )->name('admin.financial-archive.index');


        /*
        |--------------------------------------------------------------------------
        | Employee Attendance
        |--------------------------------------------------------------------------
        */

        Route::prefix('attendance/employees')
            ->name('admin.attendance.employees.')
            ->group(function () {

                Route::get('/', [AdminEmployeeAttendanceController::class, 'index'])
                    ->name('index');

                Route::post(
                    '/store',
                    [AdminEmployeeAttendanceController::class, 'storeManualAttendance']
                )->name('store');

                Route::put(
                    '/update/{id}',
                    [AdminEmployeeAttendanceController::class, 'updateAttendance']
                )->name('update');

                Route::delete(
                    '/destroy/{id}',
                    [AdminEmployeeAttendanceController::class, 'destroyAttendance']
                )->name('destroy');
            });


        /*
        |--------------------------------------------------------------------------
        | Player Attendance
        |--------------------------------------------------------------------------
        */

        Route::prefix('attendance/players')
            ->name('admin.attendance.players.')
            ->group(function () {

                Route::get('/', [PlayerAttendanceController::class, 'index'])
                    ->name('index');
            });
    });
