<?php
// هذا 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * إعادة تصميم جدول حضور اللاعبين ليصبح تسجيلاً يومياً واحداً فقط
     * (بلا دخول/خروج)، ومخصصاً للاعب حصراً — حضور الموظف له جدوله
     * المستقل employee_attendance_logs ولم يتأثر بهذا التعديل.
     *
     * الجدول القديم لم يكن مستخدَماً في أي مكان بالمشروع (تحقّقنا
     * قبل الحذف)، لذلك تُعاد بناؤه من الصفر بدل تعديل تدريجي.
     */
    public function up(): void
    {
        // Schema::dropIfExists('attendance_logs');

        Schema::create('redesign_attendance_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();

            // تاريخ الحضور بدون وقت، يُستخدم مع player_id لمنع أي تكرار لنفس اليوم
            $table->date('attendance_date');

            // لحظة تسجيل الحضور الفعلية — تُحفظ لأغراض التحليل
            // (ساعات الذروة، الإشغال اللحظي) دون أن تعني "دخول/خروج"
            $table->timestamp('attended_at');

            // مصدر التسجيل: من تطبيق اللاعب أو يدوياً من المدرب مستقبلاً
            $table->enum('source', ['app', 'coach'])->default('app');

            $table->timestamps();

            // 🔒 القيد الذي يضمن تسجيلاً واحداً فقط لكل لاعب في كل يوم
            $table->unique(['player_id', 'attendance_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');

        // إعادة الشكل القديم عند التراجع، حفاظاً على قابلية الـ rollback
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->nullable()->constrained('players')->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->cascadeOnDelete();
            $table->enum('attendance_type', ['player', 'coach'])->default('player');
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->timestamps();
        });
    }
};