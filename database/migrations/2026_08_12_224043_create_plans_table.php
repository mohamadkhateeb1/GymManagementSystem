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
        Schema::create('plans', function (Blueprint $table) {

            $table->id();
            // الربط بالخطة التدريبية
            $table->foreignId('training_plan_id')->constrained('training_plans')->cascadeOnDelete();

            $table->string('name'); // اسم التمرين (مثلاً: بنش برس مستوي)
            $table->integer('sets')->default(4); // عدد الجولات
            $table->integer('reps')->default(12); // عدد التكرارات
            $table->string('rest_time')->nullable(); // مدة الراحة بين الجولات (نص مرن: 90 ثانية / دقيقة ونصف)
            $table->unsignedTinyInteger('day_of_week')->nullable(); // يوم التمرين: 1=السبت ... 7=الجمعة
            $table->unsignedInteger('order')->default(0); // ترتيب التمرين داخل اليوم
            $table->text('instructions')->nullable(); // شرح كيفية أداء التمرين
            $table->string('image_path')->nullable(); // صورة توضيحية للتمرين
            $table->string('video_url')->nullable(); // رابط فيديو لشرح التمرين
            $table->timestamps();

            $table->index(['training_plan_id', 'day_of_week']); // لتسريع جلب تمارين يوم معيّن
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};