<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FileTypeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Language route (accessible to all users)
Route::post('/language/change', [LanguageController::class, 'update'])->name('language.change');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('/documents/{document}/preview', [DocumentController::class, 'preview'])->name('documents.preview');
    Route::delete('/documents/{document}', [DocumentController::class, 'destroy'])->name('documents.destroy');
    Route::post('/documents/{document}/status', [DocumentController::class, 'updateStatus'])->name('documents.status.update');

    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/unseen', [NotificationController::class, 'getUnseenDocuments'])->name('notifications.unseen');
});

require __DIR__.'/auth.php';
