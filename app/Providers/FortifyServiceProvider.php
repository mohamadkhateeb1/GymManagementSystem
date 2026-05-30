<?php

namespace App\Providers;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use App\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use App\Http\Responses\LogoutResponse;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
// use App\Http\Responses\LoginResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;
use PSpell\Config;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $request = request();
        if ($request->is('admin/*')) {
            config()->set('fortify.guard', 'admin');
            config()->set('fortify.passwords', 'admins');
            config()->set('fortify.prefix', 'admin');
            config()->set('fortify.home', '/admin');
        } elseif ($request->is('employee/*')) {
            config()->set('fortify.guard', 'employee');
            config()->set('fortify.passwords', 'employees');
            config()->set('fortify.prefix', 'employee');
            config()->set('fortify.home', '/employee/dashboard');
        } else {
            config()->set('fortify.guard', 'web');
            config()->set('fortify.passwords', 'players');
            config()->set('fortify.prefix', '');
            config()->set('fortify.home', '/home');
        }
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->singleton(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        RateLimiter::for('passkeys', function (Request $request) {
            $credentialId = $request->input('credential.id');

            return Limit::perMinute(10)->by(
                ($credentialId ?: $request->session()->getId()) . '|' . $request->ip()
            );
        });
        Fortify::confirmPasswordView(function () {
        return view('auth.confirm-password');
    });
        Fortify::loginView(function () {
            $guard = config('fortify.guard');

            if ($guard === 'admin') {
                return view('auth.admin-login'); // مسار ملف الـ blade للأدمن
            } elseif ($guard === 'employee') {
                return view('auth.employee-login'); // مسار ملف الـ blade للموظف
            }

            return view('auth.login'); // واجهة الافتراضية للـ Web
        });
    }
}
