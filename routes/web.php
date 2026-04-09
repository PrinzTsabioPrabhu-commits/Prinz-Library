<?php

use App\Models\Buku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/blueprint', function () {
    return view('blueprint');
});

Route::get('/archive', function () {
    return view('archive');
})->name('archive.hub');

/*
|--------------------------------------------------------------------------
| 2. AUTH ROUTES (Login & Register)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
});

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| 3. PROTECTED ROUTES (Hanya Akses Jika Sudah Login)
|--------------------------------------------------------------------------
*/

// BARIS 50: Pintu dibuka di sini
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Beranda & Dashboard
    Route::get('/beranda', [BukuController::class, 'beranda'])->name('beranda');

    // Management Koleksi
    Route::get('/collection', [BukuController::class, 'indexAdmin'])->name('bukus.index');
    Route::get('/collections', [BukuController::class, 'index'])->name('koleksi');

    // CRUD Buku
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

    // Profile Management (Blade)
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/edit-profile', [ProfileController::class, 'update'])->name('profile.update');

    // Reader Mode - VERSI ANTI-KOSONG
    Route::get('/reader/{google_id}', function ($google_id) {
        // Cari buku di DB lokal
        $buku = \App\Models\Buku::where('google_id', $google_id)->first();

        // Kalau di DB GAK ADA, tanya Google API
        if (!$buku) {
            $response = Http::get("https://www.googleapis.com/books/v1/volumes/{$google_id}");
            $googleData = $response->json();
            $volInfo = $googleData['volumeInfo'] ?? null;

            $buku = (object) [
                'judul'     => $volInfo['title'] ?? 'Koleksi Digital',
                'penulis'   => isset($volInfo['authors']) ? implode(', ', $volInfo['authors']) : 'Anonim',
                'deskripsi' => strip_tags($volInfo['description'] ?? 'Deskripsi tidak tersedia.'),
                'penerbit'  => $volInfo['publisher'] ?? '-',
                'kategori'  => 'Umum' // Kasih teks biasa aja biar aman
            ];
        } else {
            // Kalau di DB ADA, kita paksa kategori jadi teks biasa biar gak error Object
            $buku->kategori_nama = "Koleksi Pribadi";
        }

        return view('reader', ['id' => $google_id, 'buku' => $buku]);
    })->name('reader');
});
