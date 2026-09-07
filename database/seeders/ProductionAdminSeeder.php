<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * 🛡️ سيدر الأدمن الإنتاجي — آمن للتشغيل على السيرفر.
 *
 * - يقرأ البيانات من .env ولا يحتوي أي كلمة مرور ثابتة داخل الكود.
 * - Idempotent: لا ينشئ الأدمن إلا إذا كان بريده غير موجود مسبقاً،
 *   فتشغيله أكثر من مرة لا يكرّر الحساب ولا يعيد ضبط كلمة المرور.
 * - يرفض العمل إذا لم تُضبط ADMIN_PASSWORD أو كانت ضعيفة/افتراضية.
 *
 * التشغيل على السيرفر (مرة واحدة):
 *   php artisan db:seed --class=Database\\Seeders\\ProductionAdminSeeder --force
 */
class ProductionAdminSeeder extends Seeder
{
    public function run(): void
    {
        $name     = env('ADMIN_NAME', 'Super Admin');
        $email    = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (blank($email) || blank($password)) {
            $this->command?->error(
                'ADMIN_EMAIL و ADMIN_PASSWORD مطلوبان في .env قبل تشغيل هذا السيدر.'
            );
            return;
        }

        // رفض كلمات المرور الضعيفة/الافتراضية الشائعة.
        $weak = ['password', '12345678', 'admin', 'secret', 'changeme'];

        if (strlen($password) < 12 || in_array(strtolower($password), $weak, true)) {
            $this->command?->error(
                'ADMIN_PASSWORD ضعيفة جداً. استخدم 12 محرفاً على الأقل وكلمة غير شائعة.'
            );
            return;
        }

        $admin = Admin::firstOrCreate(
            ['email' => $email],
            [
                'name'        => $name,
                'password'    => Hash::make($password),
                'super_admin' => true,
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command?->info("✅ تم إنشاء حساب السوبر أدمن: {$email}");
        } else {
            $this->command?->warn("ℹ️ الحساب موجود مسبقاً، لم يتم تغيير أي شيء: {$email}");
        }
    }
}