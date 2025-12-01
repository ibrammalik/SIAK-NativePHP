<?php

namespace App\Policies;

use App\Models\RT;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RTPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW() || $user->isRT()) return true;
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RT $rt): bool
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW()) return true;
        if ($user->isRT() && $user->rt_id === $rt->id) return true;
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW()) return true;
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RT $rT): bool
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW()) return true;
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RT $rT): bool
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW()) return true;
        return false;
    }

    public function deleteAny(User $user)
    {
        if ($user->isSuperAdmin() || $user->isKelurahan() || $user->isRW()) return true;
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RT $rT): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RT $rT): bool
    {
        return false;
    }
}
