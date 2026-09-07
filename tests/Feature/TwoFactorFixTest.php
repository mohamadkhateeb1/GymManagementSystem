
<?php

use App\Models\Admin;
use App\Models\Employee;

it('enable now redirects to the admin 2fa page even without referer', function () {
    $admin = Admin::create([
        'name' => 'FixA', 'email' => 'fixa@test.com',
        'password' => bcrypt('password'), 'super_admin' => true,
    ]);

    $resp = $this->actingAs($admin, 'admin')
        ->withSession(['_previous' => ['url' => 'http://localhost/admin/dashboard']])
        ->post('/admin/2fa/enable'); // بلا referer

    $resp->assertRedirect(route('admin.2fa'));
    expect($admin->fresh()->two_factor_secret)->not->toBeNull();

    // الصفحة الآن تعرض QR + confirm
    $html = $this->actingAs($admin, 'admin')->get('/admin/2fa')->getContent();
    expect(str_contains($html, '/admin/2fa/confirm'))->toBeTrue();
});

it('employee enable redirects to the employee 2fa page without referer', function () {
    $emp = Employee::create([
        'name' => 'FixE', 'email' => 'fixe@test.com',
        'password' => bcrypt('password'), 'specialization' => 'Coach',
    ]);

    $resp = $this->actingAs($emp, 'employee')
        ->withSession(['_previous' => ['url' => 'http://localhost/employee/dashboard']])
        ->post('/employee/2fa/enable');

    $resp->assertRedirect(route('employee.2fa'));
    expect($emp->fresh()->two_factor_secret)->not->toBeNull();
});