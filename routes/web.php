<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home', app(VehicleController::class)->index());
})->name('home');

Route::get('/contract/{id}', [ContractController::class, 'show'])
    ->middleware('contract.owner')
    ->name('contract.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::get('/contract/{contract}', [ContractController::class, 'create'])->name('contract.create');
    Route::get('/lease/enquire', [ContractController::class, 'create'])->name('lease.create');
    Route::post('/lease/enquire', [ContractController::class, 'store'])->name('lease.store');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::controller(VehicleController::class)->group(function () {
        Route::get('/vehicles/create', 'create')->name('vehicles.create');
        Route::post('/vehicles', 'store')->name('vehicles.store');
        Route::delete('/vehicles/delete', 'destroy')->name('vehicles.delete');

        Route::get('/rentals', function () { // VehicleController index is used in multiple views, that's why this route is not simple route view
            return view('vehicles.index', app(VehicleController::class)->index());
        })->name('admin.rentals');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/{user}/edit', 'edit')->name('admin.users.edit');
        Route::delete('/users/{user}', 'destroy')->name('admin.users.destroy');
        Route::put('/users/{user}', 'update')->name('admin.users.update');
        Route::put('/users/{user}/role', 'updateRole')->name('admin.users.updateRole');
    });

    Route::get('/contract/{id}', [ContractController::class, 'show'])->name('admin.contract.show');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::view('/settings', 'admin.settings')->name('admin.settings');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegistration')->name('register');
    Route::post('/register', 'store')->name('auth.store');
    Route::post('/login', 'authenticate')->name('auth.login');
});
