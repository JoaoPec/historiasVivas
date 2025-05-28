<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/memories', [MemoryController::class, 'index'])->name('memories.index');
    Route::get('/memories/create', [MemoryController::class, 'create'])->name('memories.create');
    Route::post('/memories', [MemoryController::class, 'store'])->name('memories.store');
    Route::get('/memories/{memory}', [MemoryController::class, 'show'])->name('memories.show');
    Route::get('/memories/{memory}/edit', [MemoryController::class, 'edit'])->name('memories.edit');
    Route::put('/memories/{memory}', [MemoryController::class, 'update'])->name('memories.update');
    Route::delete('/memories/{memory}', [MemoryController::class, 'destroy'])->name('memories.destroy');
    
    Route::get('/memories/favorites', [MemoryController::class, 'favorites'])->name('memories.favorites');
});

require __DIR__ . '/auth.php';
