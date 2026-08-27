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

            // 📅 تسجيل يوم الحضور ولحظة تسجيله (تسجيل واحد يومي فقط، بلا دخول/خروج)
            $table->date('attendance_date'); // تاريخ اليوم (لتسهيل الفلترة والتقارير اليومية)
            $table->timestamp('recorded_at'); // لحظة تسجيل الحضور الفعلية

            // 📝 حالة الحضور (حاضر، متأخر) لضمان دقة التقارير
            $table->string('status')->default('present'); // present, late

            $table->timestamps();

            // 🔒 يمنع أكثر من تسجيل حضور لنفس الموظف في نفس اليوم
            $table->unique(['employee_id', 'attendance_date']);
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