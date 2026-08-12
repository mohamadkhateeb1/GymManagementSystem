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
        'instructions',
        'image_path',
        'video_url',
    ];

    public function trainingPlan()
    {
        return $this->belongsTo(TrainingPlan::class, 'training_plan_id');
    }
}