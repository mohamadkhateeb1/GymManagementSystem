<?php

namespace App\Http\Responses;

use App\Support\AdminLanding;
use App\Support\EmployeeLanding;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $guard = config('fortify.guard');

        if ($guard === 'admin') {
            return $this->redirectByRole(
                Auth::guard('admin')->user(),
                AdminLanding::class,
                'admin.dashboard'
            );
        }

        if ($guard === 'employee') {
            return $this->redirectByRole(
                Auth::guard('employee')->user(),
                EmployeeLanding::class,
                'employee.dashboard'
            );
        }

        return redirect()->route('dashboard');
    }

    /**
     * توجيه المستخدم حسب دوره:
     * - السوبر أدمن → الصفحة الافتراضية.
     * - المستخدم المحدود → أول صفحة تسمح بها صلاحياته.
     * - إن لم يملك أي صلاحية → الصفحة الافتراضية الآمنة.
     */
    protected function redirectByRole($user, string $landingClass, string $default)
    {
        // السوبر أدمن يملك كل شيء → صفحته الافتراضية مباشرة
        if ($user && ($user->super_admin ?? false)) {
            return redirect()->route($default);
        }

        $route = $landingClass::firstRouteFor($user);

        return redirect()->route($route ?: $default);
    }
}