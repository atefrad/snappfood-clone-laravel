<?php

namespace App\Policies\Seller;

use App\Models\Food;
use App\Models\Seller;
use App\Models\User;

class FoodPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Food $food): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Seller $seller, Food $food): bool
    {
        return $seller->restaurant->id === $food->restaurant_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Seller $seller, Food $food): bool
    {
        return $seller->restaurant->id === $food->restaurant_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Food $food): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Food $food): bool
    {
        //
    }
}
