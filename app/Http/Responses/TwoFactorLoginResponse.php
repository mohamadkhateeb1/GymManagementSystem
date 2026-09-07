<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

/**
 * 🛡️ توجيه ما بعد تحدي المصادقة الثنائية — صريح حسب الحارس.
 *
 * السبب: نسخة Fortify الافتراضية بتستخدم redirect()->intended(...)، وهاد
 * بيتبع url.intended المخزّن بالجلسة (اللي بينحطّ لما زائر يفتح صفحة محمية
 * قبل تسجيل الدخول). النتيجة: الأدمن/الموظف بعد ما ينجح بالـ 2FA بينوجّه
 * لصفحة اللاعبين /dashboard الفاضية بدل لوحته الصحيحة.
 *
 * الحل: نفس منطق App\Http\Responses\LoginResponse بالضبط — توجيه صريح
 * حسب config('fortify.guard') (اللي بيضبطه SetFortifyGuard middleware).
 */
class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json('', 204);
        }

        // بعد نجاح التحدي قد تعود قيمة config إلى web، لذلك نعتمد
        // على الحارس الذي حُفظ عند بدء تحدي 2FA.
        $guard = $request->session()->get('login.guard')
            ?: config('fortify.guard');

        if ($guard === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($guard === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        return redirect()->route('dashboard');
    }
}