<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Player extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'date_of_birth',
        'height',
        'weight',
        'phone',
        'coach_id',
        'level', 

    ];

    protected $hidden = [
        'password',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class, 'player_id');
    }
    public function trainingPlans()
    {
        return $this->hasMany(TrainingPlan::class, 'player_id');
    }
    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class, 'player_id');
    }
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }
    public function coach()
    {
        return $this->belongsTo(Employee::class, 'coach_id');
    }
    public function subscription()
    {
        return $this->hasOne(Membership::class)->latestOfMany();
    }

  
    public function hasActiveSubscription(): bool
    {
        return $this->subscription
            && $this->subscription->status === 'active'
            && !$this->subscription->isExpired();
    }
  
    
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'player_id');
    }
    public function bodyProgress()
    {
        return $this->hasMany(BodyProgress::class, 'player_id');
    }

    public function latestBodyProgress()
    {
        return $this->hasOne(BodyProgress::class, 'player_id')->latestOfMany();
    }
}