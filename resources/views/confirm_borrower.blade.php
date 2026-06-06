@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        {{-- Flash message sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        {{-- Flash message error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center mb-4 fw-bold text-primary">Daftar Peminjaman Buku</h2>
        <div class="row">
            @foreach ($borrowers as $borrower)
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                Buku Dipinjam:
                                <ul class="ps-3">
                                    @foreach ($borrower->books as $book)
                                        <li class="d-flex align-items-center mb-2">
                                            <img src="{{ asset('storage/' . $book->cover) }}"
                                                alt="Cover {{ $book->judul }}"
                                                style="width: 50px; height: 70px; object-fit: cover; margin-right: 10px;">
                                            {{ $book->judul }}
                                        </li>
                                    @endforeach
                                </ul>
                            </h5>

                            <p class="mb-1">Nama Peminjam: <strong>{{ $borrower->user->name }}</strong></p>
                            <p class="mb-1">NIS: <strong>{{ $borrower->user->nis }}</strong></p>
                            <p class="mb-1">Tanggal Pinjam:
                                <strong>{{ \Carbon\Carbon::parse($borrower->tgl_pinjam)->format('d-m-Y') }}</strong></p>

                            <p>Status Peminjaman:
                                @if ($borrower->is_confirm)
                                    <span class="badge bg-success">Dikonfirmasi ✅</span>
                                @else
                                    <span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>
                                @endif
                            </p>

                            {{-- Tombol konfirmasi untuk admin --}}
                            @if (!$borrower->is_confirm && Auth::user()->is_admin)
                                <form action="{{ route('approve_borrower', $borrower->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="fas fa-check-circle me-1"></i> Konfirmasi Peminjaman
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
