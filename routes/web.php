<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

require_once __DIR__ . '/jetstream.php';

Route::get('/', fn () => redirect('dashboard'));

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('tags', TagController::class);
});
