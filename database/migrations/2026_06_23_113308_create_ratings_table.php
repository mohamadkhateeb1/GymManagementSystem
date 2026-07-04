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
         Schema::create('player_ratings', function (Blueprint $table) {
            $table->id();
            // ربط التقييم بالموظف (المدرب) الذي قام بالتقييم
            $table->foreignId('coach_id')->constrained('employees')->cascadeOnDelete();
            // ربط التقييم باللاعب المستهدف
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            
            $table->integer('rating'); // حقل النجوم أو الدرجة (مثلاً من 1 إلى 5)
            $table->text('feedback')->nullable(); // ملاحظات ومراجعة المدرب للاعب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
