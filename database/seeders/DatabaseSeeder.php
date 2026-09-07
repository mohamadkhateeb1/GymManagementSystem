<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * 🛡️ البيانات التجريبية (سوبر أدمن بكلمة سر ثابتة، موظفون ولاعبون وهميون)
     * لا تُنشأ إطلاقاً في بيئة الإنتاج. على السيرفر يُنشأ الأدمن الحقيقي فقط
     * عبر ProductionAdminSeeder الذي يقرأ البيانات من .env.
     */
    public function run(): void
    {
        // if (app()->environment('production')) {
        //     $this->call(ProductionAdminSeeder::class);
        //     return;
        // }

        // // ----- بيئات التطوير/الاختبار فقط -----
        // User::factory()->create([
        //     'name'  => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(EmployeeSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TestScenarioSeeder::class);
        $this->call(EmployeeDemoSeeder::class);
        $this->call(AppDemoSeeder::class);
    }
}