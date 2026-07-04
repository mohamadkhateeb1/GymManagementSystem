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
        Schema::create('employee_attendance_logs', function (Blueprint $table) {
            $table->id();

            // 🔗 ربط السجل بالموظف/المدرب (من جدول employees)
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();

            // 📅 تسجيل وقت الدخول والخروج واليوم الحالي
            $table->date('attendance_date'); // تاريخ اليوم (لتسهيل الفلترة والتقارير اليومية)
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();

            // 📝 حالة الحضور (حاضر، متأخر، مغادرة مبكرة) لضمان دقة التقارير
            $table->string('status')->default('present'); // active, late, etc.

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_attendance_logs');
    }
};
