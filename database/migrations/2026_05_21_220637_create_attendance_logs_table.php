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
    
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            
            // ربط السجل باللاعب (يكون null إذا كان المدرب هو من سجل حضور)
            $table->foreignId('player_id')->nullable()->constrained('players')->cascadeOnDelete();
            
            // ربط السجل بالمدرب/الموظف (يكون null إذا كان اللاعب هو من سجل حضور)
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            
            // تحديد نوع الحضور برمجياً لسهولة الفلترة
            $table->enum('attendance_type', ['player', 'coach'])->default('player');
            
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
