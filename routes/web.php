<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin/dashboard', [UserController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');

 Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
 Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
 Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
