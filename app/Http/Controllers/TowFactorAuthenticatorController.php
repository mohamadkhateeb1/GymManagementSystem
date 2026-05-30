<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;

class TowFactorAuthenticatorController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check()){
            $user = Auth::guard('admin')->user();
        }else{
            $user = Auth::guard('employee')->user();
        }
        return view('auth.two_factor_auth', compact('user'));
    }
}
