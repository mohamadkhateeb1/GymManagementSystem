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
    $table->string('plan_name'); // إضافة اسم الخطة (مثلاً: شهري، سنوي)
    $table->date('start_date');
    $table->date('end_date');
    $table->enum('status', ['active', 'expired', 'pending'])->default('pending'); // التعديل للحالات المذكورة في التوثيق
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
