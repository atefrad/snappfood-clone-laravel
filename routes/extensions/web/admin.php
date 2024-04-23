<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\FoodCategoryController;
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

    });
    //endregion
});
