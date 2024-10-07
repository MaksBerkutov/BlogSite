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
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create.show');
    Route::post('/post/create', [App\Http\Controllers\PostController::class, 'create_action'])->name('post.create');
    Route::get('/logout', [App\Http\Controllers\UserController::class,'logout'])->name('logout');
});

Route::get('/email', function (){return view('user.verify-email');})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\UserController::class,'verify'])->middleware(['auth','signed'])->name('verification.verify');
Route::post('/email/verification-notification', [App\Http\Controllers\UserController::class,'send_verify'])->middleware(['auth','throttle:3,1'])->name('verification.send');
//verified auth
