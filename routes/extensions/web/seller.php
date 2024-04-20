<?php

use App\Http\Controllers\Seller\Auth\SellerLoginController;
use App\Http\Controllers\Seller\Auth\SellerRegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('seller')->name('seller.')->group(function () {

    Route::prefix('/login')
        ->controller(SellerLoginController::class)
        ->name('login.')
        ->group(function () {

            Route::get('/','create')->name('create');
            Route::post('/', 'store')->name('store');
        });

    Route::prefix('/register')
        ->controller(SellerRegisterController::class)
        ->name('register.')
        ->group(function () {

            Route::get('/','create')->name('create');
            Route::post('/', 'store')->name('store');
        });

});
