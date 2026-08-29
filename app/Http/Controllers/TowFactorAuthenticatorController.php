<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TowFactorAuthenticatorController extends Controller
{
    /**
     * 2FA الخاص بالأدمن
     */
    public function admin()
    {
        $user = Auth::guard('admin')->user();

        return view('auth.two_factor_auth', compact('user'));
    }

    /**
     * 2FA الخاص بالموظف
     */
    public function employee()
    {
        $user = Auth::guard('employee')->user();

        return view('auth.two_factor_auth', compact('user'));
    }
}