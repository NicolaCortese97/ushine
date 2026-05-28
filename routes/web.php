<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentLikeController;
use Illuminate\Support\Facades\Route;

Route::get('/landing', function () {
    return view('pages.landing');
})->name('landing');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('homepage');
    }
    return redirect()->route('landing');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profileInfo', function () {
        return view('profileInfo', ['title' => 'profileInfo']);
    })->name('profileInfo');

    Route::get('/talents', [\App\Http\Controllers\TalentSearchController::class, 'index'])->name('talents.index');

    Route::resource('users', UserController::class);

    // Feed and Posts
    Route::get('/homepage', [PostController::class, 'index'])->name('homepage');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('likes.toggle');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'toggle'])->name('comment.likes.toggle');
});

require __DIR__.'/auth.php';
