<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetFortifyGuard
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $this->resolveGuard($request);

        config()->set('fortify.guard', $guard);

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

        return 'web';
    }
}