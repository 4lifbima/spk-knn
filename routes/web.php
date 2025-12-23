<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KnnController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Dataset / Inventaris
    Route::get('/dataset', [InventarisController::class, 'index'])->name('dataset.index');
    Route::post('/dataset', [InventarisController::class, 'store'])->name('dataset.store');
    Route::post('/dataset/import', [InventarisController::class, 'import'])->name('dataset.import');
    Route::delete('/dataset/{inventaris}', [InventarisController::class, 'destroy'])->name('dataset.destroy');
    
    // Preprocessing
    Route::get('/preprocessing', [KnnController::class, 'preprocessing'])->name('preprocessing');
    
    // KNN Process
    Route::get('/process', [KnnController::class, 'index'])->name('process.index');
    Route::post('/process/calculate', [KnnController::class, 'calculate'])->name('process.calculate');
    
    // History
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/{history}', [HistoryController::class, 'show'])->name('history.show');
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Settings (Password)
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
});

require __DIR__.'/auth.php';