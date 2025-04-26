<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register',[RegisterController::class,'register'])->name('register.post');

route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');

route::post('/login',[LoginController::class,'authenticate'])->name('authenticate')->middleware('guest');
