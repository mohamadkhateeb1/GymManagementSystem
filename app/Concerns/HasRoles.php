<?php

namespace App\Concerns;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;

trait HasRoles
{

  
    public function hasAbility($ability)
    {
        Gate::before(function ($user, $ability) {
            if ($user->super_admin) {
                return true;
            }
        });
        return $this->roles()->whereHas('abilities', function ($q) use ($ability) { // abilities هي العلاقة بين الرول والابيليتيز
            $q->where('ability', '=', $ability) // فحص اذا الابيليتيز فيها الصلاحية المطلوبة
                ->where('type', '=', 'allow'); // نوعها السماح
        })->exists();
    }
      public function roles()
    {
        return $this->morphToMany(Role::class, 'authorizable', 'role_user');
    }
}
