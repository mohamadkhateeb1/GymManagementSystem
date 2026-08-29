<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticatorController extends Controller
{
    /**
     * صفحة المصادقة الثنائية الخاصة بالموظف
     */
    public function index()
    {
        $user = Auth::guard('employee')->user();

        abort_unless($user, 403);

        return view('Employee.auth.two_factor_auth', compact('user'));
    }
}