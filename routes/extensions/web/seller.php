<?php

use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\RestaurantController;
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

    //logout
    Route::delete('/logout', [SellerLoginController::class, 'destroy'])
        ->name('logout');

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

        Route::resource('restaurant', RestaurantController::class);
        Route::patch('restaurant/{restaurant}/change-status', [RestaurantController::class, 'changeStatus'])
            ->name('restaurant.change-status');

        //order
        Route::get('orders/new-orders', [OrderController::class, 'newOrders'])
            ->name('orders.new-orders');

    });

    //endregion

});
