<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrower;

class HomeController extends Controller
{

    public function home()
    {
        $totalBooks = Book::count();
        $availableBooks = Book::where('stock', '>', 0)->count();
        $totalMembers = User::where('is_admin', false)
            ->where('is_verified', true)
            ->count();

        $activeBorrowings = Borrower::where('is_confirm', true)
            ->whereNull('tgl_kembali_confirm')
            ->count();

        $topRatedBooks = Book::with('ratings')
            ->withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(3)
            ->get();

        return view('home', compact('totalBooks', 'availableBooks', 'totalMembers', 'activeBorrowings', 'topRatedBooks'));
    }

    public function regulation()
    {
        return view('regulation');
    }

    public function show_structure()
    {
        return view('show_structure');
    }

    public function cetak_structure()
    {
        $pdf = Pdf::loadView('cetak_structure');

        $pdf->setPaper('A3', 'landscape');

        return $pdf->stream('struktur.pdf');
    }
}
