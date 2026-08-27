<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * جدول الباقات: يحدّده الأدمن بالكامل من الواجهة (اسم، مدة، سعر، تجميد).
     * لا قيم افتراضية مبدئية — أول باقة يضيفها الأدمن نفسه عند أول استخدام.
     */
    public function up(): void
    {
        Schema::create('plan_types', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // اسم الباقة كما يكتبه الأدمن: شهري / ربع سنوي / نصف سنوي / سنوي...

            $table->unsignedInteger('duration_days'); // مدة الباقة بالأيام (دقيقة، بلا تقريب أشهر)

            $table->decimal('price', 10, 2); // السعر الحالي للباقة

            $table->unsignedTinyInteger('freeze_days_allowed')->default(0); // عدد أيام التجميد المسموحة سنوياً

            $table->boolean('is_active')->default(true); // إخفاء باقة قديمة عن قائمة الإضافة بلا حذفها

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plan_types');
    }
};