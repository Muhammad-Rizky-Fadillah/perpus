{{-- resources/views/wishlist/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4 fw-bold text-primary">Daftar Wishlist Buku</h3>

    @if ($wishlistedBooks->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Belum ada buku di wishlist Anda.
        </div>
    @else
        <div class="row">
            @foreach ($wishlistedBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}"
                                 class="card-img-top bg-light"
                                 alt="Cover {{ $book->judul }}"
                                 style="height: 200px; object-fit: contain; padding: 10px;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $book->judul }}</h5>
                            <p class="card-text mb-1"><strong>Pengarang:</strong> {{ $book->pengarang }}</p>
                            <p class="card-text"><strong>Kategori:</strong> {{ $book->category->nama_kategori ?? '-' }}</p>
                        </div>

                        @unless (Auth::user()->is_admin)
                            <div class="card-footer d-flex justify-content-between">
                                <form action="{{ route('remove_wishlist', $book->id) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>

                                <form action="{{ route('create_borrower') }}" method="GET" class="m-0">
                                    <input type="hidden" name="books[]" value="{{ $book->id }}">
                                    <button class="btn btn-warning btn-sm">
                                        <i class="fas fa-book-reader"></i> Pinjam
                                    </button>
                                </form>
                            </div>
                        @endunless
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
