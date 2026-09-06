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

        return back();
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
            throw ValidationException::withMessages([
                'code' => 'رمز التأكيد غير صحيح. تأكد من الرمز الظاهر بتطبيق المصادقة وحاول مرة أخرى.',
            ]);
        }

        return back()->with('status', 'two-factor-authentication-confirmed');
    }

    private function disable(string $guard, DisableTwoFactorAuthentication $disable)
    {
        $user = Auth::guard($guard)->user();
        abort_unless($user, 403);

        $disable($user);

        return back();
    }
}