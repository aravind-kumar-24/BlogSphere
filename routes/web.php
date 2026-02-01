<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogsController;
    use App\Http\Controllers\HomeController;
    use App\Http\Controllers\LoginController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\RegisterController;
    use Illuminate\Support\Facades\Route;

    Route::get('/', [HomeController::class, 'home']);

    Route::get('/blogger-register', [RegisterController::class, 'index']);

    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/get-cities/{state_id}', [RegisterController::class, 'get_cities']);

    Route::get('/blogger-login', [LoginController::class, 'index']);

    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/email-verification/{user_id}', [RegisterController::class, 'email_verification']);

    Route::get('/forgot-password', [ProfileController::class, 'forgot_password']);

    Route::post('/send-forgot-password-mail', [ProfileController::class, 'forgot_password_mail']);

    Route::get('/unauthenticated-access', [LoginController::class, 'un_authenticated_access']);

    Route::middleware('is_authenticated')->group(function(){

        Route::prefix('blogsphere')->group(function(){

            Route::middleware('is_blogger')->group(function(){

                Route::get('/create-blog/{type?}/{blog_id?}', [BlogsController::class, 'index']);

                Route::post('/publish-blog', [BlogsController::class, 'publish_blog']);

                Route::get('/published-blogs', [BlogsController::class, 'published_blogs']);

                Route::get('/deleted-blogs', [BlogsController::class, 'deleted_blogs']);

                Route::post('/published-blogs/update/{blog_id}', [BlogsController::class, 'update_published_blogs']);

                Route::get('/published-blogs/delete/{blog_id}', [BlogsController::class, 'delete_published_blogs']);
                
            });

            Route::middleware('is_admin')->group(function(){

                Route::get('/manage-bloggers', [AdminController::class, 'all_bloggers']);

                Route::get('/manage-bloggers/update-bloggers-status/{blogger_id}', [AdminController::class, 'bloggers_status_change']);

                Route::get('/manage-bloggers/delete-blogger/{blogger_id}', [AdminController::class, 'delete_blogger']);

                Route::get('/manage-blogs', [AdminController::class, 'manage_blogs']);

                Route::get('/rejected-blogs', [AdminController::class, 'rejected_blogs']);

            });

            Route::get('/blogs', [BlogsController::class, 'all_blogs']);

            Route::get('/my-profile/{type}', [ProfileController::class, 'profile_page']);

            Route::post('/update-my-profile', [ProfileController::class, 'update_profile']);

            Route::get('/change-password', [ProfileController::class, 'change_password']);

            Route::post('/update-password', [ProfileController::class, 'update_password']);

            Route::get('/logout', [LoginController::class, 'logout']);

        });
        
    });

