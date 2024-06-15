<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Food;
use App\Models\Restaurant;
use App\Policies\Seller\CommentPolicy;
use App\Policies\Seller\FoodPolicy;
use App\Policies\Seller\RestaurantPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Restaurant::class => RestaurantPolicy::class,
        Food::class => FoodPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-cart', function(Customer $customer, Cart $cart) {
            return $customer->id === $cart->customer_id;
        });
    }
}
