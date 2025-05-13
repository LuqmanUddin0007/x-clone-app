<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/dashboard', 'dashboard')->name('dashboard');

// Route for /profile (logged-in user profile view)
Route::view('/profile', 'profile.index')->name('profile.index');

// Route for public profiles (e.g., /profile/3)
Route::get('/profile/{id}', fn() => view('profile.show'))->name('profile.show');