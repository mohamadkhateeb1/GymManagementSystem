<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyProgress extends Model
{
    protected $fillable = [
        'player_id',
        'weight',
        'body_fat_percentage',
        'muscle_mass',
        'progress_date',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
}
