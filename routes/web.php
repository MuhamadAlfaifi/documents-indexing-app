<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DownloadableReportController;
use App\Http\Controllers\ShowBackupsController;
use App\Http\Controllers\CreateBackupController;

Route::redirect('/', \App\Providers\RouteServiceProvider::HOME);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('tags', TagController::class);
    Route::resource('posts', PostController::class);
    Route::resource('users', UserController::class);
    Route::post('/media', MediaController::class)->name('media');
    Route::get('/search', SearchController::class)->name('search');
    Route::view('/report', 'reports.form')->name('report.form');
    Route::get('/download', DownloadableReportController::class)->name('report.download');
    Route::get('/backups', ShowBackupsController::class)->name('backups.index');
    Route::get('/create-new-backup', CreateBackupController::class)->name('backups.create');
});
