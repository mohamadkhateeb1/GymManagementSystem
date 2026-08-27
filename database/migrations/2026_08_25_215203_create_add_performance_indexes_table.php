<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إضافة Indexes على الأعمدة التي تُستعلم عليها بشكل متكرر
     * (فحص الاشتراكات، فلترة الخطط والوجبات حسب المستوى، توزيع اللاعبين).
     * لا أثر لهذا التعديل على البيانات أو المنطق — تحسين أداء بحت،
     * وفائدته تظهر مع نمو حجم البيانات.
     */
    public function up(): void
    {
        // 🔎 فحص الاشتراك الفعّال يعتمد دائماً على status و end_date معاً
        Schema::table('memberships', function (Blueprint $table) {
            $table->index(['status', 'end_date']);
        });

        // 🔎 استعلامات بنك الخطط التدريبية: لكل مدرب، حسب المستوى، بنكية أو خاصة بلاعب
        Schema::table('training_plans', function (Blueprint $table) {
            $table->index(['coach_id', 'level', 'player_id']);
        });

        // 🔎 نفس نمط الاستعلام تماماً في بنك الوجبات الغذائية
        Schema::table('diet_plans', function (Blueprint $table) {
            $table->index(['coach_id', 'level', 'player_id']);
        });

        // 🔎 توزيع لاعبي كل مدرب حسب المستوى (عدّادات داشبورد المدرب، وتوزيع الخطط)
        Schema::table('players', function (Blueprint $table) {
            $table->index(['coach_id', 'level']);
        });
    }

    public function down(): void
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->dropIndex(['status', 'end_date']);
        });

        Schema::table('training_plans', function (Blueprint $table) {
            $table->dropIndex(['coach_id', 'level', 'player_id']);
        });

        Schema::table('diet_plans', function (Blueprint $table) {
            $table->dropIndex(['coach_id', 'level', 'player_id']);
        });

        Schema::table('players', function (Blueprint $table) {
            $table->dropIndex(['coach_id', 'level']);
        });
    }
};