<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'plan_details',
        'start_date',
        'end_date',
        'level',
        
    ];
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
