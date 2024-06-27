<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\IsiBukuController;

// Auth routes
// Route::post('register', [RegisterController::class, 'register']);

Route::post('/register', App\Http\Controllers\api\RegisterController::class)->name('register');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
Route::get('/user', [AuthController::class, 'me'])->middleware('auth:api');
// Protected routes (requires JWT authentication)
Route::middleware('auth:api')->group(function () {
    Route::post('books', [BookController::class, 'store']); // Menyimpan buku baru
    Route::get('books', [BookController::class, 'index']); // Mengambil semua buku
    Route::get('books/{id}', [BookController::class, 'show']);
    Route::put('books/{id}', [BookController::class, 'update']); // Update buku berdasarkan ID
    Route::delete('books/{id}', [BookController::class, 'destroy']); // Hapus buku berdasarkan ID
    Route::post('isi-bukus', [IsiBukuController::class, 'store']);
    Route::get('isi-bukus', [IsiBukuController::class, 'index']);
    Route::get('isi-bukus/{id}', [IsiBukuController::class, 'show']);
    Route::put('isi-bukus/{id}', [IsiBukuController::class, 'update']);
    Route::delete('isi-bukus/{id}', [IsiBukuController::class, 'destroy']);
    Route::post('books/{id}/rating', [BookController::class, 'addRating']);
    Route::post('books/{id}/disukai', [BookController::class, 'addLike']);
    Route::delete('books/{id}/disukai', [BookController::class, 'removeLike']);
});



