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
        //هذا جدول الاشتراكات بين اللاعبين والنوادي
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();

            // 🔗 ربط الاشتراك بالباقة التي أُنشئ عليها
            $table->foreignId('plan_type_id')->nullable()->constrained('plan_types')->nullOnDelete();

            // 💰 السعر الفعلي المدفوع وقت إنشاء هذا الاشتراك تحديداً، منفصل عن
            // plan_types.price حتى لا تتغيّر فواتير قديمة إذا عُدّل سعر الباقة لاحقاً
            $table->decimal('price_paid', 10, 2)->nullable();

            $table->string('plan_name'); // إضافة اسم الخطة (مثلاً: شهري، سنوي)
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired', 'pending'])->default('pending'); // التعديل للحالات المذكورة في التوثيق
            $table->softDeletes(); // حذف ناعم: يحافظ على السجل المالي حتى لو "حُذف" الاشتراك مستقبلاً
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
