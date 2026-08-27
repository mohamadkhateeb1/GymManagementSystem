<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * مخزن دائم للإدارة المالية: كل "أرشفة" تحفظ نسخة كاملة (JSON) من بيانات
     * السجل وقت الرفع، مستقلة تماماً عن مصير السجل الأصلي لاحقاً (تعديل/حذف).
     * لا يوجد ربط Foreign Key بالسجل الأصلي عمداً — العلاقة بالمعرّف فقط
     * للمرجعية، حتى لا يتأثر الأرشيف إذا حُذف الأصل نهائياً.
     */
    public function up(): void
    {
        Schema::create('financial_archives', function (Blueprint $table) {
            $table->id();

            $table->string('archivable_type'); // 'membership' | 'payment'
            $table->unsignedBigInteger('archivable_id'); // رقم السجل الأصلي وقت الأرشفة

            $table->string('title'); // عنوان كامل بالتفاصيل (نوع السجل + مبلغ/باقة)، للاستخدام الداخلي
            $table->string('player_name')->nullable(); // اسم اللاعب فقط، يُعرض في جدول الأرشيف مباشرة

            $table->json('payload'); // 📦 نسخة كاملة من كل بيانات السجل وقت الأرشفة

            $table->foreignId('archived_by')->nullable()->constrained('admins')->nullOnDelete();
            $table->timestamp('archived_at');

            $table->timestamps();

            $table->index(['archivable_type', 'archivable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_archives');
    }
};