<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];
    public function abilities()
    {
        return $this->hasMany(RoleAbility::class, 'role_id');
    }
    public function admins() 
    {
        return $this->morphedByMany(Admin::class, 'authorizable', 'role_user');
    }
    public function employees() 
    {
        return $this->morphedByMany(Employee::class, 'authorizable', 'role_user');
    }
       public static function createWithAbilities($request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);
        foreach ($request->ability as $ability => $value) {
            RoleAbility::create([
                'role_id' => $role->id,
                'ability' => $ability,
                'type' => $value,
            ]);
        }
        return $role;
    }
    public function updateWithAbilities($request)
    {
        $this->update([
            'name' => $request->post('name'),
        ]);
        foreach ($request->post('ability') as $ability => $value) {
            RoleAbility::updateOrCreate([
                'role_id' => $this->id,
                'ability' => $ability,
            ], [
                'type' => $value,
            ]);
        }
        return $this;
    }
    
}
