<?php

namespace App\Policies;

use App\Models\AttendanceLog;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class AttendanceLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('attendance.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view( $user, AttendanceLog $attendanceLog): bool
    {
        return $user->hasAbility('attendance.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create( $user): bool
    {
        return $user->hasAbility('attendance.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update( $user, AttendanceLog $attendanceLog): bool
    {
        return $user->hasAbility('attendance.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete( $user, AttendanceLog $attendanceLog): bool
    {
        return $user->hasAbility('attendance.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore( $user, AttendanceLog $attendanceLog): bool
    {
        return $user->hasAbility('attendance.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete( $user, AttendanceLog $attendanceLog): bool
    {
        return $user->hasAbility('attendance.forceDelete');
    }
}
