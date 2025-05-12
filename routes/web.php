<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Language preference
    Route::post('/language', [UserController::class, 'updateLanguage'])->name('language.update');

    // Department routes
    Route::resource('departments', DepartmentController::class);

    // File Type routes
    Route::resource('file-types', FileTypeController::class);

    // User routes
    Route::resource('users', UserController::class);

    // Document routes
    Route::resource('documents', DocumentController::class);
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    Route::post('/documents/{document}/status', [DocumentController::class, 'updateStatus'])->name('documents.status.update');
});

require __DIR__.'/auth.php';
