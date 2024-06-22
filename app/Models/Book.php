<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku', 'pengarang', 'tahun_terbit', 'jumlah_halaman', 'penerbit', 'kategori', 'img_url', 'rating', 'disukai'
    ];
}
