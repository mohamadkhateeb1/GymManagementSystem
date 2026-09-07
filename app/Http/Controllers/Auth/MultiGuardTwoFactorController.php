<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;

/**
 * 🛡️ تحكّم صريح ومستقل بتفعيل/تأكيد/إلغاء المصادقة الثنائية للأدمن والموظف.
 *
 * السبب: روابط Fortify الداخلية الجاهزة (/user/two-factor-authentication)
 * لا تملك بادئة admin/employee، فيتعذّر تحديد الحارس الصحيح لها بشكل
 * موثوق (بغضّ النظر عن أي middleware نحاول نبنيه)، فكانت تطرد الأدمن/الموظف
 * لصفحة دخول اللاعب بالخطأ. الحل: بلا أي تخمين إطلاقاً — الحارس مُحدَّد
 * صراحة داخل كل Route نفسها (matching نفس أسلوب routes/multi_auth.php
 * الناجح تماماً لتسجيل الدخول).
 */
class MultiGuardTwoFactorController extends Controller
{
    public function enableAdmin(EnableTwoFactorAuthentication $enable)
    {
        return $this->enable('admin', $enable);
    }

    public function enableEmployee(EnableTwoFactorAuthentication $enable)
    {
        return $this->enable('employee', $enable);
    }

    public function confirmAdmin(Request $request, ConfirmTwoFactorAuthentication $confirm)
    {
        return $this->confirm('admin', $request, $confirm);
    }

    public function confirmEmployee(Request $request, ConfirmTwoFactorAuthentication $confirm)
    {
        return $this->confirm('employee', $request, $confirm);
    }

    public function disableAdmin(DisableTwoFactorAuthentication $disable)
    {
        return $this->disable('admin', $disable);
    }

    public function disableEmployee(DisableTwoFactorAuthentication $disable)
    {
        return $this->disable('employee', $disable);
    }

    private function enable(string $guard, EnableTwoFactorAuthentication $enable)
    {
        $user = Auth::guard($guard)->user();
        abort_unless($user, 403);

        $enable($user);

        // 🛠️ توجيه صريح لصفحة الـ 2FA الخاصة بالحارس بدل back().
        // back() يعتمد على ترويسة Referer / آخر رابط بالجلسة، وهي غير موثوقة
        // (سياسة Referrer بالمتصفح، بروكسي، أو تنقّل داخلي)، فكانت أحياناً
        // ترمي المستخدم للداشبورد بدل إظهار خطوة مسح QR والتأكيد.
        return $this->redirectToSettings($guard)
            ->with('status', 'two-factor-authentication-enabled');
    }

    private function confirm(string $guard, Request $request, ConfirmTwoFactorAuthentication $confirm)
    {
        $user = Auth::guard($guard)->user();
        abort_unless($user, 403);

        $request->validate([
            'code' => 'required|string',
        ], [
            'code.required' => 'رمز التأكيد مطلوب.',
        ]);

        try {
            $confirm($user, $request->input('code'));
        } catch (ValidationException $e) {
            // نُبقي الخطأ على صفحة الـ 2FA الصحيحة بدل back().
            throw ValidationException::withMessages([
                'code' => 'رمز التأكيد غير صحيح. تأكد من الرمز الظاهر بتطبيق المصادقة وحاول مرة أخرى.',
            ])->redirectTo($this->settingsUrl($guard));
        }

        return $this->redirectToSettings($guard)
            ->with('status', 'two-factor-authentication-confirmed');
    }

    private function disable(string $guard, DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::guard($guard)->user();
        abort_unless($user, 403);

        $disable($user);

        return $this->redirectToSettings($guard)
            ->with('status', 'two-factor-authentication-disabled');
    }

    /**
     * اسم راوت صفحة إعدادات الـ 2FA حسب الحارس.
     */
    private function settingsRouteName(string $guard): string
    {
        return $guard === 'admin' ? 'admin.2fa' : 'employee.2fa';
    }

    private function settingsUrl(string $guard): string
    {
        return route($this->settingsRouteName($guard));
    }

    private function redirectToSettings(string $guard): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route($this->settingsRouteName($guard));
    }
}
