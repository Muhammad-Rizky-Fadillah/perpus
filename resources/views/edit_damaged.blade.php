@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Laporan Buku Rusak</h1>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('update_damaged', $data->id) }}">
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label>Judul Buku</label>
                    <select name="book_id" class="form-control" required>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ $book->id == $data->book_id ? 'selected' : '' }}>{{ $book->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Rusak</label>
                    <input type="number" name="jumlah" class="form-control" value="{{ $data->jumlah }}" required min="1">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ $data->keterangan }}">
                </div>

                <div class="form-group">
                    <label>Tanggal Rusak</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d', strtotime($data->tanggal)) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('index_damaged') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
