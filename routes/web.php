<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MediaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['visitors', 'mint'])->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('home');

    Route::prefix('browse')->name('browse.')->group(function () {
        Route::get('/subject', [ClientController::class, 'subject'])->name('subject');
        Route::get('/random', [ClientController::class, 'random'])->name('random');
        Route::get('/trending', [ClientController::class, 'trending'])->name('trending');
        Route::get('/genre', [ClientController::class, 'genre'])->name('genre');
    });

    Route::prefix('book')->name('book.')->group(function () {
        Route::get('/{id}-{slug?}', [BookController::class, 'index'])->name('detail');
    });

    Route::prefix('author')->name('author.')->group(function () {
        Route::get('/{id}-{slug?}', [AuthorController::class, 'index'])->name('detail');
    });

    Route::prefix('collection')->name('collection.')->group(function () {
        Route::get('/{id}', [CollectionController::class, 'index'])->name('detail');
    });

    Route::post('/locale/switch', [LanguageController::class, 'switchLocale'])
        ->name('locale.switch');

    Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->middleware('authenticate')->name('auth.logout');

    Route::prefix('{username}')->name('profile.')->group(function () {
        Route::get('/', [AuthController::class, 'profile'])->name('index');
        Route::get('/read-later', [AuthController::class, 'readlater'])->name('read-later')->middleware(['authenticate', 'username']);
    });

    Route::prefix('docs')->name('docs.')->group(function () {
        Route::get('/{book}/{mediaId}', [MediaController::class, 'show'])->name('show');
        Route::get('/download/{book}/{mediaId}', [MediaController::class, 'download'])->name('download');
    })->middleware('authenticate');
});
