<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuardAwareGuest
{
    public function handle(Request $request, Closure $next): Response
    {
        $guard = $this->resolveGuard($request);

        if (Auth::guard($guard)->check()) {
            return redirect()->route($this->dashboardRoute($guard));
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

        return 'web';
    }

    private function dashboardRoute(string $guard): string
    {
        return match ($guard) {
            'admin' => 'admin.dashboard',
            'employee' => 'employee.dashboard',
            default => 'dashboard',
        };
    }
}