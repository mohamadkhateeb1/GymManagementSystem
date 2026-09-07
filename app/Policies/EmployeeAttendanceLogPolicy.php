<?php

namespace App\Policies;

use App\Models\EmployeeAttendanceLog;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class EmployeeAttendanceLogPolicy
{
    public function viewAny($user): bool
    {
        return $user->hasAbility('employee_attendance.view');
    }

    
    public function view($user, EmployeeAttendanceLog $employeeAttendanceLog): bool
    {
        return $user->hasAbility('employee_attendance.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('employee_attendance.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, EmployeeAttendanceLog $employeeAttendanceLog): bool
    {
        return $user->hasAbility('employee_attendance.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, EmployeeAttendanceLog $employeeAttendanceLog): bool
    {
        return $user->hasAbility('employee_attendance.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user, EmployeeAttendanceLog $employeeAttendanceLog): bool
    {
        return $user->hasAbility('employee_attendance.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user, EmployeeAttendanceLog $employeeAttendanceLog): bool
    {
        return $user->hasAbility('employee_attendance.forceDelete');
    }
}
