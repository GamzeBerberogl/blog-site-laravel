<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Ana sayfa rotası giriş yapılmamış kullanıcılar için
Route::get('/', [PostController::class, 'index'])->name('home');

Auth::routes();

// Ana sayfa rotası giriş yapılmış kullanıcılar için
Route::get('/home', [PostController::class, 'index'])->middleware('auth')->name('home');

// Abonelik işlemi
Route::post('/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

// Kullanıcıya ait postları listeleme ve yeni post oluşturma
Route::get('/my-posts', [PostController::class, 'myPosts'])->middleware('auth')->name('my-posts');
Route::get('/new-post', [PostController::class, 'create'])->middleware('auth')->name('new-post');
Route::post('/new-post', [PostController::class, 'store'])->middleware('auth')->name('post.store');

// Post ve kategori kaynak rotaları (CRUD işlemleri)
Route::resource('posts', PostController::class)->middleware('auth')->except(['index', 'create', 'store']);
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Post edit ve delete için yetkilendirme middleware'i ekleyin
Route::middleware(['auth', 'checkPostOwner'])->group(function () {
    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Logout Routes
Route::get('/logout', function () {
    return view('logout');
})->name('logout.view');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');
