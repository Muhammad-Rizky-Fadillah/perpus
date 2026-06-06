<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/statistik-top-books', function () {
    $topBooks = DB::table('book_borrower')
        ->join('books', 'book_borrower.book_id', '=', 'books.id')
        ->select('books.judul', DB::raw('count(book_borrower.id) as jumlah'))
        ->groupBy('books.judul')
        ->orderByDesc('jumlah')
        ->limit(5)
        ->get();

    return response()->json($topBooks);
});

Route::get('/statistik-top-rating', function () {
    $topRatings = DB::table('ratings')
        ->join('books', 'ratings.book_id', '=', 'books.id')
        ->select('books.judul', DB::raw('AVG(ratings.rating) as rata_rata_rating'))
        ->groupBy('books.judul')
        ->orderByDesc('rata_rata_rating')
        ->limit(5)
        ->get();

    return response()->json($topRatings);
});

Route::get('/statistik-kunjungan', function () {
    $visitors = DB::table('visitors')
        ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->get();

    return response()->json($visitors);
});

