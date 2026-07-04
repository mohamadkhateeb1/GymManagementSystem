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
        Schema::create('body_progress', function (Blueprint $table) {
            $table->id();
            
            // 🔗 ربط السجل باللاعب وحذفه تلقائياً في حال حذف اللاعب
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();
            
            // 📊 القياسات البدنية المطلوبة للتتبع
            $table->decimal('weight', 5, 2); // الوزن الحالي بالكيلوجرام
            $table->decimal('body_fat_pct', 4, 1)->nullable(); // نسبة الدهون % (اختياري)
            $table->decimal('muscle_mass', 5, 2)->nullable(); // كتلة العضلات بالكيلو (اختياري)
            
            // ✍️ تحديد من قام بالإدخال (اللاعب نفسه أم المدرب)
            $table->string('recorded_by')->default('player'); // 'player' أو 'coach'
            
            $table->timestamps();
        });
    }

    /**
                 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('body_progress');
    }
};