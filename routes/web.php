<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/auth/{section}', [AuthController::class, 'show'])->name('auth.show');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

 
