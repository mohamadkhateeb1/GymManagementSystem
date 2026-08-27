<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Player;
use App\Models\TrainingPlan;
use Illuminate\Console\Command;

/**
 * 🧪 فحص آلي للتعديلات التي تمت على المشروع.
 * التشغيل:  php artisan check:fixes
 * يعتمد على بيانات TestScenarioSeeder.
 */
class CheckFixes extends Command
{
    protected $signature = 'check:fixes';

    protected $description = 'فحص التعديلات: الصلاحيات، عنوان الخطة، نسخ التمارين، فحص الاشتراك';

    private array $results = [];

    public function handle(): int
    {
        $this->newLine();
        $this->info('🧪 بدء فحص التعديلات...');
        $this->newLine();

        if (!Player::where('email', 'like', '%@test.local')->exists()) {
            $this->error('❌ لا توجد بيانات اختبار. شغّل أولاً:');
            $this->line('   php artisan db:seed --class=TestScenarioSeeder');
            return self::FAILURE;
        }

        $this->checkSubscriptionRelation();
        $this->checkExpiredByDate();
        $this->checkEndOfDay();
        $this->checkPlanTitleColumn();
        $this->checkExerciseRelation();
        $this->checkOrphanPlans();
        $this->checkOwnershipHelper();

        $this->newLine();
        $this->table(['الفحص', 'النتيجة', 'التفاصيل'], $this->results);

        $failed = collect($this->results)->where(1, '❌ فشل')->count();

        $this->newLine();
        if ($failed === 0) {
            $this->info('✅ كل الفحوصات نجحت. التعديلات سليمة.');
            return self::SUCCESS;
        }

        $this->error("❌ فشل {$failed} فحص. راجع التفاصيل أعلاه.");
        return self::FAILURE;
    }

    private function record(string $name, bool $ok, string $detail): void
    {
        $this->results[] = [$name, $ok ? '✅ نجح' : '❌ فشل', $detail];
    }

    // 1️⃣ latestOfMany: اللاعب صاحب الاشتراكين يجب أن يُقرأ اشتراكه الأحدث
    private function checkSubscriptionRelation(): void
    {
        $player = Player::where('email', 'player.c@test.local')->first();

        if (!$player) {
            return;
        }

        $ok = $player->subscription && $player->subscription->plan_name === 'اشتراك سنوي';

        $this->record(
            'latestOfMany (أحدث اشتراك)',
            $ok,
            $ok ? 'قرأ الاشتراك الجديد بشكل صحيح'
                : 'قرأ: ' . ($player->subscription->plan_name ?? 'لا شيء') . ' — المتوقع: اشتراك سنوي'
        );
    }

    // 2️⃣ فحص التاريخ: لاعب حالته active لكن تاريخه منتهٍ يجب أن يُعتبر غير فعّال
    private function checkExpiredByDate(): void
    {
        $player = Player::where('email', 'player.b@test.local')->first();

        if (!$player) {
            return;
        }

        if (!method_exists($player, 'hasActiveSubscription')) {
            $this->record('فحص تاريخ الانتهاء', false, 'دالة hasActiveSubscription غير موجودة في موديل Player');
            return;
        }

        $ok = $player->hasActiveSubscription() === false;

        $this->record(
            'فحص تاريخ الانتهاء',
            $ok,
            $ok ? 'رفض اشتراكاً منتهياً رغم أن حالته active'
                : 'قَبِل اشتراكاً منتهياً — الفحص يعتمد على status فقط'
        );
    }

    // 3️⃣ endOfDay: اشتراك ينتهي اليوم يجب أن يبقى صالحاً
    private function checkEndOfDay(): void
    {
        $player = Player::where('email', 'player.d@test.local')->first();

        if (!$player || !method_exists($player, 'hasActiveSubscription')) {
            return;
        }

        $ok = $player->hasActiveSubscription() === true;

        $this->record(
            'اليوم الأخير من الاشتراك',
            $ok,
            $ok ? 'الاشتراك المنتهي اليوم لا يزال صالحاً'
                : 'اعتبر الاشتراك منتهياً في يومه الأخير — راجع isExpired'
        );
    }

    // 4️⃣ عمود title: يجب أن يكون موجوداً وقابلاً للتعبئة
    private function checkPlanTitleColumn(): void
    {
        $fillable = (new TrainingPlan())->getFillable();

        $ok = in_array('title', $fillable, true) && !in_array('plan_details', $fillable, true);

        $this->record(
            'حقول TrainingPlan',
            $ok,
            $ok ? 'title موجود و plan_details غير موجود'
                : 'الحقول الحالية: ' . implode(', ', $fillable)
        );
    }

    // 5️⃣ علاقة التمارين
    private function checkExerciseRelation(): void
    {
        $plan = TrainingPlan::where('title', 'خطة اختبار - بها تمارين')
            ->whereNull('player_id')
            ->withCount('exercises')
            ->first();

        if (!$plan) {
            $this->record('علاقة التمارين', false, 'لم يتم العثور على خطة الاختبار');
            return;
        }

        $ok = $plan->exercises_count === 3;

        $this->record(
            'علاقة التمارين',
            $ok,
            $ok ? 'خطة البنك تحتوي 3 تمارين'
                : "عدد التمارين: {$plan->exercises_count} — المتوقع: 3"
        );
    }

    // 6️⃣ خطط لاعبين فارغة (بقايا التوزيع القديم)
    private function checkOrphanPlans(): void
    {
        $orphans = TrainingPlan::whereNotNull('player_id')
            ->whereDoesntHave('exercises')
            ->count();

        $ok = $orphans === 0;

        $this->record(
            'خطط اللاعبين الفارغة',
            $ok,
            $ok ? 'لا توجد خطط فارغة'
                : "يوجد {$orphans} خطة فارغة — نظّفها قبل الاختبار اليدوي"
        );
    }

    // 7️⃣ وجود دالة الحماية في الكنترولر
    private function checkOwnershipHelper(): void
    {
        $file = app_path('Http/Controllers/Employee/PlayerMonitorController.php');

        if (!file_exists($file)) {
            $this->record('حماية ملكية اللاعب', false, 'الملف غير موجود');
            return;
        }

        $code = file_get_contents($file);
        $ok = str_contains($code, 'findMyPlayer')
            && !str_contains($code, "Player::with('subscription')->findOrFail");

        $this->record(
            'حماية ملكية اللاعب',
            $ok,
            $ok ? 'كل الاستدعاءات تمر عبر findMyPlayer'
                : 'لا تزال هناك استدعاءات مباشرة بدون فحص الملكية'
        );
    }
}