<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'plan_details',
        'start_date',
        'end_date',
        'level',
        'meal_name',
        'calories',
        'image_path',   
    ];
}
