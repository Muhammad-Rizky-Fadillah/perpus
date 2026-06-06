<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index_wishlist()
    {
         $wishlistedBooks = Auth::user()
        ->wishlists()
        ->with('book.category')
        ->get()
        ->pluck('book');

        return view('index_wishlist', compact('wishlistedBooks'));
    }

    public function add_wishlist(Book $book)
    {
        $user = Auth::user();

        $alreadyWishlisted = $user->wishlists()->where('book_id', $book->id)->exists();

        if ($alreadyWishlisted) {
            return back()->with('success', 'Buku sudah ada di wishlist.');
        }

        $user->wishlists()->create([
            'book_id' => $book->id
        ]);

        return back()->with('success', 'Buku ditambahkan ke wishlist.');
    }

    public function remove_wishlist(Book $book)
    {
        Auth::user()->wishlists()->where('book_id', $book->id)->delete();

        return back()->with('success', 'Buku dihapus dari wishlist.');
    }
}
