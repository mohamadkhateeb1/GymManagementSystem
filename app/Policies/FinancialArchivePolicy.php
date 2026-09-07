<?php

namespace App\Policies;

use App\Models\FinancialArchive;
use App\Models\Player;
use Illuminate\Auth\Access\Response;

class FinancialArchivePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny($user): bool
    {
        return $user->hasAbility('financial_archive.view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Player $player, FinancialArchive $financialArchive): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Player $player): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Player $player, FinancialArchive $financialArchive): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Player $player, FinancialArchive $financialArchive): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Player $player, FinancialArchive $financialArchive): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Player $player, FinancialArchive $financialArchive): bool
    {
        return false;
    }
}
