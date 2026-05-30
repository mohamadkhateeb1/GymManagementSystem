<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable,TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }
}