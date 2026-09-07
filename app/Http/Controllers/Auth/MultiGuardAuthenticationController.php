<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;

class MultiGuardAuthenticationController extends Controller
{
    public function adminLogin()
    {
        return view('auth.admin-login');
    }

    public function employeeLogin()
    {
        return view('auth.employee-login');
    }

    public function authenticateAdmin(LoginRequest $request)
    {
        $this->configureGuard('admin', 'admins', '/admin/dashboard');
        $request->merge([
            'remember' => false,
        ]);

        return app(AuthenticatedSessionController::class)->store($request);
    }

    public function authenticateEmployee(LoginRequest $request)
    {
        $request->merge([
            'remember' => false,
        ]);
        $this->configureGuard('employee', 'employees', '/employee/dashboard');

        return app(AuthenticatedSessionController::class)->store($request);
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function employeeLogout(Request $request)
    {
        Auth::guard('employee')->logout();

        $request->session()->regenerateToken();

        return redirect()->route('employee.login');
    }

    private function configureGuard(string $guard, string $passwords, string $home): void
    {
        config([
            'fortify.guard' => $guard,
            'fortify.passwords' => $passwords,
            'fortify.home' => $home,
        ]);

        request()->session()->put('login.guard', $guard);
    }
}
