<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class PaymentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('payment.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view($user): bool
    {
        return $user->hasAbility('payment.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create($user): bool
    {
        return $user->hasAbility('payment.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user): bool
    {
        return $user->hasAbility('payment.update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user): bool
    {
        return $user->hasAbility('payment.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore($user): bool
    {
        return $user->hasAbility('payment.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete($user): bool
    {
        return $user->hasAbility('payment.forceDelete');
    }
}
