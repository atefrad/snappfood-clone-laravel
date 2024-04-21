<?php

use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\RestaurantProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function () {

    //logout
    Route::delete('/logout', [SellerLoginController::class, 'logout'])
        ->name('logout');

    //login
    Route::prefix('/login')
        ->controller(SellerLoginController::class)
        ->name('login.')
        ->group(function () {

            Route::get('/','create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    //register
    Route::prefix('/register')
        ->controller(SellerRegisterController::class)
        ->name('register.')
        ->group(function () {

            Route::get('/','create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    //region authenticated
    Route::middleware('auth:seller')->group(function () {

        Route::prefix('restaurant-profile')
            ->controller(RestaurantProfileController::class)
            ->name('restaurant-profile.')
            ->group(function () {

                Route::get('/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
            });

        Route::prefix('/dashboard')
            ->name('dashboard.')
            ->group(function () {

                //order
                Route::get('orders/new-orders', [OrderController::class, 'newOrders'])
                    ->name('orders.new-orders');
            });
    });

    //endregion

});
