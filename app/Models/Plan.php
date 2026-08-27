<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';

    protected $fillable = [
        'training_plan_id',
        'name',
        'sets',
        'reps',
        'rest_time',
        'day_of_week',
        'order',
        'instructions',
        'image_path',
        'video_url',
    ];

    public const DAYS = [
        1 => 'السبت',
        2 => 'الأحد',
        3 => 'الإثنين',
        4 => 'الثلاثاء',
        5 => 'الأربعاء',
        6 => 'الخميس',
        7 => 'الجمعة',
    ];

   
    public function getDayNameAttribute(): string
    {
        return self::DAYS[$this->day_of_week] ?? 'غير محدد';
    }

    public function trainingPlan()
    {
        return $this->belongsTo(TrainingPlan::class, 'training_plan_id');
    }
}
