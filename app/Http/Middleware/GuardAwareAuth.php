<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuardAwareAuth
{
    public function handle(Request $request, Closure $next, ?string $guard = null): Response
    {
        $resolvedGuard = $this->resolveGuard($request);

        Auth::shouldUse($resolvedGuard);

        config()->set('fortify.guard', $resolvedGuard);

        if (!Auth::guard($resolvedGuard)->check()) {
            return redirect()->route($this->loginRoute($resolvedGuard));
        }

        return $next($request);
    }

    private function resolveGuard(Request $request): string
    {
        if ($request->is('admin/*') || $request->is('admin')) {
            return 'admin';
        }

        if ($request->is('employee/*') || $request->is('employee')) {
            return 'employee';
        }

        if (
            $request->is('user/*') ||
            $request->is('user') ||
            $request->is('two-factor-challenge') ||
            $request->is('passkeys/*')
        ) {
            $sessionGuard = $request->session()->get('login.guard');

            if (in_array($sessionGuard, ['admin', 'employee'], true)) {
                return $sessionGuard;
            }
        }

        return 'web';
    }

    private function loginRoute(string $guard): string
    {
        return match ($guard) {
            'admin' => 'admin.login',
            'employee' => 'employee.login',
            default => 'login',
        };
    }
}