<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    /**
     * 🛡️ إنشاء دور جديد مع كل صلاحياته دفعة وحدة، محمي بمعاملة قاعدة بيانات (Transaction).
     * لو فشلت أي خطوة بالمنتصف (مثلاً صلاحية غير صحيحة)، يتم التراجع عن كل شي تلقائياً
     * بدل ما نبقى بدور منشأ جزئياً بلا صلاحيات كاملة.
     */
    public static function createWithAbilities($request)
    {
        return DB::transaction(function () use ($request) {
            $role = Role::create([
                'name' => $request->name,
            ]);

            foreach ($request->ability as $ability => $value) {
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability,
                    'type'    => $value,
                ]);
            }

            return $role;
        });
    }

    /**
     * 🛡️ نفس الحماية عند التعديل — إما تنجح كل الخطوات معاً، أو يتراجع عن الكل.
     */
    public function updateWithAbilities($request)
    {
        return DB::transaction(function () use ($request) {
            $this->update([
                'name' => $request->input('name'),
            ]);

            foreach ($request->input('ability', []) as $ability => $value) {
                RoleAbility::updateOrCreate(
                    [
                        'role_id' => $this->id,
                        'ability' => $ability,
                    ],
                    [
                        'type' => $value,
                    ]
                );
            }

            return $this;
        });
    }
}
