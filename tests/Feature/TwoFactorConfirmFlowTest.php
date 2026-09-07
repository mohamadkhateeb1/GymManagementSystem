<?php

use App\Models\Admin;
use PragmaRX\Google2FA\Google2FA;

it('completes the full enable -> confirm -> activated flow', function () {
    $admin = Admin::create([
        'name' => 'Flow', 'email' => 'flow@test.com',
        'password' => bcrypt('password'), 'super_admin' => true,
    ]);

    // 1) تفعيل (يولّد السر)
    $this->actingAs($admin, 'admin')
        ->withSession(['_previous' => ['url' => 'http://localhost/admin/dashboard']])
        ->post('/admin/2fa/enable')
        ->assertRedirect(route('admin.2fa'));

    $admin->refresh();
    expect($admin->two_factor_secret)->not->toBeNull();
    expect($admin->two_factor_confirmed_at)->toBeNull(); // لسا مش مؤكّد

    // 2) توليد رمز TOTP صحيح من السر
    $secret = decrypt($admin->two_factor_secret);
    $code   = app(Google2FA::class)->getCurrentOtp($secret);

    // 3) تأكيد بالرمز الصحيح
    $this->actingAs($admin, 'admin')
        ->withSession(['_previous' => ['url' => 'http://localhost/admin/dashboard']])
        ->post('/admin/2fa/confirm', ['code' => $code])
        ->assertRedirect(route('admin.2fa'))
        ->assertSessionHas('status', 'two-factor-authentication-confirmed');

    // 4) صارت مفعّلة ومؤكّدة فعلاً
    $admin->refresh();
    expect($admin->two_factor_confirmed_at)->not->toBeNull();

    // 5) الصفحة الآن تعرض حالة "مفعّلة" + زر الإلغاء
    $html = $this->actingAs($admin, 'admin')->get('/admin/2fa')->getContent();
    expect(str_contains($html, '/admin/2fa/disable'))->toBeTrue();
    expect(str_contains($html, '/admin/2fa/confirm'))->toBeFalse(); // ما عاد يعرض خطوة التأكيد
});

it('rejects a wrong confirm code and stays on the 2fa page', function () {
    $admin = Admin::create([
        'name' => 'Flow2', 'email' => 'flow2@test.com',
        'password' => bcrypt('password'), 'super_admin' => true,
    ]);

    $this->actingAs($admin, 'admin')->post('/admin/2fa/enable');

    $this->actingAs($admin, 'admin')
        ->from(route('admin.2fa'))
        ->post('/admin/2fa/confirm', ['code' => '000000'])
        ->assertRedirect(route('admin.2fa'))
        ->assertSessionHasErrors('code');

    expect($admin->fresh()->two_factor_confirmed_at)->toBeNull();
});