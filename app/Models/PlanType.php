<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    protected $fillable = [
        'name',
        'duration_days',
        'price',
        'freeze_days_allowed',
        'is_active',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'is_active' => 'boolean',
    ];

   
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}