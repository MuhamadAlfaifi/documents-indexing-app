<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;

require_once __DIR__ . '/jetstream.php';

Route::redirect('/', \App\Providers\RouteServiceProvider::HOME);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::post('/media', MediaController::class)->name('media');
});
