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

Route::get('/contract/{id}', [ContractController::class, 'show'])->middleware('contract.owner')->name('contract.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('vehicles.show');
    Route::view('/contractTest', 'user.create-contract');
    Route::get('/contract/{contract}', [ContractController::class, 'create'])->name('contract.create');


    Route::get('/lease/enquire', [ContractController::class, 'create'])->name('lease.create');
    Route::post('/lease/enquire', [ContractController::class, 'store'])->name('lease.store');
});

Route::middleware(['admin'])
    ->prefix('admin')
    ->controller(UserController::class)
    ->group(function () {

        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::delete('/vehicles/delete', [VehicleController::class, 'destroy'])->name('vehicles.delete');
        Route::get('/contract/{id}', [ContractController::class, 'show'])->name('admin.contract.show');


        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/rentals', function () {
            return view('vehicles.index', app(VehicleController::class)->index());
        })->name('admin.rentals');

        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('admin.settings');

        Route::get('/users', 'index')->name('admin.users');
        Route::get('/users/{user}/edit', 'edit')->name('admin.users.edit');

        Route::delete('/users/{user}', 'destroy')->name('admin.users.destroy');

        Route::put('/users/{user}', 'update')->name('admin.users.update');
        Route::put('/users/{user}/role', 'updateRole')->name('admin.users.updateRole');
    });

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::get('/register', 'showRegistration')->name('register');
    Route::get('/logout', 'logout')->name('auth.logout');

    Route::post('/register', 'store')->name('auth.store');
    Route::post('/login', 'authenticate')->name('auth.login');
});
