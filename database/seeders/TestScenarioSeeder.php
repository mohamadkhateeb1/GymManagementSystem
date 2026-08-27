<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Player;
use App\Models\Membership;
use App\Models\TrainingPlan;
use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * 🧪 بيانات اختبار لفحص التعديلات (الأمان + الخطط + الاشتراكات).
 * التشغيل:  php artisan db:seed --class=TestScenarioSeeder
 * الحذف:    php artisan db:seed --class=TestScenarioSeeder  (ينظّف القديم تلقائياً قبل الإنشاء)
 */
class TestScenarioSeeder extends Seeder
{
    public function run(): void
    {
        $this->cleanup();

        // ==========================================
        // 1. مدربان لاختبار عزل الصلاحيات
        // ==========================================
        $coachA = Employee::create([
            'name'           => 'كابتن اختبار أ',
            'email'          => 'coach.a@test.local',
            'password'       => Hash::make('password'),
            'specialization' => 'كمال أجسام',
        ]);

        $coachB = Employee::create([
            'name'           => 'كابتن اختبار ب',
            'email'          => 'coach.b@test.local',
            'password'       => Hash::make('password'),
            'specialization' => 'لياقة',
        ]);

        // ==========================================
        // 2. لاعبو المدرب أ بحالات اشتراك مختلفة
        // ==========================================

        // 🟢 لاعب أ — اشتراك سليم فعّال
        $playerA = $this->makePlayer('لاعب أ - اشتراك سليم', 'player.a@test.local', $coachA->id);
        Membership::create([
            'player_id'  => $playerA->id,
            'plan_name'  => 'اشتراك شهري',
            'start_date' => now()->subDays(5),
            'end_date'   => now()->addMonth(),
            'status'     => 'active',
        ]);

        // 🔴 لاعب ب — الحالة active لكن التاريخ منتهٍ (اختبار فحص end_date)
        $playerB = $this->makePlayer('لاعب ب - منتهٍ بالتاريخ', 'player.b@test.local', $coachA->id);
        Membership::create([
            'player_id'  => $playerB->id,
            'plan_name'  => 'اشتراك شهري',
            'start_date' => now()->subMonths(3),
            'end_date'   => now()->subMonth(),
            'status'     => 'active', // ← متروكة active عمداً
        ]);

        // 🟡 لاعب ج — اشتراكان: قديم منتهٍ + جديد فعّال (اختبار latestOfMany)
        $playerC = $this->makePlayer('لاعب ج - جدّد اشتراكه', 'player.c@test.local', $coachA->id);
        Membership::create([
            'player_id'  => $playerC->id,
            'plan_name'  => 'اشتراك شهري',
            'start_date' => now()->subMonths(4),
            'end_date'   => now()->subMonths(3),
            'status'     => 'expired',
        ]);
        Membership::create([
            'player_id'  => $playerC->id,
            'plan_name'  => 'اشتراك سنوي',
            'start_date' => now()->subDays(2),
            'end_date'   => now()->addYear(),
            'status'     => 'active',
        ]);

        // 🔵 لاعب د — ينتهي اشتراكه اليوم (اختبار endOfDay)
        $playerD = $this->makePlayer('لاعب د - ينتهي اليوم', 'player.d@test.local', $coachA->id);
        Membership::create([
            'player_id'  => $playerD->id,
            'plan_name'  => 'اشتراك شهري',
            'start_date' => now()->subMonth(),
            'end_date'   => now(), // ← اليوم بالضبط
            'status'     => 'active',
        ]);

        // ==========================================
        // 3. لاعب تابع للمدرب ب (لاختبار ثغرة IDOR)
        // ==========================================
        $playerE = $this->makePlayer('لاعب المدرب ب', 'player.e@test.local', $coachB->id);
        Membership::create([
            'player_id'  => $playerE->id,
            'plan_name'  => 'اشتراك شهري',
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
            'status'     => 'active',
        ]);

        // ==========================================
        // 4. خطتان في بنك المدرب أ: واحدة بتمارين وواحدة فارغة
        // ==========================================
        $fullPlan = TrainingPlan::create([
            'coach_id'   => $coachA->id,
            'player_id'  => null,
            'title'      => 'خطة اختبار - بها تمارين',
            'level'      => 'beginner',
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
        ]);

        foreach ([
            ['بنش برس مستوي', 4, 12],
            ['سكوات', 5, 10],
            ['عقلة', 3, 8],
        ] as [$name, $sets, $reps]) {
            Plan::create([
                'training_plan_id' => $fullPlan->id,
                'name'             => $name,
                'sets'             => $sets,
                'reps'             => $reps,
                'instructions'     => 'تمرين اختباري للتحقق من النسخ.',
            ]);
        }

        TrainingPlan::create([
            'coach_id'   => $coachA->id,
            'player_id'  => null,
            'title'      => 'خطة اختبار - فارغة',
            'level'      => 'intermediate',
            'start_date' => now(),
            'end_date'   => now()->addMonth(),
        ]);

        $this->printSummary($playerA, $playerB, $playerC, $playerD, $playerE, $fullPlan);
    }

    private function makePlayer(string $name, string $email, int $coachId): Player
    {
        return Player::create([
            'name'          => $name,
            'email'         => $email,
            'password'      => Hash::make('password'),
            'coach_id'      => $coachId,
            'date_of_birth' => '2000-01-01',
            'height'        => 175,
            'weight'        => 80,
            'phone'         => '0000000000',
            'level'         => 'beginner',
        ]);
    }

    /**
     * حذف بيانات الاختبار السابقة فقط (كل ما ينتهي بـ @test.local)
     */
    private function cleanup(): void
    {
        Player::where('email', 'like', '%@test.local')->get()->each->delete();
        Employee::where('email', 'like', '%@test.local')->get()->each->delete();
        TrainingPlan::where('title', 'like', 'خطة اختبار%')->delete();
    }

    private function printSummary($a, $b, $c, $d, $e, $plan): void
    {
        $this->command->newLine();
        $this->command->info('✅ تم إنشاء بيانات الاختبار. كلمة المرور للجميع: password');
        $this->command->newLine();

        $this->command->table(
            ['الحساب', 'البريد', 'ID', 'الحالة المتوقعة'],
            [
                ['المدرب أ',   'coach.a@test.local',  '-',       'يملك 4 لاعبين'],
                ['المدرب ب',   'coach.b@test.local',  '-',       'يملك لاعباً واحداً'],
                ['لاعب أ',     'player.a@test.local', $a->id,    '🟢 نشط'],
                ['لاعب ب',     'player.b@test.local', $b->id,    '🔴 منتهٍ (رغم أن status=active)'],
                ['لاعب ج',     'player.c@test.local', $c->id,    '🟢 نشط (له اشتراكان)'],
                ['لاعب د',     'player.d@test.local', $d->id,    '🟢 نشط (ينتهي اليوم)'],
                ['لاعب المدرب ب', 'player.e@test.local', $e->id, '⛔ يجب أن يعطي 404 للمدرب أ'],
            ]
        );

        $this->command->warn('🔑 اختبار الثغرة: سجّل دخول بالمدرب أ ثم افتح /employee/monitoring/' . $e->id);
        $this->command->warn('📋 خطة الاختبار في البنك id=' . $plan->id . ' وبها 3 تمارين.');
        $this->command->newLine();
    }
}