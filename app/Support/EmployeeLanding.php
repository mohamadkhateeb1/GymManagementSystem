<?php

namespace App\Support;

/**
 * يحدّد صفحة الهبوط المناسبة للموظف بعد تسجيل الدخول حسب صلاحياته،
 * اعتماداً على نفس مصدر بيانات الـ sidebar (config/sideEmployee.php)
 * حتى يبقى التوجيه متزامناً تلقائياً مع ما يظهر في القائمة.
 */
class EmployeeLanding
{
    /**
     * اسم أول راوت في قائمة الموظف يملك المستخدم صلاحيته.
     *
     * العناصر بلا مفتاح 'ability' لا تُعتبر نقطة هبوط
     * للمستخدم المحدود.
     */
    public static function firstRouteFor($user): ?string
    {
        if (!$user) {
            return null;
        }

        foreach (config('sideEmployee', []) as $group) {
            foreach (($group['items'] ?? []) as $item) {

                if (empty($item['route'])) {
                    continue;
                }

                $ability = $item['ability'] ?? null;

                if ($ability === null) {
                    continue;
                }

                if ($user->can($ability)) {
                    return $item['route'];
                }
            }
        }

        return null;
    }
}