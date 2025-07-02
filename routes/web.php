<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// force redirect
Route::get('/', function() {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('login.authenticate');

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home.index');
    Route::resource('post', PostController::class,);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/image/{filename}', [ImageController::class, 'showImage'])->name('image.show');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
