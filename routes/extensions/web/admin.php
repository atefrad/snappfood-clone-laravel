<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
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
});

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');
