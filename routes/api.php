<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IsiBukuController;

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Protected routes (requires JWT authentication)
Route::middleware('auth:api')->group(function () {
    Route::post('books', [BookController::class, 'store']); // Menyimpan buku baru
    Route::get('books', [BookController::class, 'index']); // Mengambil semua buku
    Route::put('books/{id}', [BookController::class, 'update']); // Update buku berdasarkan ID
    Route::delete('books/{id}', [BookController::class, 'destroy']); // Hapus buku berdasarkan ID
    Route::post('isi-bukus', [IsiBukuController::class, 'store']);
    Route::get('isi-bukus', [IsiBukuController::class, 'index']);
    Route::get('isi-bukus/{id}', [IsiBukuController::class, 'show']);
    Route::put('isi-bukus/{id}', [IsiBukuController::class, 'update']);
    Route::delete('isi-bukus/{id}', [IsiBukuController::class, 'destroy']);
});



