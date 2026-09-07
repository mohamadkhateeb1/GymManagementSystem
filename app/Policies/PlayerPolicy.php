<?php

namespace App\Policies;

use App\Models\Player;
use App\Models\Admin;

class PlayerPolicy
{
    /**
     * View players.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->hasAbility('player.view');
    }

    /**
     * View a specific player.
     */
    public function view(Admin $admin, Player $player): bool
    {
        return $admin->hasAbility('player.view');
    }

    /**
     * Create a player.
     */
    public function create(Admin $admin): bool
    {
        return $admin->hasAbility('player.create');
    }

    /**
     * Update a player.
     */
    public function update(Admin $admin, Player $player): bool
    {
        return $admin->hasAbility('player.edit');
    }

    /**
     * Delete a player.
     */
    public function delete(Admin $admin, Player $player): bool
    {
        return $admin->hasAbility('player.delete');
    }
}