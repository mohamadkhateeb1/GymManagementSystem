<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Player;
use App\Models\TrainingPlan;
use App\Models\Plan;
use App\Models\Membership;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeDemoSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | الموظفين
        |--------------------------------------------------------------------------
        | لا ننشئ الموظف إذا كان الإيميل موجود مسبقاً.
        */

        $employees = [
            [
                'name' => 'أحمد خالد',
                'email' => 'ahmad.elite@test.local',
                'password' => Hash::make('password'),
                'specialization' => 'كمال أجسام',
            ],
            [
                'name' => 'محمود سامي',
                'email' => 'mahmoud.elite@test.local',
                'password' => Hash::make('password'),

                'specialization' => 'لياقة بدنية',
            ],
            [
                'name' => 'عمر يوسف',
                'email' => 'omar.elite@test.local',
                'password' => Hash::make('password'),

                'specialization' => 'قوة وتحمل',
            ],
        ];

        $coaches = [];

        foreach ($employees as $data) {

            $coach = Employee::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'specialization' => $data['specialization'],
                ]
            );

            $coaches[] = $coach;
        }


        /*
        |--------------------------------------------------------------------------
        | اللاعبين
        |--------------------------------------------------------------------------
        */

        $players = [
            [
                'name' => 'كريم أحمد',
                'email' => 'karim.elite@test.local',
                'coach' => 0,
                                'password' => Hash::make('password'),

                'level' => 'beginner',
                'phone' => '0999000011',
                'date_of_birth' => '2001-03-15',
                'height' => 175,
                'weight' => 72,
            ],
            [
                'name' => 'رامي خالد',
                'email' => 'rami.elite@test.local',
                                'password' => Hash::make('password'),

                'coach' => 0,
                'level' => 'intermediate',
                'phone' => '0999000012',
                'date_of_birth' => '1999-07-20',
                'height' => 181,
                'weight' => 81,
            ],
            [
                'name' => 'أنس محمد',
                                'password' => Hash::make('password'),

                'email' => 'anas.elite@test.local',
                'coach' => 1,
                'level' => 'beginner',
                'phone' => '0999000013',
                'date_of_birth' => '2002-01-10',
                'height' => 178,
                'weight' => 76,
            ],
            [
                'name' => 'ياسر علي',
                'email' => 'yasser.elite@test.local',
                'password' => Hash::make('password'),
                'coach' => 1,
                'level' => 'advanced',
                'phone' => '0999000014',
                'date_of_birth' => '1997-11-05',
                'height' => 183,
                'weight' => 87,
            ],
            [
                'name' => 'حسام فؤاد',
                'email' => 'hossam.elite@test.local',
                'password' => Hash::make('password'),
                'coach' => 2,
                'level' => 'intermediate',
                'phone' => '0999000015',
                'date_of_birth' => '2000-05-25',
                'height' => 176,
                'weight' => 79,
            ],
            [
                'name' => 'وليد ناصر',
                'email' => 'walid.elite@test.local',
                'password' => Hash::make('password'),
                'coach' => 2,
                'level' => 'advanced',
                'phone' => '0999000016',
                'date_of_birth' => '1998-09-12',
                'height' => 185,
                'weight' => 90,
            ],
        ];

        $createdPlayers = [];

        foreach ($players as $data) {

            $player = Player::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'coach_id' => $coaches[$data['coach']]->id,
                    'date_of_birth' => $data['date_of_birth'],
                    'height' => $data['height'],
                    'weight' => $data['weight'],
                    'phone' => $data['phone'],
                    'level' => $data['level'],
                    'status' => 'active',
                ]
            );

            $createdPlayers[] = $player;
        }


        /*
        |--------------------------------------------------------------------------
        | بنك الخطط التدريبية
        |--------------------------------------------------------------------------
        */

        $trainingPlans = [
            [
                'title' => 'خطة بناء الأساس',
                'level' => 'beginner',
                'coach' => 0,
                'exercises' => [
                    ['بنش برس', 3, 12],
                    ['سكوات', 3, 12],
                    ['سحب أمامي', 3, 10],
                    ['ضغط كتف', 3, 12],
                ],
            ],
            [
                'title' => 'خطة تطوير القوة',
                'level' => 'intermediate',
                'coach' => 0,
                'exercises' => [
                    ['بنش برس', 4, 10],
                    ['سكوات', 4, 10],
                    ['سحب أرضي', 4, 10],
                    ['ضغط كتف بالدمبل', 3, 10],
                ],
            ],
            [
                'title' => 'خطة القوة المتقدمة',
                'level' => 'advanced',
                'coach' => 1,
                'exercises' => [
                    ['سكوات حر', 5, 6],
                    ['بنش برس', 5, 6],
                    ['Deadlift', 4, 6],
                    ['Barbell Row', 4, 8],
                ],
            ],
            [
                'title' => 'خطة التضخيم المتقدم',
                'level' => 'advanced',
                'coach' => 2,
                'exercises' => [
                    ['Incline Bench Press', 4, 10],
                    ['Lat Pulldown', 4, 10],
                    ['Leg Press', 4, 12],
                    ['Shoulder Press', 4, 10],
                ],
            ],
        ];

        foreach ($trainingPlans as $data) {

            $coachId = $coaches[$data['coach']]->id;

            /*
             * نبحث عن الخطة بنفس المدرب + العنوان.
             */
            $plan = TrainingPlan::firstOrCreate(
                [
                    'coach_id' => $coachId,
                    'title' => $data['title'],
                ],
                [
                    'player_id' => null,
                    'is_custom' => false,
                    'level' => $data['level'],
                    'start_date' => now(),
                    'end_date' => now()->addMonths(2),
                ]
            );

            /*
             * إضافة التمارين بدون تكرار.
             */
            foreach ($data['exercises'] as $index => $exercise) {

                Plan::firstOrCreate(
                    [
                        'training_plan_id' => $plan->id,
                        'name' => $exercise[0],
                    ],
                    [
                        'sets' => $exercise[1],
                        'reps' => $exercise[2],
                        'instructions' =>
                        'حافظ على الأداء الصحيح للحركة والتنفس المنتظم.',
                        'day_of_week' => ($index % 4) + 1,
                        'order' => $index + 1,
                    ]
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | الاشتراكات
        |--------------------------------------------------------------------------
        */

        foreach ($createdPlayers as $index => $player) {

            /*
             * لا ننشئ اشتراكاً إذا كان اللاعب لديه اشتراك مسبق.
             */
            $exists = Membership::where('player_id', $player->id)->exists();

            if ($exists) {
                continue;
            }

            $plans = [
                [
                    'name' => 'اشتراك شهري',
                    'days' => 30,
                ],
                [
                    'name' => 'اشتراك ربع سنوي',
                    'days' => 90,
                ],
                [
                    'name' => 'اشتراك سنوي',
                    'days' => 365,
                ],
            ];

            $membership = $plans[$index % count($plans)];

            Membership::create([
                'player_id' => $player->id,
                'plan_name' => $membership['name'],
                'start_date' => now(),
                'end_date' => now()->addDays($membership['days']),
                'status' => 'active',
            ]);
        }
    }
}
