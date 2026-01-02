<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::get('/user-register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
