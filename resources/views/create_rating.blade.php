@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Rating untuk Buku: <strong>{{ $book->judul }}</strong></h4>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('store_rating') }}" method="POST">
        @csrf
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <div class="form-group mb-3">
            <label for="rating">Rating</label>
            <select name="rating" class="form-control" required>
                <option value="">-- Pilih Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ optional($existing)->rating == $i ? 'selected' : '' }}>
                        {{ $i }} ⭐
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="review">Review</label>
            <textarea name="review" class="form-control" placeholder="Tulis ulasan (opsional)">{{ old('review', optional($existing)->review) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $existing ? 'Perbarui' : 'Simpan' }}
        </button>
        <a href="{{ route('index_rating') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
