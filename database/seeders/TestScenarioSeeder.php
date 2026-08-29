<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestScenarioSeeder extends Seeder
{
    /**
     * Demo data for Elite Club dashboard.
     *
     * التشغيل:
     * php artisan db:seed --class=TestScenarioSeeder
     *
     * كلمة مرور الحسابات:
     * password
     */
    public function run(): void
    {
        DB::transaction(function () {

            $this->cleanup();

            $now = Carbon::now();

            // =========================================================
            // 1) EMPLOYEES / COACHES
            // =========================================================

            $employees = [];

            $employeeData = [
                [
                    'name' => 'أحمد خالد',
                    'email' => 'ahmad.demo@eliteclub.local',
                    'specialization' => 'كمال أجسام',
                ],
                [
                    'name' => 'محمد علي',
                    'email' => 'mohamed.demo@eliteclub.local',
                    'specialization' => 'لياقة بدنية',
                ],
                [
                    'name' => 'عمر حسن',
                    'email' => 'omar.demo@eliteclub.local',
                    'specialization' => 'CrossFit',
                ],
                [
                    'name' => 'سامي محمود',
                    'email' => 'sami.demo@eliteclub.local',
                    'specialization' => 'تمارين وظيفية',
                ],
            ];

            foreach ($employeeData as $employee) {
                $employees[] = DB::table('employees')->insertGetId([
                    'name' => $employee['name'],
                    'email' => $employee['email'],
                    'password' => Hash::make('password'),
                    'specialization' => $employee['specialization'],
                    'two_factor_secret' => null,
                    'two_factor_recovery_codes' => null,
                    'two_factor_confirmed_at' => null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // =========================================================
            // 2) MEMBERSHIP PLAN TYPES
            // =========================================================

            $planTypes = [];

            $plans = [
                [
                    'name' => 'شهري',
                    'duration_days' => 30,
                    'price' => 250,
                    'freeze_days_allowed' => 3,
                ],
                [
                    'name' => 'ربع سنوي',
                    'duration_days' => 90,
                    'price' => 650,
                    'freeze_days_allowed' => 7,
                ],
                [
                    'name' => 'نصف سنوي',
                    'duration_days' => 180,
                    'price' => 1150,
                    'freeze_days_allowed' => 14,
                ],
                [
                    'name' => 'سنوي',
                    'duration_days' => 365,
                    'price' => 2000,
                    'freeze_days_allowed' => 30,
                ],
            ];

            foreach ($plans as $plan) {
                $planTypes[$plan['name']] = DB::table('plan_types')->insertGetId([
                    'name' => $plan['name'],
                    'duration_days' => $plan['duration_days'],
                    'price' => $plan['price'],
                    'freeze_days_allowed' => $plan['freeze_days_allowed'],
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }

            // =========================================================
            // 3) PLAYERS
            // =========================================================

            $players = [];

            $playerData = [
                ['أمير أحمد', 'basic', 0],
                ['رامي خالد', 'basic', 1],
                ['كريم سامر', 'intermediate', 2],
                ['ياسر محمد', 'advanced', 3],
                ['لؤي حسن', 'basic', 0],

                ['مازن علي', 'intermediate', 1],
                ['طارق محمود', 'advanced', 2],
                ['حسام وليد', 'basic', 3],
                ['فادي عمر', 'intermediate', 0],
                ['جاد سمير', 'advanced', 1],

                ['أنس خالد', 'basic', 2],
                ['باسل أحمد', 'intermediate', 3],
                ['سيف محمد', 'advanced', 0],
                ['يزن حسن', 'basic', 1],
                ['رامز علي', 'intermediate', 2],

                ['نديم سامي', 'advanced', 3],
                ['وسيم خالد', 'basic', 0],
                ['زياد محمود', 'intermediate', 1],
                ['مروان حسن', 'advanced', 2],
                ['إياد عمر', 'basic', 3],
            ];

            foreach ($playerData as $index => $data) {

                [$name, $level, $coachIndex] = $data;

                $email = 'player' . ($index + 1) . '.demo@eliteclub.local';

                $players[] = [
                    'id' => DB::table('players')->insertGetId([
                        'name' => $name,
                        'email' => $email,
                        'password' => Hash::make('password'),
                        'coach_id' => $employees[$coachIndex],
                        'date_of_birth' => Carbon::create(1994 + ($index % 8), 1 + ($index % 12), 5 + ($index % 20))->format('Y-m-d'),
                        'height' => 168 + ($index % 15),
                        'weight' => 65 + ($index * 2),
                        'phone' => '099' . str_pad((string) ($index + 1000000), 7, '0', STR_PAD_LEFT),
                        'level' => $level,
                        'status' => $index === 18 ? 'inactive' : 'active',
                        'created_at' => $now->copy()->subDays(120 - ($index * 3)),
                        'updated_at' => $now,
                    ]),
                    'name' => $name,
                    'coach_id' => $employees[$coachIndex],
                ];
            }

            // =========================================================
            // 4) MEMBERSHIPS
            //
            // 12 Active
            // 5 Expired
            // 1 Pending
            // 2 بدون اشتراك
            // =========================================================

            $membershipIds = [];

            foreach ($players as $index => $player) {

                // اللاعب 19 و20 بدون اشتراك
                if ($index >= 18) {
                    continue;
                }

                // -----------------------------------------------------
                // Active: players 1 -> 12
                // -----------------------------------------------------
                if ($index < 12) {

                    $planName = match ($index % 4) {
                        0 => 'شهري',
                        1 => 'ربع سنوي',
                        2 => 'نصف سنوي',
                        default => 'سنوي',
                    };

                    $planId = $planTypes[$planName];

                    $price = match ($planName) {
                        'شهري' => 250,
                        'ربع سنوي' => 650,
                        'نصف سنوي' => 1150,
                        default => 2000,
                    };

                    $startDate = $now->copy()->subDays(10 + ($index * 2));
                    $endDate = $startDate->copy()->addDays(
                        match ($planName) {
                            'شهري' => 30,
                            'ربع سنوي' => 90,
                            'نصف سنوي' => 180,
                            default => 365,
                        }
                    );

                    $membershipId = DB::table('memberships')->insertGetId([
                        'player_id' => $player['id'],
                        'plan_type_id' => $planId,
                        'price_paid' => $price,
                        'plan_name' => $planName,
                        'start_date' => $startDate->format('Y-m-d'),
                        'end_date' => $endDate->format('Y-m-d'),
                        'status' => 'active',
                        'created_at' => $startDate,
                        'updated_at' => $now,
                    ]);

                    $membershipIds[$index] = $membershipId;

                    // الدفع الأساسي
                    $this->createPayment(
                        $player['id'],
                        $membershipId,
                        $planId,
                        $price,
                        'new',
                        $startDate
                    );

                    continue;
                }

                // -----------------------------------------------------
                // Expired: players 13 -> 17
                // -----------------------------------------------------
                if ($index < 17) {

                    $planName = match ($index % 3) {
                        0 => 'شهري',
                        1 => 'ربع سنوي',
                        default => 'نصف سنوي',
                    };

                    $planId = $planTypes[$planName];

                    $price = match ($planName) {
                        'شهري' => 250,
                        'ربع سنوي' => 650,
                        default => 1150,
                    };

                    $endDate = $now->copy()->subDays(8 + (($index - 12) * 7));

                    $startDate = $endDate->copy()->subDays(
                        match ($planName) {
                            'شهري' => 30,
                            'ربع سنوي' => 90,
                            default => 180,
                        }
                    );

                    $membershipId = DB::table('memberships')->insertGetId([
                        'player_id' => $player['id'],
                        'plan_type_id' => $planId,
                        'price_paid' => $price,
                        'plan_name' => $planName,
                        'start_date' => $startDate->format('Y-m-d'),
                        'end_date' => $endDate->format('Y-m-d'),
                        'status' => 'expired',
                        'created_at' => $startDate,
                        'updated_at' => $now,
                    ]);

                    $membershipIds[$index] = $membershipId;

                    $this->createPayment(
                        $player['id'],
                        $membershipId,
                        $planId,
                        $price,
                        'new',
                        $startDate
                    );

                    continue;
                }

                // -----------------------------------------------------
                // Pending: player 18
                // -----------------------------------------------------

                $planName = 'شهري';
                $planId = $planTypes[$planName];
                $price = 250;

                $startDate = $now->copy()->addDays(3);
                $endDate = $startDate->copy()->addDays(30);

                $membershipId = DB::table('memberships')->insertGetId([
                    'player_id' => $player['id'],
                    'plan_type_id' => $planId,
                    'price_paid' => $price,
                    'plan_name' => $planName,
                    'start_date' => $startDate->format('Y-m-d'),
                    'end_date' => $endDate->format('Y-m-d'),
                    'status' => 'pending',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $membershipIds[$index] = $membershipId;

                // دفع فعلي للحجز المسبق
                $this->createPayment(
                    $player['id'],
                    $membershipId,
                    $planId,
                    $price,
                    'new',
                    $now
                );
            }

            // =========================================================
            // 5) HISTORICAL PAYMENTS
            //
            // بيانات موزعة على آخر 6 أشهر للرسم البياني
            // =========================================================

            $historicalPlayers = array_slice($players, 0, 12);

            foreach ($historicalPlayers as $index => $player) {

                $monthOffset = ($index % 6) + 1;

                $paymentDate = $now
                    ->copy()
                    ->subMonths($monthOffset)
                    ->day(min(10 + $index, 25))
                    ->setTime(11 + ($index % 5), 15);

                $planName = match ($index % 4) {
                    0 => 'شهري',
                    1 => 'ربع سنوي',
                    2 => 'نصف سنوي',
                    default => 'سنوي',
                };

                $planId = $planTypes[$planName];

                $amount = match ($planName) {
                    'شهري' => 250,
                    'ربع سنوي' => 650,
                    'نصف سنوي' => 1150,
                    default => 2000,
                };

                $membershipId = $membershipIds[$index] ?? null;

                $this->createPayment(
                    $player['id'],
                    $membershipId,
                    $planId,
                    $amount,
                    'renewal',
                    $paymentDate
                );
            }

            // =========================================================
            // 6) EXTRA RENEWALS
            // حتى يكون الرسم المالي أغنى
            // =========================================================

            $extraPayments = [
                [0, 1, 300],
                [1, 2, 700],
                [2, 1, 300],
                [3, 3, 2100],
                [4, 2, 700],
                [5, 4, 1200],
                [6, 1, 300],
                [7, 2, 700],
                [8, 1, 300],
                [9, 3, 2100],
                [10, 2, 700],
                [11, 1, 300],
            ];

            foreach ($extraPayments as $paymentIndex => [$playerIndex, $monthsAgo, $amount]) {

                $player = $players[$playerIndex];

                $paymentDate = $now
                    ->copy()
                    ->subMonths($monthsAgo)
                    ->subDays($paymentIndex + 2)
                    ->setTime(15, 30);

                $planName = match ($playerIndex % 4) {
                    0 => 'شهري',
                    1 => 'ربع سنوي',
                    2 => 'نصف سنوي',
                    default => 'سنوي',
                };

                $planId = $planTypes[$planName];

                $membershipId = $membershipIds[$playerIndex] ?? null;

                $this->createPayment(
                    $player['id'],
                    $membershipId,
                    $planId,
                    $amount,
                    'renewal',
                    $paymentDate
                );
            }

            // =========================================================
            // 7) PLAYER ATTENDANCE
            // =========================================================

            foreach ($players as $index => $player) {

                // اللاعبان بدون اشتراك لا نكثر لهما الحضور
                if ($index >= 18) {
                    continue;
                }

                $attendanceCount = 3 + ($index % 7);

                for ($day = 0; $day < $attendanceCount; $day++) {

                    $attendanceDate = $now
                        ->copy()
                        ->subDays($day + ($index % 3));

                    $checkInHour = 8 + ($index % 5);

                    $checkIn = $attendanceDate
                        ->copy()
                        ->setTime($checkInHour, 5 + (($index * 7 + $day * 11) % 50));

                    $checkOut = $checkIn
                        ->copy()
                        ->addMinutes(55 + (($index * 13 + $day * 9) % 70));

                    DB::table('redesign_attendance_logs')->insert([
                        'player_id' => $player['id'],
                        'attendance_date' => $attendanceDate->format('Y-m-d'),
                        'attended_at' => $checkIn,
                        'source' => 'app',
                        'created_at' => $checkIn,
                        'updated_at' => $checkOut,
                        

                    ]);
                }
            }

            // =========================================================
            // 8) EMPLOYEE ATTENDANCE
            // =========================================================

            foreach ($employees as $employeeIndex => $employeeId) {

                // حضور 18 يوم لكل موظف
                for ($day = 0; $day < 18; $day++) {

                    $attendanceDate = $now
                        ->copy()
                        ->subDays($day)
                        ->startOfDay();

                    // بعض الأيام لا يوجد حضور لبعض الموظفين
                    if (($employeeIndex + $day) % 6 === 0) {
                        continue;
                    }

                    $late = (($employeeIndex + $day) % 5 === 0);

                    $hour = $late ? 9 : 8;
                    $minute = $late
                        ? 15 + (($employeeIndex * 7 + $day) % 20)
                        : 0 + (($employeeIndex * 5 + $day) % 20);

                    $recordedAt = $attendanceDate
                        ->copy()
                        ->setTime($hour, $minute);

                    DB::table('employee_attendance_logs')->insert([
                        'employee_id' => $employeeId,
                        'attendance_date' => $attendanceDate->format('Y-m-d'),
                        'recorded_at' => $recordedAt,
                        'status' => $late ? 'late' : 'present',
                        'created_at' => $recordedAt,
                        'updated_at' => $recordedAt,
                    ]);
                }
            }

            // =========================================================
            // 9) TRAINING PLANS
            // بيانات بسيطة حتى صفحات الموظف والمدرب لا تكون فارغة
            // =========================================================

            $trainingPlans = [
                [
                    'coach_id' => $employees[0],
                    'player_id' => $players[0]['id'],
                    'title' => 'خطة بناء العضلات',
                    'level' => 'beginner',
                ],
                [
                    'coach_id' => $employees[1],
                    'player_id' => $players[5]['id'],
                    'title' => 'خطة اللياقة العامة',
                    'level' => 'intermediate',
                ],
                [
                    'coach_id' => $employees[2],
                    'player_id' => $players[9]['id'],
                    'title' => 'خطة القوة المتقدمة',
                    'level' => 'advanced',
                ],
                [
                    'coach_id' => $employees[3],
                    'player_id' => $players[15]['id'],
                    'title' => 'خطة التمارين الوظيفية',
                    'level' => 'advanced',
                ],
            ];

            foreach ($trainingPlans as $trainingPlan) {

                $trainingPlanId = DB::table('training_plans')->insertGetId([
                    'coach_id' => $trainingPlan['coach_id'],
                    'player_id' => $trainingPlan['player_id'],
                    'is_custom' => false,
                    'title' => $trainingPlan['title'],
                    'level' => $trainingPlan['level'],
                    'start_date' => $now->copy()->subDays(15)->format('Y-m-d'),
                    'end_date' => $now->copy()->addDays(45)->format('Y-m-d'),
                    'created_at' => $now->copy()->subDays(15),
                    'updated_at' => $now,
                ]);

                // تمارين الخطة
                $exercises = [
                    ['بنش برس', 4, 10, '90 ثانية'],
                    ['سكوات', 4, 12, '90 ثانية'],
                    ['سحب أمامي', 3, 12, '60 ثانية'],
                    ['بايسبس', 3, 12, '60 ثانية'],
                ];

                foreach ($exercises as $exerciseIndex => [$name, $sets, $reps, $rest]) {

                    DB::table('plans')->insert([
                        'training_plan_id' => $trainingPlanId,
                        'name' => $name,
                        'sets' => $sets,
                        'reps' => $reps,
                        'rest_time' => $rest,
                        'day_of_week' => ($exerciseIndex % 4) + 1,
                        'order' => $exerciseIndex + 1,
                        'instructions' => 'حافظ على الحركة الصحيحة والتنفس المنتظم أثناء التمرين.',
                        'image_path' => null,
                        'video_url' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }

            // =========================================================
            // SUMMARY
            // =========================================================

            $this->command->newLine();

            $this->command->info('==============================================');
            $this->command->info('   Elite Club Demo Data Created Successfully');
            $this->command->info('==============================================');

            $this->command->table(
                ['البيان', 'العدد'],
                [
                    ['الموظفون / المدربون', count($employees)],
                    ['اللاعبون', count($players)],
                    ['الباقات', count($planTypes)],
                    ['الاشتراكات', DB::table('memberships')->count()],
                    ['Payments', DB::table('payments')->count()],
                    ['حضور اللاعبين', DB::table('redesign_attendance_logs')->count()],
                    ['حضور الموظفين', DB::table('employee_attendance_logs')->count()],
                    ['الخطط التدريبية', DB::table('training_plans')->count()],
                ]
            );

            $this->command->newLine();

            $this->command->info('🔑 كلمة المرور لجميع حسابات الـ Demo: password');
            $this->command->info('📧 الموظفون: *@eliteclub.local');
            $this->command->info('📧 اللاعبون: player1.demo@eliteclub.local ... player20.demo@eliteclub.local');

            $this->command->newLine();

            $this->command->info('📊 بيانات Dashboard جاهزة:');
            $this->command->info('   - Active subscriptions');
            $this->command->info('   - Expired subscriptions');
            $this->command->info('   - Pending subscription');
            $this->command->info('   - Players without subscription');
            $this->command->info('   - Revenue for last 6 months');
            $this->command->info('   - Player attendance');
            $this->command->info('   - Employee attendance');
            $this->command->info('   - Training plans');

            $this->command->newLine();
        });
    }

    // =============================================================
    // PAYMENT HELPER
    // =============================================================

    private function createPayment(
        int $playerId,
        ?int $membershipId,
        ?int $planTypeId,
        float $amount,
        string $type,
        Carbon $paidAt
    ): void {

        DB::table('payments')->insert([
            'player_id' => $playerId,
            'membership_id' => $membershipId,
            'plan_type_id' => $planTypeId,

            // مهم جداً:
            // amount مطلوب في قاعدة البيانات
            'amount' => $amount,

            'type' => $type,
            'paid_at' => $paidAt,

            'created_at' => $paidAt,
            'updated_at' => $paidAt,
        ]);
    }

    // =============================================================
    // CLEANUP
    // =============================================================

    private function cleanup(): void
    {
        /*
         * نحذف فقط بيانات الـ Demo الخاصة بهذا Seeder.
         * لا نلمس بيانات المستخدمين الحقيقية.
         */

        $demoPlayerIds = DB::table('players')
            ->where('email', 'like', '%@eliteclub.local')
            ->pluck('id')
            ->toArray();

        $demoEmployeeIds = DB::table('employees')
            ->where('email', 'like', '%@eliteclub.local')
            ->pluck('id')
            ->toArray();

        // ---------------------------------------------------------
        // Player related data
        // ---------------------------------------------------------

        if (!empty($demoPlayerIds)) {

            DB::table('payments')
                ->whereIn('player_id', $demoPlayerIds)
                ->delete();

            DB::table('redesign_attendance_logs')
                ->whereIn('player_id', $demoPlayerIds)
                ->delete();

            DB::table('memberships')
                ->whereIn('player_id', $demoPlayerIds)
                ->delete();

            DB::table('plans')
                ->whereIn(
                    'training_plan_id',
                    DB::table('training_plans')
                        ->whereIn('player_id', $demoPlayerIds)
                        ->pluck('id')
                )
                ->delete();

            DB::table('training_plans')
                ->whereIn('player_id', $demoPlayerIds)
                ->delete();

            DB::table('players')
                ->whereIn('id', $demoPlayerIds)
                ->delete();
        }

        // ---------------------------------------------------------
        // Employee related data
        // ---------------------------------------------------------

        if (!empty($demoEmployeeIds)) {

            DB::table('employee_attendance_logs')
                ->whereIn('employee_id', $demoEmployeeIds)
                ->delete();

            DB::table('redesign_attendance_logs')
                ->whereIn('employee_id', $demoEmployeeIds)
                ->delete();

            DB::table('training_plans')
                ->whereIn('coach_id', $demoEmployeeIds)
                ->get()
                ->each(function ($trainingPlan) {
                    DB::table('plans')
                        ->where('training_plan_id', $trainingPlan->id)
                        ->delete();
                });

            DB::table('training_plans')
                ->whereIn('coach_id', $demoEmployeeIds)
                ->delete();

            DB::table('employees')
                ->whereIn('id', $demoEmployeeIds)
                ->delete();
        }

        // ---------------------------------------------------------
        // Demo plan types فقط
        // ---------------------------------------------------------

        DB::table('plan_types')
            ->whereIn('name', [
                'شهري',
                'ربع سنوي',
                'نصف سنوي',
                'سنوي',
            ])
            ->whereNotIn(
                'id',
                DB::table('memberships')
                    ->whereNotNull('plan_type_id')
                    ->pluck('plan_type_id')
            )
            ->delete();
    }
}