<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
    /**
     * 🏠 الصفحة الترحيبية العامة.
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * 📊 لوحة تحكم اللاعب الافتراضية (حارس web).
     */
    

    /**
     * 🔐 صفحة تحدّي المصادقة الثنائية — نسخة الأدمن.
     * (بديل مباشر لـ Fortify::twoFactorChallengeView عند الحاجة لرابط مستقل)
     */
    public function adminTwoFactorChallenge()
    {
        return view('Admin.auth.two-factor-challenge');
    }

    /**
     * 🔐 صفحة تحدّي المصادقة الثنائية — نسخة الموظف.
     */
    public function employeeTwoFactorChallenge()
    {
        return view('Employee.auth.two-factor-challenge');
    }

}
