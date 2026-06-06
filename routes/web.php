<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\DamagedBookController;
use App\Http\Controllers\RatingReportController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\StockOpnameController;
use App\Http\Controllers\BackupController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::middleware(['admin'])->group(function () {

    Route::get('/user/verifikasi', [UserController::class, 'verifikasiIndex'])->name('user.verifikasi');
    Route::post('/user/verifikasi/{id}', [UserController::class, 'verifikasiStore'])->name('user.verifikasi.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');


    Route::get('/inventory/create', [InventoryController::class, 'create_inventory'])->name('create_inventory');
    Route::post('/inventory/create', [InventoryController::class, 'store_inventory'])->name('store_inventory');
    Route::get('/inventory', [InventoryController::class, 'show_inventory'])->name('show_inventory');
    Route::get('/inventory/{inventory}/edit', [InventoryController::class, 'edit_inventory'])->name('edit_inventory');
    Route::patch('/inventory/{inventory}/update', [InventoryController::class, 'update_inventory'])->name('update_inventory');
    Route::delete('/inventory/{inventory}', [InventoryController::class, 'delete_inventory'])->name('delete_inventory');
    Route::get('/inventory/view/pdf', [InventoryController::class, 'cetak_inventory'])->name('cetak_inventory');

    Route::get('/stock-opname', [StockOpnameController::class, 'index_opname'])->name('index_opname');
    Route::get('/stock-opname/create', [StockOpnameController::class, 'create_opname'])->name('create_opname');
    Route::post('/stock-opname', [StockOpnameController::class, 'store_opname'])->name('store_opname');
    Route::get('/opname/view/pdf', [StockOpnameController::class, 'cetak_opname'])->name('cetak_opname');

    Route::get('/member', [MemberController::class, 'show_member'])->name('show_member');
    Route::get('/member/{member}/edit', [MemberController::class, 'edit_member'])->name('edit_member');
    Route::patch('/member/{member}/update', [MemberController::class, 'update_member'])->name('update_member');
    Route::delete('/member/{member}', [MemberController::class, 'delete_member'])->name('delete_member');
    Route::get('/member/view/pdf', [MemberController::class, 'cetak_member'])->name('cetak_member');


    Route::get('/visitor', [VisitorController::class, 'show_visitor'])->name('show_visitor');
    Route::get('/visitor/{visitor}/edit', [VisitorController::class, 'edit_visitor'])->name('edit_visitor');
    Route::patch('/visitor/{visitor}/update', [VisitorController::class, 'update_visitor'])->name('update_visitor');
    Route::delete('/visitor/{visitor}', [VisitorController::class, 'delete_visitor'])->name('delete_visitor');
    Route::get('/visitor/view/pdf', [VisitorController::class, 'cetak_visitor'])->name('cetak_visitor');

    Route::get('/borrower', [BorrowerController::class, 'show_borrower'])->name('show_borrower');
    Route::get('/borrower/{borrower}/edit', [BorrowerController::class, 'edit_borrower'])->name('edit_borrower');
    Route::patch('/borrower/{borrower}/update', [BorrowerController::class, 'update_borrower'])->name('update_borrower');
    Route::delete('/borrower/{borrower}', [BorrowerController::class, 'delete_borrower'])->name('delete_borrower');
    Route::get('/borrower/view/pdf', [BorrowerController::class, 'cetak_borrower'])->name('cetak_borrower');
    Route::post('/admin/approve-borrower/{id}', [BorrowerController::class, 'approve_borrower'])->name('approve_borrower');

    Route::get('/guest/create', [GuestController::class, 'create_guest'])->name('create_guest');
    Route::post('/guest/create', [GuestController::class, 'store_guest'])->name('store_guest');
    Route::get('/guest', [GuestController::class, 'show_guest'])->name('show_guest');
    Route::get('/guest/{guest}/edit', [GuestController::class, 'edit_guest'])->name('edit_guest');
    Route::patch('/guest/{guest}/update', [GuestController::class, 'update_guest'])->name('update_guest');
    Route::delete('/guest/{guest}', [GuestController::class, 'delete_guest'])->name('delete_guest');
    Route::get('/guest/view/pdf', [GuestController::class, 'cetak_guest'])->name('cetak_guest');

    Route::get('/teacher/create', [TeacherController::class, 'create_teacher'])->name('create_teacher');
    Route::post('/teacher/create', [TeacherController::class, 'store_teacher'])->name('store_teacher');
    Route::get('/teacher', [teacherController::class, 'show_teacher'])->name('show_teacher');
    Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit_teacher'])->name('edit_teacher');
    Route::patch('/teacher/{teacher}/update', [TeacherController::class, 'update_teacher'])->name('update_teacher');
    Route::delete('/teacher/{teacher}', [TeacherController::class, 'delete_teacher'])->name('delete_teacher');
    Route::get('/teacher/view/pdf', [TeacherController::class, 'cetak_teacher'])->name('cetak_teacher');

    Route::get('/book/create', [BookController::class, 'create_book'])->name('create_book');
    Route::post('/book/create', [BookController::class, 'store_book'])->name('store_book');
    Route::get('/book/{book}/edit', [BookController::class, 'edit_book'])->name('edit_book');
    Route::patch('/book/{book}/update', [BookController::class, 'update_book'])->name('update_book');
    Route::delete('/book/{book}', [BookController::class, 'delete_book'])->name('delete_book');
    Route::get('/book/view/pdf', [BookController::class, 'cetak_book'])->name('cetak_book');
    Route::put('/confirmReturn/{id}', [BorrowerController::class, 'confirmReturn'])->name('borrowers.return');

    Route::get('/category/create', [CategoryController::class, 'create_category'])->name('create_category');
    Route::post('/category/create', [CategoryController::class, 'store_category'])->name('store_category');
    Route::get('/category', [CategoryController::class, 'show_category'])->name('show_category');
    Route::get('/category/{category}/edit', [CategoryController::class, 'edit_category'])->name('edit_category');
    Route::patch('/category/{category}/update', [CategoryController::class, 'update_category'])->name('update_category');
    Route::delete('/category/{category}', [CategoryController::class, 'delete_category'])->name('delete_category');

    Route::get('/damaged/create', [DamagedBookController::class, 'create_damaged'])->name('create_damaged');
    Route::post('/damaged/create', [DamagedBookController::class, 'store_damaged'])->name('store_damaged');
    Route::get('/damaged', [DamagedBookController::class, 'index_damaged'])->name('index_damaged');
    Route::get('/damaged/{damaged}/edit', [DamagedBookController::class, 'edit_damaged'])->name('edit_damaged');
    Route::patch('/damaged/{damaged}/update', [DamagedBookController::class, 'update_damaged'])->name('update_damaged');
    Route::delete('/damaged/{damaged}', [DamagedBookController::class, 'delete_damaged'])->name('delete_damaged');
    Route::get('/damaged/view/pdf', [DamagedBookController::class, 'cetak_damaged'])->name('cetak_damaged');
    Route::get('/member/verifikasi', [MemberController::class, 'verifikasiIndex'])->name('member.verifikasi');
    Route::post('/member/verifikasi/{id}', [MemberController::class, 'verifikasiStore'])->name('member.verifikasi.store');

    Route::get('/rating', [RatingReportController::class, 'index_rating'])->name('index_rating');
    Route::get('/rating/cetak', [RatingReportController::class, 'cetak_rating'])->name('cetak_rating');

    Route::get('/structure/view/pdf', [HomeController::class, 'cetak_structure'])->name('cetak_structure');

    Route::get('/backup', [BackupController::class, 'index'])->name('backup.index');
    Route::post('/backup/run', [BackupController::class, 'run'])->name('backup.run');
    Route::get('/backup/download/{file}', [BackupController::class, 'download'])->name('backup.download');
    Route::delete('/backup/delete/{file}', [BackupController::class, 'destroy'])->name('backup.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/book', [BookController::class, 'show_book'])->name('show_book');
    Route::get('/index/borrower', [BorrowerController::class, 'index_borrower'])->name('index_borrower');
    Route::get('/borrower/create', [BorrowerController::class, 'create_borrower'])->name('create_borrower');
    Route::get('/search_book', [BorrowerController::class, 'search_book'])->name('search_book');
    Route::get('/search_member', [BorrowerController::class, 'search_member'])->name('search_member');
    Route::get('/confirm_borrower', [BorrowerController::class, 'confirm_borrower'])->name('confirm_borrower');
    Route::post('/borrower/create', [BorrowerController::class, 'store_borrower'])->name('store_borrower');
    Route::get('/profile', [ProfileController::class, 'show_profile'])->name('show_profile');
    Route::post('/profile/edit', [ProfileController::class, 'edit_profile'])->name('edit_profile');
    Route::get('/structure', [HomeController::class, 'show_structure'])->name('show_structure');
    Route::get('/regulation', [HomeController::class, 'regulation'])->name('regulation');
    Route::get('/api/statistik-peminjaman', [StatistikController::class, 'getPeminjamanBuku'])->name('getPeminjamanBuku');
    Route::get('/visitor/create', [VisitorController::class, 'create_visitor'])->name('create_visitor');
    Route::post('/visitor/create', [VisitorController::class, 'store_visitor'])->name('store_visitor');
    Route::get('/rating/create/{book}', [RatingReportController::class, 'create_rating'])->name('create_rating');
    Route::post('/rating/store', [RatingReportController::class, 'store_rating'])->name('store_rating');
    Route::get('/rating/edit/{rating}', [RatingReportController::class, 'edit_rating'])->name('edit_rating');
    Route::patch('/rating/update/{rating}', [RatingReportController::class, 'update_rating'])->name('update_rating');
    Route::delete('/rating/delete/{rating}', [RatingReportController::class, 'delete_rating'])->name('delete_rating');
    Route::get('/wishlist', [WishlistController::class, 'index_wishlist'])->name('index_wishlist');
    Route::post('/wishlist/add/{book}', [WishlistController::class, 'add_wishlist'])->name('add_wishlist');
    Route::delete('/wishlist/remove/{book}', [WishlistController::class, 'remove_wishlist'])->name('remove_wishlist');
    Route::get('/member/create', [MemberController::class, 'create_member'])->name('create_member');
    Route::post('/member/create', [MemberController::class, 'store_member'])->name('store_member');
    Route::post('/mark-as-read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    })->name('markAsRead');


    Route::get('/members/{id}/card', [MemberController::class, 'printCard'])->name('members.printCard');

    
});

Route::get('/jalankan-migrasi', function() {
    try {
        // Menjalankan migrasi database
        Artisan::call('migrate:fresh', ['--force' => true]);
        
        // Menjalankan seeder jika ada (opsional, hapus jika tidak pakai seeder)
        // Artisan::call('db:seed', ['--force' => true]); 
        
        return "Selamat! Struktur tabel perpustakaan sukses dibuat di Supabase Cloud.";
    } catch (\Exception $e) {
        return "Gagal migrasi. Error: " . $e->getMessage();
    }
});
