<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\FoodCategoryController;
use App\Http\Controllers\Admin\FoodPartyController as AdminFoodPartyController;
use App\Http\Controllers\Admin\RestaurantCategoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    //login
    Route::prefix('login')
        ->controller(AdminLoginController::class)
        ->name('login.')
        ->group(function () {

            Route::get('/', 'create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    //logout
    Route::delete('/logout', [AdminLoginController::class, 'destroy'])
        ->name('logout');

    //region authenticated
    Route::middleware('auth:admin')->group(function () {

        //admin dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('home');

        //restaurant-category
        Route::resource('restaurant-category', RestaurantCategoryController::class)
        ->except('show');

        //food-category
        Route::resource('food-category', FoodCategoryController::class)
            ->except('show');

        //discount
        Route::resource('discount', DiscountController::class)
            ->except(['show', 'edit' , 'update']);

        //food party
        Route::resource('food-party', AdminFoodPartyController::class)
            ->except(['create', 'store', 'show']);

        //banner
        Route::resource('banner', BannerController::class)
            ->except(['edit', 'update', 'show']);
    });
    //endregion
});
