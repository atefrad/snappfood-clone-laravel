<?php

namespace App\Policies\Seller;

use App\Models\Restaurant;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RestaurantPolicy
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
    public function view(Seller $seller, Restaurant $restaurant): bool
    {
        return $seller->restaurant->id === $restaurant->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Seller $seller): bool
    {
        return !$seller->restaurant;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Seller $seller, Restaurant $restaurant): bool
    {
        return $seller->restaurant->id === $restaurant->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Restaurant $restaurant): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Restaurant $restaurant): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Restaurant $restaurant): bool
    {
        //
    }
}
