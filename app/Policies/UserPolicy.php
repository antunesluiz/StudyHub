<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can create other user.
     */
    public function createUser(User $user): bool
    {
        return $user->hasRole('admin') && $user->can('create user');
    }
}
