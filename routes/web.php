<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {});

Route::middleware(['admin'])
    ->prefix('admin')
    ->controller(UserController::class)
    ->group(function () {

        Route::get('/dashboard', 'index')->name('admin.dashboard');
        Route::get('/users/{user}/edit', 'edit')->name('admin.users.edit');

        Route::delete('/users/{user}', 'destroy')->name('admin.users.destroy');

        Route::put('/users/{user}', 'update')->name('admin.users.update');
    });

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegistration')->name('register');
    Route::get('/logout', 'logout')->name('auth.logout');

    Route::post('/register', 'store')->name('auth.store');
    Route::post('/login', 'authenticate')->name('auth.login');
});
