<?php

use App\Http\Controllers\Api\V1\Customer\AddressController;
use App\Http\Controllers\Api\V1\Customer\Auth\LoginController;
use App\Http\Controllers\Api\V1\Customer\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/customer')->name('customer.')->group(function () {

    Route::middleware('guest:seller,admin,customer')->group(function () {

        //login
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');

        //register
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    });

    //region authenticated

    Route::middleware('auth:customer')->group(function () {

        Route::resource('address', AddressController::class)
            ->only(['index', 'store', 'update']);

    });

    //endregion
});
