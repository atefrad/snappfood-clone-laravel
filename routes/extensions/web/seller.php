<?php

use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\FoodController;
use App\Http\Controllers\Seller\FoodPartyController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\RestaurantController;
use App\Http\Middleware\Custom\CheckIsActive;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function () {

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

        //logout
        Route::delete('/logout', [SellerLoginController::class, 'destroy'])
            ->name('logout');

        //restaurant
        Route::resource('restaurant', RestaurantController::class)
            ->except(['index', 'destroy']);
        Route::patch('restaurant/{restaurant}/change-status', [RestaurantController::class, 'changeStatus'])
            ->name('restaurant.change-status');

        Route::middleware(CheckIsActive::class)
            ->group(function () {

                //food
                Route::resource('food', FoodController::class);

                //food party
                Route::prefix('food-party')
                    ->controller(FoodPartyController::class)
                    ->name('food-party.')
                    ->group(function () {

                        Route::get('/create/{food}',  'create')->name('create');
                        Route::post('/{food}',  'store')->name('store');
                    });




                //order
                Route::get('orders/new-orders', [OrderController::class, 'newOrders'])
                    ->name('orders.new-orders');

            });

    });

    //endregion

});
