<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $guard = config('fortify.guard');

        if ($guard === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($guard === 'employee') {
            return redirect()->route('employee.dashboard');
        }

        return redirect()->route('dashboard');
    }
}