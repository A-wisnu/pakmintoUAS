<?php

namespace App\Policies;

use App\Models\Meme;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MemePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can view memes
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Meme $meme): bool
    {
        return true; // Anyone can view a meme
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Authenticated users can create memes
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id; // Only owner can update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id; // Only owner can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id; // Only owner can restore
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Meme $meme): bool
    {
        return $user->id === $meme->user_id; // Only owner can force delete
    }
}
