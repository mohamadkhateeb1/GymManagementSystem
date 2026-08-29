<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TwoFactorAuthenticatorController extends Controller
{
    /**
     * صفحة المصادقة الثنائية الخاصة بالأدمن
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();

        abort_unless($user, 403);

        return view('Admin.auth.two_factor_auth', compact('user'));
    }
}