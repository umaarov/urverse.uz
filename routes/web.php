<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public routes for clients
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Admin routes
Route::prefix('admin')->middleware('auth')->group(function() {
    Route::get('/', [AdminArticleController::class, 'index'])->name('admin.index');
    Route::resource('articles', AdminArticleController::class)->except(['show']);
});

// Auth routes
Auth::routes(['register' => false]); // Disable registration
