<?php

namespace App\Policies;

use App\Models\SecretCode;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SecretCodePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Authenticated users can view their secret codes
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SecretCode $secretCode): bool
    {
        return $user->id === $secretCode->user_id; // Only owner can view
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Authenticated users can generate secret codes
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SecretCode $secretCode): bool
    {
        return $user->id === $secretCode->user_id; // Only owner can update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SecretCode $secretCode): bool
    {
        return $user->id === $secretCode->user_id; // Only owner can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SecretCode $secretCode): bool
    {
        return $user->id === $secretCode->user_id; // Only owner can restore
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SecretCode $secretCode): bool
    {
        return $user->id === $secretCode->user_id; // Only owner can force delete
    }
}
