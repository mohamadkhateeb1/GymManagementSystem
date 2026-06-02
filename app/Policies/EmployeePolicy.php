<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('employee.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user  , Employee $employee): bool
    {
        return $user->hasAbility('employee.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('employee.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user): bool
    {
        return $user->hasAbility('employee.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user): bool
    {
        return $user->hasAbility('employee.delete');
    }

}
