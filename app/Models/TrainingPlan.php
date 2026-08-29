<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'is_custom',
        'title',
        'level',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'is_custom' => 'boolean',
    ];

    public function exercises()
    {
        return $this->hasMany(Plan::class, 'training_plan_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function coach()
    {
        return $this->belongsTo(Employee::class, 'coach_id');
    }
}