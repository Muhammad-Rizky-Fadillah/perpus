@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Laporan Buku Rusak</h1>

    <div class="card shadow">
        <div class="card-body">
            <form method="POST" action="{{ route('store_damaged') }}">
                @csrf

                <div class="form-group">
                    <label>Judul Buku</label>
                    <select name="book_id" class="form-control" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">
                                {{ $book->judul }} @if($book->rak_buku) (Rak: {{ $book->rak_buku }}) @endif
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Jumlah Rusak</label>
                    <input type="number" name="jumlah" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" placeholder="Contoh: sobek, basah">
                </div>

                <div class="form-group">
                    <label>Tanggal Rusak</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('index_damaged') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
