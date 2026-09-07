<?php

namespace App\Support;

/**
 * يحدّد صفحة الهبوط المناسبة للأدمن بعد تسجيل الدخول حسب دوره،
 * اعتماداً على نفس مصدر بيانات الـ sidebar (config/side.php)
 * حتى يبقى التوجيه متزامناً تلقائياً مع ما يظهر في القائمة.
 */
class AdminLanding
{
    /**
     * اسم أول راوت في القائمة يملك المستخدم صلاحيته.
     * العناصر بلا مفتاح 'ability' (كالداشبورد) لا تُعتبر نقطة هبوط
     * للمستخدم المحدود — الداشبورد مخصّصة لمن يملك صلاحية كاملة.
     */
    public static function firstRouteFor($user): ?string
    {
        if (!$user) {
            return null;
        }

        foreach (config('side', []) as $group) {
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