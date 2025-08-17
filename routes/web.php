<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn() => redirect()->route('dashboard-posts'));
Route::resource('posts', PostController::class)->only(['store']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard/posts', [DashboardController::class, 'index'])->name('dashboard-posts');
    Route::get('/dashboard/my-posts', [DashboardController::class, 'postPerId'])->name('post-per-id');
    Route::get('/dashboard/create-post',[PostController::class, 'createTopic'])->name('create-post');
    Route::get('/dashboard/posts/most-liked', [DashboardController::class, 'postsMostLiked'])->name('posts-most-liked');
    Route::get('/dashboard/posts/{post}', [PostController::class, 'show'])->name('posts-show');
    Route::get('/dashboard/posts/topic/{Id}', [DashboardController::class, 'postsPerTopic'])->name('posts-per-topic');


    Route::post('/posts/{post}/like', [PostLikeController::class, 'store'])->name('posts.like');
    Route::delete('/posts/{post}/like', [PostLikeController::class, 'destroy'])->name('posts.dislike');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
