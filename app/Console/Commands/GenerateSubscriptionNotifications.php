<?php

namespace App\Console\Commands;

use App\Models\Membership;
use App\Models\Notification;
use Illuminate\Console\Command;
use Carbon\Carbon;

/**
 * 🔔 إنشاء إشعارات "اقتراب/انتهاء الاشتراك" تلقائياً كل يوم.
 * هذا الأمر لا يرسل أي شيء فعلياً — فقط يسجّل الإشعار في جدول notifications
 * بانتظار أن يقرأه API الإرسال لاحقاً عند بنائه.
 *
 * التشغيل اليدوي:      php artisan notifications:generate
 * معاينة دون تعديل:    php artisan notifications:generate --dry-run
 */
class GenerateSubscriptionNotifications extends Command
{
    protected $signature = 'notifications:generate {--dry-run : عرض ما سيُنشأ دون تنفيذ}';

    protected $description = 'إنشاء إشعارات اقتراب/انتهاء الاشتراك للاعبين (بدون إرسال فعلي)';

    public function handle(): int
    {
        $dryRun = $this->option('dry-run');
        $today  = Carbon::today();
        $created = 0;
        $rows = [];

        // 1️⃣ اشتراكات تنتهي خلال 3 أيام بالضبط (تذكير مبكر واحد، لا يتكرر يومياً)
        $expiringSoon = Membership::where('status', 'active')
            ->whereDate('end_date', $today->copy()->addDays(3))
            ->with('player')
            ->get();

        foreach ($expiringSoon as $membership) {
            if (! $membership->player) {
                continue;
            }

            $alreadyExists = Notification::where('player_id', $membership->player_id)
                ->where('type', 'subscription_expiring')
                ->whereDate('created_at', $today)
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            $rows[] = [$membership->player->name, 'تذكير اقتراب الانتهاء', $membership->end_date];

            if (! $dryRun) {
                Notification::create([
                    'player_id' => $membership->player_id,
                    'type'      => 'subscription_expiring',
                    'title'     => 'اشتراكك على وشك الانتهاء',
                    'body'      => 'اشتراكك سينتهي بتاريخ ' . Carbon::parse($membership->end_date)->format('Y-m-d') . '. جدّده الآن لتجنّب انقطاع الخدمة.',
                ]);
                $created++;
            }
        }

        // 2️⃣ اشتراكات انتهت اليوم بالضبط (إشعار واحد لحظة الانتهاء)
        $expiredToday = Membership::where('status', 'active')
            ->whereDate('end_date', $today)
            ->with('player')
            ->get();

        foreach ($expiredToday as $membership) {
            if (! $membership->player) {
                continue;
            }

            $alreadyExists = Notification::where('player_id', $membership->player_id)
                ->where('type', 'subscription_expired')
                ->whereDate('created_at', $today)
                ->exists();

            if ($alreadyExists) {
                continue;
            }

            $rows[] = [$membership->player->name, 'إشعار انتهاء الاشتراك', $membership->end_date];

            if (! $dryRun) {
                Notification::create([
                    'player_id' => $membership->player_id,
                    'type'      => 'subscription_expired',
                    'title'     => 'انتهى اشتراكك',
                    'body'      => 'انتهى اشتراكك اليوم. جدّده الآن لمتابعة الاستفادة من خدمات النادي.',
                ]);
                $created++;
            }
        }

        if (empty($rows)) {
            $this->info('✅ لا توجد إشعارات جديدة بحاجة للإنشاء اليوم.');
            return self::SUCCESS;
        }

        $this->table(['اللاعب', 'نوع الإشعار', 'تاريخ الانتهاء'], $rows);

        if ($dryRun) {
            $this->warn('🔍 وضع المعاينة — لم يتم إنشاء أي إشعار فعلياً.');
            return self::SUCCESS;
        }

        $this->info("✅ تم إنشاء {$created} إشعار جديد (بانتظار الإرسال الفعلي لاحقاً عبر API).");
        return self::SUCCESS;
    }
}