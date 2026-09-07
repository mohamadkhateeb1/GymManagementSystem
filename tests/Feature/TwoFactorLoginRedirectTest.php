<?php

use App\Http\Responses\TwoFactorLoginResponse;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Http\Request;

it('redirects an admin to the admin dashboard after 2FA', function () {
    $admin = Admin::create([
        'name' => '2FA Admin',
        'email' => '2fa-admin@test.com',
        'password' => bcrypt('password'),
        'super_admin' => true,
    ]);

    $request = Request::create('/two-factor-challenge', 'POST');
    $request->setLaravelSession(app('session')->driver());
    $request->session()->put('login.guard', 'admin');

    $this->actingAs($admin, 'admin');

    expect(app(TwoFactorLoginResponse::class)->toResponse($request)->getTargetUrl())
        ->toBe(route('admin.dashboard'));
});

it('redirects an employee to the employee dashboard after 2FA', function () {
    $employee = Employee::create([
        'name' => '2FA Employee',
        'email' => '2fa-employee@test.com',
        'password' => bcrypt('password'),
        'specialization' => 'Coach',
    ]);

    $request = Request::create('/two-factor-challenge', 'POST');
    $request->setLaravelSession(app('session')->driver());
    $request->session()->put('login.guard', 'employee');

    $this->actingAs($employee, 'employee');

    expect(app(TwoFactorLoginResponse::class)->toResponse($request)->getTargetUrl())
        ->toBe(route('employee.dashboard'));
});
