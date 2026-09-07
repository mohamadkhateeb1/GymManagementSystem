<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

/**
 * توجيه ما بعد تحدي المصادقة الثنائية حسب الحارس الذي بدأ تسجيل الدخول.
 *
 * لا نستخدم redirect()->intended() هنا؛ فقد تكون الجلسة تحتوي على رابط
 * /dashboard الخاص باللاعبين قبل بدء تسجيل دخول الأدمن أو الموظف.
 */
class TwoFactorLoginResponse implements TwoFactorLoginResponseContract
{
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json('', 204);
        }

        $guard = $this->resolveGuard($request);

        return match ($guard) {
            'admin' => redirect()->route('admin.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }

    private function resolveGuard($request): string
    {
        // login.guard يُحفظ عند بدء تحدي 2FA، وهو المصدر الأوثق لأن
        // config('fortify.guard') قد يعود إلى web عند معالجة POST التحدي.
        $sessionGuard = $request->session()->get('login.guard');

        if (in_array($sessionGuard, ['admin', 'employee'], true)) {
            return $sessionGuard;
        }

        $configuredGuard = config('fortify.guard');

        if (in_array($configuredGuard, ['admin', 'employee'], true)) {
            return $configuredGuard;
        }

        // fallback للجلسات القديمة أو في حال تغيّر config أثناء الطلب.
        if (Auth::guard('admin')->check()) {
            return 'admin';
        }

        if (Auth::guard('employee')->check()) {
            return 'employee';
        }

        return 'web';
    }
}
