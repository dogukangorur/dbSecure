<?php

use App\Http\Controllers\CardsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AuthDogrulamaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frond.welcome');
})->name("welcome");

Route::middleware(['auth', 'verified','kod.dogrulandi'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,"index"])->name('dashboard');
    Route::get('/dashboard/api', [DashboardController::class,"getChartData"]);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/dogrulama', [AuthDogrulamaController::class, 'form'])->name('dogrulama.form');
    Route::post('/dogrulama', [AuthDogrulamaController::class, 'kontrol'])->name('dogrulama.kontrol');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::get('/logs', [LogsController::class, 'index'])->name('logs');

    Route::get('/cards', [CardsController::class, 'index'])->name('cards');
    Route::get('/cards/delete/{id}', [CardsController::class, 'destroy'])->name('card.delete');
    Route::get('/cards/show/{id}', [CardsController::class, 'show'])->name('card.show');
    Route::get('/cards/create', [CardsController::class, 'showCreate'])->name('card.create.page');
    Route::post('/cards/create', [CardsController::class, 'create'])->name('card.create');

    Route::get('/passwords', [PasswordController::class, 'index'])->name('passwords');
    Route::get('/passwords/delete/{id}', [PasswordController::class, 'destroy'])->name('password.delete');
    Route::get('/passwords/show/{id}', [PasswordController::class, 'show'])->name('password.show');
    Route::get('/passwords/create', [PasswordController::class, 'showCreate'])->name('password.create.page');
    Route::post('/passwords/create', [PasswordController::class, 'create'])->name('password.create');

    Route::get('/encryption', [FileController::class, 'encryption'])->name('encryption');
    Route::post('/encryption', [FileController::class, 'encrypt'])->name('enc');
    Route::get('/decryption', [FileController::class, 'decryption'])->name('decryption');
    Route::post('/decryption', [FileController::class, 'decrypt'])->name('dec');

    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::post('/api/files', [FileController::class, 'save'])->name('save_files');
    Route::get('/files/download/{id}', [FileController::class, 'download'])->name('file_download');
    Route::get('/files/delete/{id}', [FileController::class, 'delete'])->name('file_delete');

});



require __DIR__.'/auth.php';
