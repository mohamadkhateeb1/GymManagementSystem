<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'player_id',
        'membership_id',
        'plan_type_id',
        'amount',
        'type',
        'paid_at',
    ];

    protected $casts = [
        'amount'  => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function planType()
    {
        return $this->belongsTo(PlanType::class);
    }

   
    public function scopeInMonth($query, ?\Carbon\Carbon $month = null)
    {
        $month = $month ?? now();

        return $query->whereYear('paid_at', $month->year)
            ->whereMonth('paid_at', $month->month);
    }
}