<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FirebaseAuthController;
use App\Http\Controllers\ProfileController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Akses Tanpa Login)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::get('/blueprint', function () {
    return view('blueprint');
});
Route::get('/archive', function () {
    return view('archive'); // Sesuaikan dengan nama file blade kamu
})->name('archive.hub');

Route::post('/login-firebase', [FirebaseAuthController::class, 'login']);
Route::get('/collections', [BukuController::class, 'index'])->name('koleksi');

// Kelompok untuk Tamu (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| 2. PROTECTED ROUTES (Harus Login / AUTH)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    // Auth Actions
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Management
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::post('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');

    // Dashboard & Beranda
    Route::get('/beranda', [BukuController::class, 'beranda'])->name('beranda');

    // Katalog & Management Buku
    Route::get('/collection', [BukuController::class, 'indexAdmin'])->name('bukus.index');
    
    Route::prefix('bukus')->group(function () {
        Route::get('/create', [BukuController::class, 'create'])->name('bukus.create');
        Route::post('/', [BukuController::class, 'store'])->name('bukus.store');
        Route::get('/{id}', [BukuController::class, 'show'])->name('bukus.show');
        Route::get('/{id}/edit', [BukuController::class, 'edit'])->name('bukus.edit');
        Route::put('/{id}', [BukuController::class, 'update'])->name('bukus.update');
        Route::delete('/{id}', [BukuController::class, 'destroy'])->name('bukus.destroy');
    });

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategoris.show');
});