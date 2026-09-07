<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
class TwoFactorAuthenticatedResponse implements TwoFactorLoginResponseContract{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $user = $request->user();

        // 1. في حال كنت تستخدم Guards منفصلة:
        if (auth('admin')->check()) {
            return redirect()->intended('/admin/dashboard');
        }

        if (auth('employee')->check()) {
            return redirect()->intended('/employee/dashboard');
        }

        if ($user && isset($user->role)) {
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            if ($user->role === 'employee') {
                return redirect()->intended('/employee/dashboard');
            }
        }

        // المسار الافتراضي للاعبين / باقي المستخدمين
        return redirect()->intended('/dashboard');
    }
}