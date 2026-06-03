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

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

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
    Route::get('/sponsor-homepage', function () {
        if (auth()->user() && auth()->user()->tipo_utente === 'Sponsor') {
            return view('pages.sponsor_homepage');
        }
        return redirect()->route('homepage');
    })->name('sponsor-homepage');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])->name('likes.toggle');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'toggle'])->name('comment.likes.toggle');
    
    Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');
});

require __DIR__.'/auth.php';

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'it'])) {
        session()->put('locale', $locale);
        if (auth()->check()) {
            $user = auth()->user();
            $user->lingua = $locale === 'it' ? 'Italiano' : 'English';
            $user->save();
        }
    }
    return redirect()->back();
})->name('lang.switch');

