<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('dashboard');
//});

Route::get('/', HomeController::class)->name('home');

Route::get('/edit-profile', [ ProfileController::class, 'index' ])->name('profile.index');
Route::post('/edit-profile', [ ProfileController::class, 'store' ])->name('profile.store');

Route::post('/logout', [ LogoutController::class, 'store' ])->name('logout');
Route::get('/login', [ LoginController::class, 'index' ])->name('login');
Route::post('/login', [ LoginController::class, 'store' ]);

Route::post('/images', [ ImageController::class, 'store' ])->name('image.store');

Route::get('/register', [ RegisterController::class, 'index' ])->name('register');
Route::post('/register', [ RegisterController::class, 'store' ]);

Route::get('/posts/create', [ PostController::class, 'create' ])->name('posts.create');
Route::post('/posts', [ PostController::class, 'store' ])->name('post.store');
Route::delete('/post/{post}', [ PostController::class, 'destroy' ])->name('post.destroy');
Route::get('/{user:username}', [ PostController::class, 'index' ])->name('dashboard');
Route::get('/{user:username}/posts/{post}', [ PostController::class, 'show' ])->name('post.show');

Route::post('/posts/{post}/likes', [ LikeController::class, 'store' ])->name('like.store');
Route::delete('/posts/{post}/likes', [ LikeController::class, 'destroy' ])->name('like.destroy');

Route::post('/{user:username}/posts/{post}', [ CommentController::class, 'store' ])->name('comment.store');

Route::post('/{user:username}/follow', [ FollowerController::class, 'store' ])->name('follower.store');
Route::delete('/{user:username}/unfollow', [ FollowerController::class, 'destroy' ])->name('follower.destroy');





