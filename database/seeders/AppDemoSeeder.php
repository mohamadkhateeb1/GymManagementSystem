<?php

namespace Database\Seeders;

use App\Models\AttendanceLog;
use App\Models\DietPlan;
use App\Models\Employee;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\PlanType;
use App\Models\Player;
use App\Models\TrainingPlan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * سيدر مخصص حصراً لتزويد تطبيق الجوال (Flutter) ببيانات تجريبية غنية
 * عبر الـ API — لاختبار كل شاشة فعلياً (تسجيل الدخول، الاشتراك، التمارين،
 * التغذية، الحضور، الملف الشخصي) ببيانات حقيقية بدل بيانات وهمية محلية.
 *
 * ⚠️ إضافي بالكامل (Additive) — لا يحذف ولا يعدّل أي بيانات موجودة من أي
 * Seeder آخر بالمشروع، ومعزول تماماً عبر نطاق بريد مخصص (@app.local)
 * لا يتشارك بأي بادئة مع AdminSeeder (@test.com)، EmployeeSeeder (@test.com)،
 * أو TestScenarioSeeder (@eliteclub.local) — صفر احتمال تعارض بأي إيميل.
 *
 * التشغيل: php artisan db:seed --class=AppDemoSeeder
 *
 * بيانات الدخول من التطبيق (كلمة المرور لكل الحسابات: password):
 *   player1@app.local  → اشتراك نشط، بيانات كاملة (السيناريو الأساسي للعرض)
 *   player2@app.local  → اشتراك نشط لكن قريب من الانتهاء (٣ أيام) — لاختبار التنبيه اللوني
 *   player3@app.local  → اشتراك منتهي فعلياً — لاختبار حالة "غير نشط" بالتطبيق
 */
class AppDemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // =====================================================
        // 1) مدرب مخصص للبيانات التجريبية (معزول عن مدربي الموقع الحقيقيين)
        // =====================================================
        $coach = Employee::firstOrCreate(
            ['email' => 'coach@app.local'],
            [
                'name' => 'مدرب تجريبي - Elite App',
                'password' => Hash::make('password'),
                'specialization' => 'تدريب شامل',
            ]
        );

        // =====================================================
        // 2) باقة تجريبية مخصصة (لا تُستخدم بأي مكان تاني بالموقع)
        // =====================================================
        $planType = PlanType::firstOrCreate(
            ['name' => 'باقة اختبار التطبيق'],
            [
                'duration_days' => 30,
                'price' => 200,
                'freeze_days_allowed' => 5,
                'is_active' => true,
            ]
        );

        // =====================================================
        // 3) ثلاثة لاعبين بثلاث سيناريوهات مختلفة، لتغطية كل حالات
        //    عرض الاشتراك بالتطبيق (نشط / قريب الانتهاء / منتهي)
        // =====================================================
        $playersData = [
            [
                'name' => 'لاعب تجريبي - نشط',
                'email' => 'player1@app.local',
                'level' => 'intermediate',
                'membership_status' => 'active',
                'days_left' => 20,
                'password' => 'password',
            ],
            [
                'name' => 'لاعب تجريبي - قرب الانتهاء',
                'email' => 'player2@app.local',
                'level' => 'beginner',
                'membership_status' => 'active',
                'days_left' => 3,
            ],
            [
                'name' => 'لاعب تجريبي - منتهي',
                'email' => 'player3@app.local',
                'level' => 'advanced',
                'membership_status' => 'expired',
                'days_left' => -10,
            ],
        ];

        foreach ($playersData as $i => $data) {

            $player = Player::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'phone' => '090000001' . $i,
                    'date_of_birth' => Carbon::create(1998, 5, 10 + $i)->format('Y-m-d'),
                    'height' => 170 + $i * 3,
                    'weight' => 70 + $i * 4,
                    'coach_id' => $coach->id,
                    'level' => $data['level'],
                    'status' => 'active', // حالة الحساب نفسه بجدول players — منفصلة عن حالة الاشتراك
                ]
            );

            // ── الاشتراك (Membership) ──
            $startDate = $now->copy()->subDays(30 - $data['days_left']);
            $endDate = $now->copy()->addDays($data['days_left']);

            $membership = Membership::create([
                'player_id' => $player->id,
                'plan_type_id' => $planType->id,
                'plan_name' => $planType->name,
                'price_paid' => $planType->price,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'status' => $data['membership_status'],
            ]);

            Payment::create([
                'player_id' => $player->id,
                'membership_id' => $membership->id,
                'plan_type_id' => $planType->id,
                'amount' => $planType->price,
                'type' => 'new',
                'paid_at' => $startDate,
            ]);

            // ── خطة تدريبية خاصة باللاعب، موزّعة على أيام مختلفة من الأسبوع ──
            $trainingPlan = TrainingPlan::create([
                'coach_id' => $coach->id,
                'player_id' => $player->id,
                'is_custom' => true,
                'title' => 'برنامج تجريبي - ' . $data['name'],
                'level' => $data['level'],
                'start_date' => $now,
                'end_date' => $now->copy()->addMonth(),
            ]);

            // day_of_week: 1=السبت ... 7=الجمعة (حسب Plan::DAYS بالموقع بالضبط)
            $exercisesData = [
                ['بنش برس', 4, 12, 1, 1, 'https://www.youtube.com/watch?v=gRVjAtPip0Y'],
                ['سكوات', 5, 10, 1, 2, null],
                ['عقلة', 3, 8, 3, 1, null],
                ['ديدليفت', 4, 6, 3, 2, null],
                ['بايسبس كيرل', 3, 12, 5, 1, null],
                ['كرنش بطن', 4, 20, 5, 2, null],
            ];

            foreach ($exercisesData as [$name, $sets, $reps, $day, $order, $video]) {
                Plan::create([
                    'training_plan_id' => $trainingPlan->id,
                    'name' => $name,
                    'sets' => $sets,
                    'reps' => $reps,
                    'rest_time' => '60 ثانية',
                    'day_of_week' => $day,
                    'order' => $order,
                    'instructions' => 'تمرين تجريبي لاختبار عرضه بتطبيق الجوال.',
                    'video_url' => $video,
                ]);
            }

            // ── خطتان غذائيتان خاصتان باللاعب (بماكروز كاملة لاختبار العرض) ──
            DietPlan::create([
                'coach_id' => $coach->id,
                'player_id' => $player->id,
                'is_custom' => true,
                'level' => $data['level'],
                'meal_name' => 'إفطار بروتيني',
                'calories' => 450,
                'protein' => 35,
                'carbs' => 40,
                'fats' => 12,
                'plan_details' => "٣ بيضات مسلوقة + شوفان + موزة\nوجبة تجريبية لاختبار عرض الماكروز بالتطبيق.",
                'start_date' => $now,
                'end_date' => $now->copy()->addMonth(),
            ]);

            DietPlan::create([
                'coach_id' => $coach->id,
                'player_id' => $player->id,
                'is_custom' => true,
                'level' => $data['level'],
                'meal_name' => 'غداء متوازن',
                'calories' => 620,
                'protein' => 45,
                'carbs' => 60,
                'fats' => 18,
                'plan_details' => "صدر دجاج مشوي + أرز بني + خضار سوتيه.",
                'start_date' => $now,
                'end_date' => $now->copy()->addMonth(),
            ]);

            // ── سجل حضور تجريبي لآخر 5 أيام (للاعب الأول فقط، لملء تقارير الأدمن) ──
            if ($i === 0) {
                for ($d = 5; $d >= 1; $d--) {
                    AttendanceLog::firstOrCreate([
                        'player_id' => $player->id,
                        'attendance_date' => $now->copy()->subDays($d)->toDateString(),
                    ], [
                        'attended_at' => $now->copy()->subDays($d)->setTime(18, 0),
                        'source' => 'app',
                    ]);
                }
            }
        }

        $this->command?->info('✅ AppDemoSeeder: تم إنشاء 3 لاعبين تجريبيين لاختبار التطبيق (player1/2/3@app.local — password)');
    }
}