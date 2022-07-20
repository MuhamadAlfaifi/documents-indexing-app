<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SearchController;

Route::redirect('/', \App\Providers\RouteServiceProvider::HOME);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::post('/media', MediaController::class)->name('media');
    Route::get('/search', SearchController::class)->name('search');
});
