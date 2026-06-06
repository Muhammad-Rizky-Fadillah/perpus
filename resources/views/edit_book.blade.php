@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Edit Data Buku') }}</div>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('update_book', $book) }}" method="POST" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            {{-- Judul Buku --}}
                            <div class="form-group">
                                <label for="judul">Judul Buku</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    value="{{ old('judul', $book->judul) }}" required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label for="category_id">Pilih Kategori</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pengarang --}}
                            <div class="form-group">
                                <label for="pengarang">Nama Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control"
                                    value="{{ old('pengarang', $book->pengarang) }}" required>
                            </div>

                            {{-- Stok Buku --}}
                            <div class="form-group">
                                <label for="stock">Stok Buku</label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    value="{{ old('stock', $book->stock) }}" required>
                            </div>

                            {{-- Rak Buku --}}
                            <div class="form-group">
                                <label for="rak_buku">Rak Buku</label>
                                <select id="rak_buku" name="rak_buku" class="form-control" required>
                                    <option value="">-- Pilih Rak --</option>
                                    @php
                                        $rakOptions = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
                                        // jika editing (ada $book) gunakan $book->rak_buku, jika create gunakan old()
                                        $selectedRak = old('rak_buku', isset($book) ? $book->rak_buku : null);
                                    @endphp
                                    @foreach ($rakOptions as $rak)
                                        <option value="{{ $rak }}" {{ $selectedRak == $rak ? 'selected' : '' }}>
                                            {{ $rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Cover Buku Saat Ini --}}
                            <div class="form-group mt-3">
                                <label>Cover Buku Saat Ini:</label><br>
                                @if ($book->cover)
                                    <img src="{{ asset('storage/' . $book->cover) }}" width="150" alt="Cover Buku">
                                @else
                                    <p class="text-muted">Tidak ada cover tersedia.</p>
                                @endif
                            </div>

                            {{-- Ganti Cover --}}
                            <div class="form-group mt-2">
                                <label for="cover">Ganti Cover (Opsional)</label>
                                <input type="file" name="cover" id="cover" class="form-control-file"
                                    accept="image/*">
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fas fa-save"></i> Submit Data
                            </button>
                            <a href="{{ route('show_book') }}" class="btn btn-secondary mt-3">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
