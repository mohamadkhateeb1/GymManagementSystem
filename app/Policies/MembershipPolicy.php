<?php

namespace App\Policies;

use App\Models\Membership;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class MembershipPolicy
{

    public function viewAny($user): bool
    {
        return $user->hasAbility('membership.view');
    }


    public function view($user): bool
    {
        return $user->hasAbility('membership.view');
    }


    public function create($user): bool
    {
        return $user->hasAbility('membership.create');
    }

    public function update($user): bool
    {
        return $user->hasAbility('membership.edit');
    }


    public function delete($user): bool
    {
        return $user->hasAbility('membership.delete');
    }


    public function restore($user): bool
    {
        return $user->hasAbility('membership.restore');
    }


    public function forceDelete($user): bool
    {
        return $user->hasAbility('membership.forceDelete');
    }
}
