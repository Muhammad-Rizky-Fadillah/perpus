@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Notifikasi sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Tombol Admin --}}
        @if (Auth::user()->is_admin)
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('create_book') }}" class="btn btn-success me-2 shadow-sm">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="{{ route('cetak_book') }}" class="btn btn-info shadow-sm">
                    <i class="fas fa-print"></i> Cetak Data
                </a>
            </div>
        @endif

        <h3 class="text-center mb-4 fw-bold text-primary">📚 Katalog Buku Perpustakaan</h3>

        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3">

                        {{-- Cover Buku --}}
                        <img src="{{ asset('storage/' . $book->cover) }}" class="card-img-top bg-light rounded-top"
                            alt="Cover {{ $book->judul }}" style="height: 220px; object-fit: contain; padding: 10px;">

                        {{-- Informasi Buku --}}
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $book->judul }}</h5>
                            <p class="card-text mb-1"><strong>Kategori:</strong> {{ $book->category->nama_kategori }}</p>
                            <p class="card-text mb-1"><strong>Pengarang:</strong> {{ $book->pengarang }}</p>
                            <p class="card-text mb-1"><strong>Stok:</strong> {{ $book->stock }}</p>
                            <p class="card-text mb-1"><strong>Rak Buku:</strong> {{ $book->rak_buku }}</p>
                            <p class="card-text mb-1">
                                <strong>Rating Rata-rata:</strong>
                                {{ number_format($book->ratings_avg_rating, 1) ?? 'Belum ada rating' }} ⭐
                            </p>

                            {{-- Button User --}}
                            @unless (Auth::user()->is_admin)
                                @php
                                    $userRating = $book->ratings->where('user_id', Auth::id())->first();

                                    $isWishlisted = Auth::user()->wishlists->contains($book->id);
                                @endphp

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- Rating Button --}}
                                    @if ($userRating)
                                        <a href="{{ route('create_rating', $book->id) }}"
                                            class="btn btn-sm btn-outline-warning shadow-sm">
                                            <i class="fas fa-edit"></i> Edit Rating
                                        </a>
                                    @else
                                        <a href="{{ route('create_rating', $book->id) }}"
                                            class="btn btn-sm btn-outline-success shadow-sm">
                                            <i class="fas fa-star"></i> Rating
                                        </a>
                                    @endif

                                    {{-- Wishlist Button --}}
                                    @if ($isWishlisted)
                                        <span class="btn btn-sm btn-outline-danger disabled shadow-sm">
                                            <i class="fas fa-heart"></i> Di Wishlist
                                        </span>
                                    @else
                                        <form action="{{ route('add_wishlist', $book->id) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-primary shadow-sm">
                                                <i class="fas fa-heart"></i> Wishlist
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endunless
                        </div>

                        {{-- Footer Card: Admin & User --}}
                        <div class="card-footer bg-light border-0 d-flex justify-content-between">
                            @if (Auth::user()->is_admin)
                                <form action="{{ route('edit_book', $book) }}" method="get" class="me-2">
                                    @csrf
                                    <button class="btn btn-sm btn-primary shadow-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>
                                <form action="{{ route('delete_book', $book) }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('create_borrower') }}" method="GET" class="w-100">
                                    <input type="hidden" name="books[]" value="{{ $book->id }}">
                                    <button type="submit" class="btn btn-warning btn-sm w-100 shadow-sm">
                                        <i class="fas fa-book-reader"></i> Pinjam Buku
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center shadow-sm">Tidak ada buku yang tersedia saat ini.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
