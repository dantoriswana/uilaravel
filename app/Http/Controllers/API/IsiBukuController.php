<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IsiBuku;

class IsiBukuController extends Controller
{
    // Metode untuk mengambil semua data isi buku
    public function index()
    {
        $isiBukus = IsiBuku::all();
        return response()->json($isiBukus, 200);
    }

    // Metode untuk menyimpan isi buku baru
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
        ]);

        // Simpan data isi buku
        $isiBuku = IsiBuku::create([
            'book_id' => $request->book_id,
            'content' => $request->content,
        ]);

        // Pesan sukses
        $message = "Isi buku berhasil disimpan.";

        return response()->json(['message' => $message, 'isi_buku' => $isiBuku], 201);
    }

    // Metode untuk menampilkan satu isi buku berdasarkan ID
    public function show($id)
    {
        $isiBuku = IsiBuku::find($id);

        if (!$isiBuku) {
            return response()->json(['message' => 'Isi buku tidak ditemukan'], 404);
        }

        return response()->json($isiBuku, 200);
    }

    // Metode untuk memperbarui data isi buku
    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'content' => 'required|string',
        ]);

        // Cari isi buku berdasarkan ID
        $isiBuku = IsiBuku::find($id);

        if (!$isiBuku) {
            return response()->json(['message' => 'Isi buku tidak ditemukan'], 404);
        }

        // Perbarui data isi buku
        $isiBuku->update([
            'book_id' => $request->book_id,
            'content' => $request->content,
        ]);

        // Pesan sukses
        $message = "Isi buku berhasil diperbarui.";

        return response()->json(['message' => $message, 'isi_buku' => $isiBuku], 200);
    }

    // Metode untuk menghapus isi buku
    public function destroy($id)
    {
        $isiBuku = IsiBuku::find($id);

        if (!$isiBuku) {
            return response()->json(['message' => 'Isi buku tidak ditemukan'], 404);
        }

        $isiBuku->delete();

        // Pesan sukses
        $message = "Isi buku berhasil dihapus.";

        return response()->json(['message' => $message], 200);
    }
}
