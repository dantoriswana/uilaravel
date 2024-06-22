<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsiBuku extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'book_id',
        'content',
    ];

    /**
     * Get the book that owns the IsiBuku.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
