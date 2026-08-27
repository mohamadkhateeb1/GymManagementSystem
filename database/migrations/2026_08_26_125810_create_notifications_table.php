<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * سجل إشعارات مستقل (بديل مبسّط عن نظام Laravel Notifications الجاهز)
     * يخزّن "نية الإرسال" فقط. الإرسال الفعلي (Push/SMS) سيتم لاحقاً عبر
     * API عندما يُبنى الاتصال بالتطبيق — هذا الجدول هو الأساس الذي سيقرأ
     * منه الـ API لاحقاً بلا إعادة تصميم.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('player_id')->constrained('players')->cascadeOnDelete();

            // نوع الإشعار: قابل للتوسع لاحقاً (تذكير حصة، تقييم جديد...)
            $table->string('type'); // subscription_expiring | subscription_expired

            $table->string('title');
            $table->text('body');

            // تُملأ لاحقاً عند الإرسال الفعلي عبر API — تبقى null حالياً
            $table->timestamp('sent_at')->nullable();

            // تُملأ عندما يفتح اللاعب الإشعار بالتطبيق (مستقبلاً)
            $table->timestamp('read_at')->nullable();

            $table->timestamps();

            // منع تكرار نفس نوع الإشعار لنفس اللاعب بنفس اليوم
            $table->index(['player_id', 'type', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};