<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

// Auth routes
Route::middleware('auth')->group(function () {
    // Chat routes
    Route::get('/dashboard', function () {
        return redirect()->route('chat.index');
    })->name('dashboard');
    
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/{chatSession}', [ChatController::class, 'show'])->name('chat.show');
    Route::patch('/chat/{chatSession}', [ChatController::class, 'update'])->name('chat.update');
    Route::delete('/chat/{chatSession}', [ChatController::class, 'destroy'])->name('chat.destroy');
    Route::post('/chat/{chatSession}/message', [ChatController::class, 'sendMessage'])->name('chat.message');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';