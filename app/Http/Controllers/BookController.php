<?php

namespace App\Http\Controllers;
use App\Models\Book;

use Illuminate\Http\Requwest;

class BookController extends Controller
{
    public function index()
    {
        // Ambil data buku dari database, misalnya dengan model Book
        // dd(Book::all());
        $books = Book::all();

        return view('books.index', compact('books'));
    }
}
