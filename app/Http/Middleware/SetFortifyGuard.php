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
        | خلال هالخطوة، المستخدم لسا مش مسجّل دخول فعلياً بأي حارس (2FA
        | معلّقة)، فما فيه فايدة نفحص auth()->guard(...)->check(). الاعتماد
        | الوحيد الموثوق هون: session('login.id') — المفتاح الرسمي اللي
        | فورتيفاي نفسها بتحطّه أثناء انتظار رمز الـ 2FA. نتأكد بأنفسنا
        | بأي جدول (admins أو employees) هالـ ID موجود فعلياً، بدل الاعتماد
        | على مفتاح جلسة مخصّص منا وحدنا قد يضيع بمرحلة وسيطة.
        |--------------------------------------------------------------------------
        */
        if ($request->is('two-factor-challenge')) {
            // Fortify يحفظ الحارس الذي بدأ تسجيل الدخول في الجلسة.
            // يجب إعطاء هذا المصدر الأولوية؛ الاعتماد على login.id وحده
            // قد يخلط بين Admin وEmployee إذا تساوت أرقام الـ IDs.
            $sessionGuard = $request->session()->get('login.guard');

            if (in_array($sessionGuard, ['admin', 'employee'], true)) {
                return $sessionGuard;
            }

            // fallback للتوافق مع الجلسات القديمة التي لا تحتوي login.guard.
            $loginId = $request->session()->get('login.id');

            if ($loginId && \App\Models\Admin::whereKey($loginId)->exists()) {
                return 'admin';
            }

            if ($loginId && \App\Models\Employee::whereKey($loginId)->exists()) {
                return 'employee';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 🆕 Fortify User Management Routes (تفعيل/تأكيد/إلغاء الـ 2FA، الباسكيز)
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