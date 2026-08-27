<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'player_ratings'; 

    protected $fillable = [
        'coach_id',
        'player_id',
        'rating',
        'feedback',
    ];

    public function coach()
    {
        return $this->belongsTo(Employee::class, 'coach_id');
    }

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
