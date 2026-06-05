<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'membership_id',
        'date_of_birth',
        'height',
        'weight',
        'phone',
        'coach_id',

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
    // بنستخدم hasOne بما أن الاشتراك الواحد غالباً مرتبط بحالة اللاعب الحالية
    return $this->hasOne(Membership::class);
}
}
