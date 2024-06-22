<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_buku',
        'pengarang',
        'tahun_terbit',
        'jumlah_halaman',
        'penerbit',
        'kategori',
        'img_url',
        'rating',
        'likes_count', // Tambahkan likes_count ke fillable
    ];

    public function userLikes()
    {
        return $this->hasMany(UserLike::class);
    }

    // Method untuk memperbarui jumlah suka
    public function updateLikesCount()
    {
        $this->likes_count = $this->userLikes()->count();
        $this->save();
    }
}
