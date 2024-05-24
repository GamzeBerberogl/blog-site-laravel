<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [PostController::class, 'index'])->middleware('auth')->name('home');
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('/my-posts', [PostController::class, 'myPosts'])->middleware('auth')->name('my-posts');
Route::get('/new-post', [PostController::class, 'create'])->middleware('auth')->name('new-post');
Route::post('/new-post', [PostController::class, 'store'])->middleware('auth')->name('post.store');
Route::resource('posts', PostController::class)->middleware('auth')->except(['index', 'create', 'store']);
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');


// Logout Routes
Route::get('/logout', function () {
    return view('logout');
})->name('logout.view');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
