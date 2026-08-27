<?php

namespace App\Console\Commands;

use App\Models\Membership;
use Illuminate\Console\Command;

/**
 * ⏰ تحديث حالة الاشتراكات التي انتهى تاريخها إلى expired.
 *
 * لا يجدّد هذا الأمر أي اشتراك ولا يمدّد أي تاريخ، وظيفته الوحيدة
 * أن يعكس الواقع في عمود status حتى تبقى التقارير والـ API صادقة.
 * التجديد يبقى قراراً يدوياً عبر المدير أو الدفع من التطبيق.
 *
 * التشغيل اليدوي:      php artisan subscriptions:expire
 * معاينة دون تعديل:    php artisan subscriptions:expire --dry-run
 */
class ExpireSubscriptions extends Command
{
    protected $signature = 'subscriptions:expire {--dry-run : عرض الاشتراكات المتأثرة دون تعديلها}';

    protected $description = 'تحويل حالة الاشتراكات المنتهية تاريخياً إلى expired';

    public function handle(): int
    {
        $today = now()->toDateString();

        // الاشتراكات المكتوب أنها فعّالة بينما تاريخ انتهائها قد مضى
        $query = Membership::where('status', 'active')
            ->whereDate('end_date', '<', $today);

        $count = (clone $query)->count();

        if ($count === 0) {
            $this->info('✅ لا توجد اشتراكات منتهية بحاجة إلى تحديث.');
            return self::SUCCESS;
        }

        // وضع المعاينة: عرض التفاصيل دون أي تعديل على قاعدة البيانات
        if ($this->option('dry-run')) {
            $this->warn("🔍 وضع المعاينة — لن يتم تعديل أي شيء. عدد الاشتراكات المتأثرة: {$count}");

            $rows = (clone $query)->with('player')->get()->map(fn ($m) => [
                $m->id,
                $m->player->name ?? 'لاعب محذوف',
                $m->plan_name,
                $m->end_date->format('Y-m-d'),
                (int) $m->end_date->startOfDay()->diffInDays(now()->startOfDay()) . ' يوم',
            ]);

            $this->table(['ID', 'اللاعب', 'الباقة', 'تاريخ الانتهاء', 'مضى عليه'], $rows);

            return self::SUCCESS;
        }

        $updated = $query->update(['status' => 'expired']);

        $this->info("✅ تم تحديث {$updated} اشتراك إلى الحالة expired.");

        return self::SUCCESS;
    }
}