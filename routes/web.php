<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/test', function () {
    return view('test');
})->middleware('auth')->name('test');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'admin'])->name('admin');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.login');
