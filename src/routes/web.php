<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EpisodeController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware('auth')->group(function () {
    Route::get('/articles/{article:slug}', ArticleController::class)->name('articles.show');
    Route::get('/episodes/{episode:slug}', EpisodeController::class)->name('episodes.show');
});

require __DIR__.'/auth.php';
