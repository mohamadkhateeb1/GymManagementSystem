<?php

namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable as FortifyRedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Events\TwoFactorAuthenticationChallenged;

class RedirectIfTwoFactorAuthenticatable extends FortifyRedirectIfTwoFactorAuthenticatable
{
    protected function twoFactorChallengeResponse($request, $user)
    {
        $guard = config('fortify.guard');

        // حفظ الـ guard حتى نعرف لاحقاً هل التحدي Admin أو Employee
        $request->session()->put([
            'login.id' => $user->getKey(),
            'login.remember' => $request->boolean('remember'),
            'login.guard' => $guard,
        ]);

        TwoFactorAuthenticationChallenged::dispatch($user);

        if ($request->wantsJson()) {
            return response()->json([
                'two_factor' => true,
            ]);
        }

        if ($guard === 'admin') {
            return redirect()->route('admin.two-factor.challenge');
        }

        if ($guard === 'employee') {
            return redirect()->route('employee.two-factor.challenge');
        }

        return redirect()->route('two-factor.login');
    }
}