<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Jumlah total pengguna
        $usersCount = User::count();

        // Jumlah total buku
        $booksCount = Book::count();

        // Buku dengan like count terbanyak
        $mostLikedBook = Book::withCount('userLikes')
            ->orderBy('user_likes_count', 'desc')
            ->first();

        // Total likes untuk buku favorit
        $mostLikedBookLikes = $mostLikedBook ? $mostLikedBook->user_likes_count : 0;

        // Data untuk widget
        $widget = [
            'users' => $usersCount,
            'books' => $booksCount,
            'mostLikedBook' => $mostLikedBook,
            'mostLikedBookLikes' => $mostLikedBookLikes,
        ];

        return view('home', compact('widget'));
    }
}