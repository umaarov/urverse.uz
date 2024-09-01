<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArticleController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('admin.index');
    Route::resource('articles', ArticleController::class)->except(['show']);
});
