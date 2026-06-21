<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('training_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('employees')->cascadeOnDelete();

            // حقل اللاعب nullable لأن الخطة تُخزن بالبنك أولاً كخطة عامة للمستوى
            $table->foreignId('player_id')->nullable()->constrained('players')->cascadeOnDelete();

            // حقل المستوى المستهدف (beginner, intermediate, advanced)
            $table->string('level')->nullable();

            // تم تحويله إلى text ليستوعب تفاصيل الجداول والتمارين الطويلة بدون أخطاء مساحة
            $table->text('plan_details');

            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_plans');
    }
};
