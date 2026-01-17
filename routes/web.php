<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home']);

Route::get('/blogger-register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/get-cities/{state_id}', [RegisterController::class, 'get_cities']);
Route::get('/blogger-login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/email-verification/{user_id}', [RegisterController::class, 'email_verification']);

Route::middleware('is_authenticated')->group(function(){
    Route::prefix('blogsphere')->group(function(){
        Route::get('/blogs', [BlogsController::class, 'index']);
    });
});

Route::get('/temp', function(){
    return view('email_templates.RegistrationCompleted');
});
