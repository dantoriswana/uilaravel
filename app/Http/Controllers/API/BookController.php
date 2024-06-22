<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Metode untuk mengambil semua data buku
    public function index()
    {
        $books = Book::all(); // Mengambil semua data buku dari database

        return response()->json($books, 200);
    }

    // Metode untuk menyimpan buku baru
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'judul_buku' => 'required|string',
            'pengarang' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'jumlah_halaman' => 'required|integer',
            'penerbit' => 'required|string',
            'kategori' => 'required|string',
            'img_url' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5', // Validasi rating (0-5)
            'disukai' => 'nullable|boolean', // Validasi disukai (boolean)
        ]);

        // Simpan data buku
        $book = Book::create([
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_halaman' => $request->jumlah_halaman,
            'penerbit' => $request->penerbit,
            'kategori' => $request->kategori,
            'img_url' => $request->img_url,
            'rating' => $request->rating ?? 0, // Menggunakan nilai default 0 jika rating tidak disediakan
            'disukai' => $request->disukai ?? false, // Menggunakan nilai default false jika tidak disukai tidak disediakan
        ]);

        // Pesan sukses
        $message = "Buku berhasil disimpan.";

        return response()->json(['message' => $message, 'book' => $book], 201);
    }

    // Metode untuk mengupdate data buku
    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'judul_buku' => 'required|string',
            'pengarang' => 'required|string',
            'tahun_terbit' => 'required|integer',
            'jumlah_halaman' => 'required|integer',
            'penerbit' => 'required|string',
            'kategori' => 'required|string',
            'img_url' => 'nullable|string',
            'rating' => 'nullable|numeric|min:0|max:5', // Validasi rating (0-5)
            'disukai' => 'nullable|boolean', // Validasi disukai (boolean)
        ]);

        // Cari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Update data buku
        $book->update([
            'judul_buku' => $request->judul_buku,
            'pengarang' => $request->pengarang,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah_halaman' => $request->jumlah_halaman,
            'penerbit' => $request->penerbit,
            'kategori' => $request->kategori,
            'img_url' => $request->img_url,
            'rating' => $request->rating ?? $book->rating, // Menggunakan nilai existing jika rating tidak disediakan
            'disukai' => $request->disukai ?? $book->disukai, // Menggunakan nilai existing jika tidak disukai tidak disediakan
        ]);

        // Pesan sukses
        $message = "Buku berhasil diperbarui.";

        return response()->json(['message' => $message, 'book' => $book], 200);
    }

    // Metode untuk menghapus buku
    public function destroy($id)
    {
        // Cari buku berdasarkan ID
        $book = Book::findOrFail($id);

        // Hapus buku
        $book->delete();

        // Pesan sukses
        $message = "Buku berhasil dihapus.";

        return response()->json(['message' => $message], 200);
    }
}
