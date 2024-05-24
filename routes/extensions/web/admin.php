<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommentDeleteRequestController as AdminCommentDeleteRequestController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\FoodCategoryController;
use App\Http\Controllers\Admin\FoodPartyController as AdminFoodPartyController;
use App\Http\Controllers\Admin\RestaurantCategoryController;
use App\Http\Controllers\Admin\RestaurantController as AdminRestaurantController;
use App\Http\Controllers\Admin\FoodController as AdminFoodController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:seller,admin,customer')->group(function () {

        //login
        Route::prefix('login')
            ->controller(AdminLoginController::class)
            ->name('login.')
            ->group(function () {

                Route::get('/', 'create')->name('create');
                Route::post('/', 'store')->name('store');
            });

    });

    //region authenticated
    Route::middleware('auth:admin')->group(function () {

        //logout
        Route::delete('/logout', [AdminLoginController::class, 'destroy'])
            ->name('logout');

        //admin dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('home');

        //restaurant-category
        Route::resource('restaurant-category', RestaurantCategoryController::class)
        ->except('show');

        //food-category
        Route::resource('food-category', FoodCategoryController::class)
            ->except('show');

        //restaurant
        Route::get('restaurant', [AdminRestaurantController::class, 'index'])
            ->name('restaurant.index');

        //food
        Route::get('food', [AdminFoodController::class, 'index'])
            ->name('food.index');

        //discount
        Route::resource('discount', DiscountController::class)
            ->except('show');

        //food party
        Route::resource('food-party', AdminFoodPartyController::class)
            ->except(['create', 'store', 'show']);

        //banner
        Route::resource('banner', BannerController::class)
            ->except(['edit', 'update', 'show']);

        //comment delete request
        Route::prefix('comment-delete-request')
            ->controller(AdminCommentDeleteRequestController::class)
            ->name('comment-delete-request.')
            ->group(function () {

                Route::get('/', 'index')->name('index');
                Route::get('/{commentDeleteRequest}', 'show')->name('show');
                Route::get('/reject/{commentDeleteRequest}', 'reject')->name('reject');
                Route::delete('/confirm/{commentDeleteRequest}', 'confirm')->name('confirm');
            });
    });
    //endregion
});
