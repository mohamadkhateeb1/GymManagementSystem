<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'player_id',
        'plan_type_id',
        'price_paid',
        'start_date',
        'end_date',
        'status',
        'plan_name',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'price_paid' => 'decimal:2',
    ];

    
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->whereDate('end_date', '>=', now()->toDateString());
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

   
    public function planType()
    {
        return $this->belongsTo(PlanType::class);
    }
    
    public function isExpired()
{
    return \Carbon\Carbon::now()->greaterThan(\Carbon\Carbon::parse($this->end_date)->endOfDay());
}
}