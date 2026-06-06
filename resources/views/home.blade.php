@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="container">
            <div class="row mb-4">
                <div class="col text-center">
                    <h2 class="font-weight-bold">
                        @if (Auth::user()->is_admin)
                            Dashboard Admin Perpustakaan
                        @else
                            Dashboard Siswa Perpustakaan
                        @endif
                    </h2>
                    <p class="text-muted">Selamat datang, {{ Auth::user()->name }}.</p>
                </div>
            </div>

            @if (Auth::user()->is_admin)
                <div class="row">
                    <!-- Card Stat -->
                    @include('partials.home-cards', [
                        'title' => 'Total Buku',
                        'count' => $totalBooks,
                        'icon' => 'fa-book',
                        'color' => 'primary',
                    ])
                    @include('partials.home-cards', [
                        'title' => 'Buku Tersedia',
                        'count' => $availableBooks,
                        'icon' => 'fa-book-open',
                        'color' => 'success',
                    ])
                    @include('partials.home-cards', [
                        'title' => 'Total Siswa',
                        'count' => $totalMembers,
                        'icon' => 'fa-users',
                        'color' => 'info',
                    ])
                    @include('partials.home-cards', [
                        'title' => 'Peminjaman Aktif',
                        'count' => $activeBorrowings,
                        'icon' => 'fa-hand-holding',
                        'color' => 'warning',
                    ])
                </div>

                <div class="row">
                    <!-- Chart Peminjaman Bulanan -->
                    <div class="col-xl-8 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="m-0">Statistik Peminjaman Buku</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="borrowedBooksChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Buku Paling Dipinjam -->
                    <div class="col-xl-4 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-info text-white">
                                <h5 class="m-0">Top 5 Buku Terpopuler</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="topBooksChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Chart Rating Buku -->
                    <div class="col-xl-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-warning text-white">
                                <h5 class="m-0">Top 5 Buku Rating Tertinggi</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="topRatingChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="m-0">Statistik Kunjungan Perpustakaan</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="visitorsChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <!-- Home siswa -->
                    <div class="col-md-12 mb-4">
                        <div class="card shadow">
                            <div class="card-header bg-primary text-white">
                                <h5 class="m-0">Menu Siswa</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('show_book') }}" class="btn btn-outline-primary btn-block py-3">
                                            <i class="fas fa-book fa-2x mb-2"></i><br>
                                            Katalog Buku
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('create_borrower') }}"
                                            class="btn btn-outline-success btn-block py-3">
                                            <i class="fas fa-hand-holding fa-2x mb-2"></i><br>
                                            Ajukan Peminjaman
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('index_wishlist') }}"
                                            class="btn btn-outline-warning btn-block py-3">
                                            <i class="fas fa-star fa-2x mb-2"></i><br>
                                            Wishlist
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('create_visitor') }}" class="btn btn-outline-info btn-block py-3">
                                            <i class="fas fa-user-check fa-2x mb-2"></i><br>
                                            Absen Kunjungan
                                        </a>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <a href="{{ route('create_member') }}"
                                            class="btn btn-outline-secondary btn-block py-3">
                                            <i class="fas fa-user-plus fa-2x mb-2"></i><br>
                                            Pendaftaran Anggota
                                        </a>
                                    </div>
                                    @if (Auth::user()->member && Auth::user()->member->status == 'Aktif')
                                        <div class="col-md-3 mb-3">
                                            <a href="{{ route('members.printCard', Auth::user()->member->id) }}"
                                                class="btn btn-outline-primary btn-block py-3">
                                                <i class="fas fa-id-card fa-2x mb-2"></i><br>
                                                Cetak Kartu Anggota
                                            </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h5 class="m-0 text-center">📚 Rekomendasi Buku Berdasarkan Rating Tertinggi</h5>
                </div>
                <div class="card-body">
                    @if ($topRatedBooks->count() > 0)
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach ($topRatedBooks as $book)
                                <div class="col">
                                    <div class="card h-100 border-primary shadow-sm">
                                        @if ($book->cover)
                                            <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top"
                                                alt="Cover {{ $book->judul }}"
                                                style="height: 180px; object-fit: contain; padding:10px;">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">{{ $book->judul }}</h6>
                                            <p class="card-text mb-1"><strong>Pengarang:</strong>
                                                {{ $book->pengarang }}</p>
                                            <p class="card-text mb-1"><strong>Rata-rata Rating:</strong>
                                                {{ number_format($book->ratings_avg_rating, 1) }} ⭐</p>
                                            <a href="{{ route('show_book', $book->id) }}"
                                                class="btn btn-outline-primary btn-sm mt-2">
                                                <i class="fas fa-eye"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Belum ada buku yang memiliki rating.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    </div>
    @if (Auth::user()->is_admin)
        <div>
            <script type="module">
                import Chatbot from "https://cdn.jsdelivr.net/npm/flowise-embed/dist/web.js"
                Chatbot.init({
                    chatflowid: "c0777810-bdc4-4633-a82e-41b2d592e945",
                    apiHost: "http://localhost:3000",
                })
            </script>
        </div>
    @endif
    @include('partials.home-scripts')
@endsection
@section('styles')
    <style>
        .card:hover {
            transform: scale(1.03);
            transition: 0.3s;
        }
    </style>
@endsection
