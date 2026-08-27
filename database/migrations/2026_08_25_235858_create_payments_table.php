<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * سجل مالي دائم لكل دفعة فعلية (اشتراك جديد أو تجديد)، منفصل عن
     * memberships التي تعكس فقط "الحالة الحالية" للاشتراك. بهذا الفصل:
     * - تعديل/تجديد الاشتراك لا يمحي تاريخ الدفعات السابقة
     * - التقارير المالية تُبنى من مصدر واحد موثوق وثابت زمنياً
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();

            // الاشتراك الذي تخص هذه الدفعة نتيجته (قد يُحذف الاشتراك لاحقاً دون فقدان سجل الدفعة)
            $table->foreignId('membership_id')->nullable()->constrained('memberships')->nullOnDelete();

            // الباقة وقت الدفع، لعرضها بالتقارير حتى لو تغيّرت الباقة أو حُذفت لاحقاً
            $table->foreignId('plan_type_id')->nullable()->constrained('plan_types')->nullOnDelete();

            $table->decimal('amount', 10, 2); // المبلغ الفعلي المدفوع في هذه العملية تحديداً

            $table->enum('type', ['new', 'renewal'])->default('new'); // اشتراك جديد أو تجديد

            $table->timestamp('paid_at'); // لحظة الدفع الفعلية (تُستخدم في التقارير الشهرية)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};