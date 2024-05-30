<?php

use App\Http\Controllers\Api\V1\Customer\AddressController;
use App\Http\Controllers\Api\V1\Customer\Auth\LoginController as CustomerLoginController;
use App\Http\Controllers\Api\V1\Customer\Auth\RegisterController as CustomerRegisterController;
use App\Http\Controllers\Api\V1\Customer\CartController;
use App\Http\Controllers\Api\V1\Customer\CommentController as CustomerCommentController;
use App\Http\Controllers\Api\V1\Customer\CustomerController;
use App\Http\Controllers\Api\V1\Customer\FoodController as CustomerFoodController;
use App\Http\Controllers\Api\V1\Customer\PaymentController;
use App\Http\Controllers\Api\V1\Customer\RestaurantController as CustomerRestaurantController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/customer')->name('customer.')->group(function () {

    Route::middleware('guest:seller,admin,customer')->group(function () {

        //login
        Route::post('/login', [CustomerLoginController::class, 'store'])->name('login.store');

        //register
        Route::post('/register', [CustomerRegisterController::class, 'store'])->name('register.store');

    });

    //region authenticated

    Route::middleware('auth:customer')->group(function () {

        //address
        Route::prefix('address')
            ->controller(AddressController::class)
            ->name('address.')
            ->group(function () {

                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::post('/{address}', 'setCurrent')->name('set-current');
            });

        //profile
        Route::patch('profile', [CustomerController::class, 'update'])
            ->name('profile.update');

        //restaurant
        Route::resource('restaurant', CustomerRestaurantController::class)
            ->only(['index', 'show']);

        //food
        Route::controller(CustomerFoodController::class)
            ->name('food.')
            ->group(function () {

                Route::get('restaurant/{restaurant}/food', 'index')->name('index');
                Route::get('/food/search', 'search')->name('search');
            });

        //cart
        Route::resource('cart', CartController::class)
            ->only(['index', 'store', 'show']);

        Route::patch('cart', [CartController::class, 'update'])->name('cart.update');

        //payment
        Route::post('cart/{cart}/pay', [PaymentController::class, 'store'])->name('cart.payment.store');

        //comment
        Route::resource('comment', CustomerCommentController::class)
            ->only(['index', 'store']);
    });

    //endregion
});
