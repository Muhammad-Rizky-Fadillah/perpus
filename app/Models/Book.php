<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'category_id',
        'pengarang',
        'stock',
        'cover',
        'rak_buku'
    ];
    public function borrowers()
    {
        return $this->belongsToMany(Borrower::class)->withTimestamps();
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function damagedBooks()
    {
        return $this->hasMany(DamagedBook::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    // app/Models/Book.php
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
