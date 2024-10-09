<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\UserController::class,'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\UserController::class,'login'])->name('authentication');
    Route::post('/register', [App\Http\Controllers\UserController::class,'create'])->name('register');
});
Route::middleware('auth')->group(function () {
    Route::get('/home/vote', [App\Http\Controllers\VoteController::class, 'index'])->name('vote');
    Route::get('/home/vote/create', [App\Http\Controllers\VoteController::class, 'create'])->middleware('checkRole:admin');
    Route::post('/home/vote/create', [App\Http\Controllers\VoteController::class, 'create_action'])->middleware('checkRole:admin');
    Route::get('/home/vote/{id}', [App\Http\Controllers\VoteController::class, 'show'])->name('vote.show');
    Route::post('/home/vote/{id}/vote', [App\Http\Controllers\VoteController::class, 'vote'])->name('vote.vote');



    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::post('/comment', [App\Http\Controllers\CommetController::class, 'create'])->name('comment.create');

    Route::get('/post/{id}', [App\Http\Controllers\PostController::class, 'more'])->name('post.more')->where('id', '[0-9]+');
    Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create.show')->middleware('checkRole:admin');
    Route::post('/post/create', [App\Http\Controllers\PostController::class, 'create_action'])->name('post.create')->middleware('checkRole:admin');

    Route::post('/post/{postId}/like', [App\Http\Controllers\PostController::class, 'likePost'])->name('post.like');
    Route::post('/post/{postId}/unlike', [App\Http\Controllers\PostController::class, 'unlikePost'])->name('post.unlike');

    Route::get('/post/search', [App\Http\Controllers\SearchController::class, 'index'])->name('post.search');
    Route::get('/logout', [App\Http\Controllers\UserController::class,'logout'])->name('logout');

    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users.show')->middleware('checkRole:admin');
    Route::post('/admin/users', [App\Http\Controllers\AdminController::class, 'upadteUsers'])->name('admin.users.update')->middleware('checkRole:admin');

});

Route::get('/email', function (){return view('user.verify-email');})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\UserController::class,'verify'])->middleware(['auth','signed'])->name('verification.verify');
Route::post('/email/verification-notification', [App\Http\Controllers\UserController::class,'send_verify'])->middleware(['auth','throttle:3,1'])->name('verification.send');
//verified auth
