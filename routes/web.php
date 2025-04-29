<?php

use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\PlayerControlller;
use App\Http\Controllers\User\HomeController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'__invoke'])->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/register',[RegisterController::class,'register'])->name('register.post');

route::get('/login',[LoginController::class,'login'])->name('login')->middleware('guest');

route::post('/login',[LoginController::class,'authenticate'])->name('authenticate')->middleware('guest');

route::post('/logout',[LoginController::class,'logout'])->name('logout')->middleware('auth');

Route::resource('players',PlayerControlller::class)->middleware('auth');
