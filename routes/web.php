<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/auth/{section}', function ($section) {
    return view('auth', ['section' => $section]);
})->where('section', 'login|register')->name('auth');

 
