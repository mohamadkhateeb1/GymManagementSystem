<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetFortifyGuard
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $this->resolveGuard($request);

        config()->set('fortify.guard', $guard);

        // 🛡️ حاسم: config('fortify.guard') بيأثر بس على منطق Fortify الداخلي.
        // بس أي middleware عام زي 'auth' (بلا تحديد حارس صريح) بيفحص
        // "الحارس الافتراضي" لكامل الطلب — وهاد بيتحدد فقط عبر Auth::shouldUse().
        // بدونها، صفحات زي تفعيل/تأكيد الـ 2FA (Fortify's /user/* routes)
        // كانت بتعتبر الأدمن/الموظف "غير مسجّل دخول" وتطردهم لصفحة اللاعب.
        Auth::shouldUse($guard);

        if ($guard === 'admin') {
            config()->set('fortify.passwords', 'admins');
            config()->set('fortify.home', '/admin/dashboard');
        } elseif ($guard === 'employee') {
            config()->set('fortify.passwords', 'employees');
            config()->set('fortify.home', '/employee/dashboard');
        } else {
            config()->set('fortify.passwords', 'players');
            config()->set('fortify.home', '/home');
        }

        return $next($request);
    }

    private function resolveGuard(Request $request): string
    {
        /*
        |--------------------------------------------------------------------------
        | Admin routes
        |--------------------------------------------------------------------------
        */
        if ($request->is('admin/*') || $request->is('admin')) {
            return 'admin';
        }

        /*
        |--------------------------------------------------------------------------
        | Employee routes
        |--------------------------------------------------------------------------
        */
        if ($request->is('employee/*') || $request->is('employee')) {
            return 'employee';
        }

        /*
        |--------------------------------------------------------------------------
        | Fortify Two Factor Challenge
        |--------------------------------------------------------------------------
        */
        if ($request->is('two-factor-challenge')) {

            // إذا كان الموظف مسجل دخول فعلياً
            if (auth()->guard('employee')->check()) {
                return 'employee';
            }

            // إذا كان الأدمن مسجل دخول فعلياً
            if (auth()->guard('admin')->check()) {
                return 'admin';
            }

            // fallback للجلسة
            $sessionGuard = $request->session()->get('login.guard');

            if (in_array($sessionGuard, ['admin', 'employee'], true)) {
                return $sessionGuard;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 🆕 Fortify User Management Routes (تفعيل/تأكيد/إلغاء الـ 2FA، الباسكيز)
        | هاي مسارات Fortify الداخلية (مثل /user/two-factor-authentication)
        | وما إلها بادئة admin/employee إطلاقاً — لازم نتعرّف على الحارس
        | عبر التحقق من مين مسجّل دخول فعلياً بالحظة الحالية.
        |--------------------------------------------------------------------------
        */
        if ($request->is('user/*') || $request->is('user') || $request->is('passkeys/*')) {

            if (auth()->guard('admin')->check()) {
                return 'admin';
            }

            if (auth()->guard('employee')->check()) {
                return 'employee';
            }

            $sessionGuard = $request->session()->get('login.guard');

            if (in_array($sessionGuard, ['admin', 'employee'], true)) {
                return $sessionGuard;
            }
        }

        return 'web';
    }
}