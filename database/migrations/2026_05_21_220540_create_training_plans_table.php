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

            // 🆕 يميّز الحاوية المخفية الخاصة بتمارين اللاعب اليدوية عن الخطط
            // النازلة من بنك المستوى العام (سواء كانت بنك أو نسخة موزَّعة للاعب)
            $table->boolean('is_custom')->default(false);

            // 🎯 اسم الخطة التدريبية
            $table->string('title');

            // 🎯 المستوى المستهدف (beginner, intermediate, advanced)
            $table->string('level')->nullable();

            // التواريخ
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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