<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DietPlan extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'is_custom',
        'plan_details',
        'start_date',
        'end_date',
        'level',
        'meal_name',
        'calories',
        'protein',
        'carbs',
        'fats',
        'image_path',   
    ];

    protected $casts = [
        'is_custom' => 'boolean',
        // 🔧 حرج: بلا هالتحويل، هالأعمدة (نوعها decimal بقاعدة البيانات)
        // بترجع كنص (String) بالـ JSON بدل رقم، وهاد بيكسر أي Client
        // بيتوقع رقماً صريحاً (متل تطبيق فلاتر) — 'float' يضمن رقماً حقيقياً دايماً.
        'protein' => 'float',
        'carbs' => 'float',
        'fats' => 'float',
    ];
}