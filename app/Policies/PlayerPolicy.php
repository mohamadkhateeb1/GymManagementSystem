<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\Admin;

class PlayerPolicy
{
    /**
     * View players.
     */
    public function viewAny( $user): bool
    {
        return $user->hasAbility('player.view');
    }

    /**
     * View a specific player.
     */
    public function view($user): bool
    {
        return $user->hasAbility('player.show');
    }

    /**
     * Create a player.
     */
    public function create( $user): bool
    {
        return $user->hasAbility('player.create');
    }

    /**
     * Update a player.
     */
    public function update( $user, Player $player): bool
    {
        return $user->hasAbility('player.edit');
    }

    /**
     * Delete a player.
     */
    public function delete( $user, Player $player): bool
    {
        return $user->hasAbility('player.delete');
    }
}