<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
        'player_id',
        'attendance_date',
        'attended_at',
        'source',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'attended_at'      => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public static function recordToday(int $playerId, string $source = 'app'): self
    {
        return static::firstOrCreate(
            [
                'player_id'        => $playerId,
                'attendance_date'  => now()->toDateString(),
            ],
            [
                'attended_at' => now(),
                'source'      => $source,
            ]
        );
    }
}