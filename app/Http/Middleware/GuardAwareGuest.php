<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 🛡️ نسخة "واعية بالمسار" من middleware الـ guest الافتراضي.
 *
 * المشكلة اللي بتحلّها: بمشروع متعدد الحرّاس (admin / employee / web)،
 * الـ guest الافتراضي بلارافيل بيفحص حارس واحد بس (الافتراضي: web).
 * فلو لاعب مسجّل دخول (حارس web) وحاول يفتح /admin/login، كان
 * الـ middleware القديم بيعتبره "مسجّل دخول أصلاً" ويطرده — رغم إنه
 * مش مسجّل دخول كأدمن إطلاقاً.
 *
 * هون، نحدد الحارس المطلوب فحصه بناءً على *مسار الطلب نفسه*، مش حارس
 * ثابت مُمرَّر كباراميتر، فكل صفحة دخول (admin/employee/web) تفحص
 * حارسها الخاص فقط، بشكل مستقل عن الحرّاس التانية تماماً.
 */
class GuardAwareGuest
{
    public function handle(Request $request, Closure $next)
    {
        $guard = $this->resolveGuardFromPath($request);

        if (Auth::guard($guard)->check()) {
            return redirect($this->homeFor($guard));
        }

        return $next($request);
    }

    private function resolveGuardFromPath(Request $request): string
    {
        if ($request->is('admin/*') || $request->is('admin')) {
            return 'admin';
        }

        if ($request->is('employee/*') || $request->is('employee')) {
            return 'employee';
        }

        return 'web';
    }

    private function homeFor(string $guard): string
    {
        return match ($guard) {
            'admin'    => '/admin/dashboard',
            'employee' => '/employee/dashboard',
            default    => '/home',
        };
    }
}