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
        Schema::create('diet_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('employees')->cascadeOnDelete();

            // جعل حقل اللاعب nullable لأنه يُخزن بالبنك أولاً كخطة عامة
            $table->foreignId('player_id')->nullable()->constrained('players')->cascadeOnDelete();

            // حقل لتحديد المستوى المستهدف عند الربط
            $table->string('level')->nullable();

            $table->string('meal_name')->nullable(); // اسم الوجبة
            $table->integer('calories')->nullable();  // السعرات الحرارية
            $table->string('image_path')->nullable(); // حقل الصورة الجديد
            $table->text('plan_details');            // المكونات والتفاصيل (Text)

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
        Schema::dropIfExists('diet_plans');
    }
};
