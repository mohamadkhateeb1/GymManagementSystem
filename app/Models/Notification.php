<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'player_id',
        'type',
        'title',
        'body',
        'sent_at',
        'read_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

  
    public function scopeUnsent($query)
    {
        return $query->whereNull('sent_at');
    }
}