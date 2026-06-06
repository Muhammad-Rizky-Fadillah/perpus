@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Rating Buku</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('update_rating', $rating->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group mb-3">
            <label for="book_id">Pilih Buku</label>
            <select name="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ $book->id == $rating->book_id ? 'selected' : '' }}>
                        {{ $book->judul }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="rating">Rating</label>
            <select name="rating" class="form-control" required>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ $rating->rating == $i ? 'selected' : '' }}>
                        {{ $i }} ⭐
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="review">Review</label>
            <textarea name="review" class="form-control">{{ old('review', $rating->review) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('index_rating') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
