<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetFortifyGuard
{
    public function handle(Request $request, Closure $next)
    {
        // إذا كان الأدمن مسجل دخوله، نجعل النظام و Fortify يعتمدانه كحارس افتراضي
        if (Auth::guard('admin')->check()) {
            Auth::shouldUse('admin');
            Config::set('fortify.guard', 'admin');
        } 
        // نفس الشيء للموظف
        elseif (Auth::guard('employee')->check()) {
            Auth::shouldUse('employee');
            Config::set('fortify.guard', 'employee');
        }

        return $next($request);
    }
}