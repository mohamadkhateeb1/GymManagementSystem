<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'title',
        'level',
        'start_date',
        'end_date',
        
    ];
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    public function exercises()
    {
        return $this->hasMany(Plan::class);
    }
}
