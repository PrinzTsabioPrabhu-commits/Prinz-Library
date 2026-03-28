<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;

// Ini adalah pintu masuknya
Route::get('/buku/{id}/preview', [BukuController::class, 'getPreview']);