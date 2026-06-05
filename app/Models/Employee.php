<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable, HasRoles;
    protected $fillable = [
        'name',
        'email',
        'password',
        'specialization',
    ];

    protected $hidden = [
        'password',
    ];
    public function trainingPlans()
    {
        return $this->hasMany(TrainingPlan::class, 'coach_id');
    }

    public function dietPlans()
    {
        return $this->hasMany(DietPlan::class, 'coach_id');
    }
    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }
    public function players()
    {
        return $this->hasMany(Player::class, 'coach_id');
    }
}
