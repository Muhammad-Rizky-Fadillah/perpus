@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h1 class="h4 text-gray-900">Tambahkan Buku Baru</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Buku</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store_book') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Error Validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Judul Buku --}}
                            <div class="form-group">
                                <label for="judul">Judul Buku</label>
                                <input type="text" name="judul" id="judul" class="form-control"
                                    placeholder="Masukkan judul buku" value="{{ old('judul') }}" required>
                            </div>

                            {{-- Kategori --}}
                            <div class="form-group">
                                <label for="category_id">Pilih Kategori</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Pengarang --}}
                            <div class="form-group">
                                <label for="pengarang">Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control"
                                    placeholder="Masukkan nama pengarang" value="{{ old('pengarang') }}" required>
                            </div>

                            {{-- Stok Buku --}}
                            <div class="form-group">
                                <label for="stock">Stok Buku</label>
                                <input type="number" name="stock" id="stock" class="form-control"
                                    placeholder="Masukkan jumlah stok" value="{{ old('stock') }}" required>
                            </div>

                            {{-- Rak Buku --}}
                            <div class="form-group">
                                <label for="rak_buku">Rak Buku</label>
                                <select id="rak_buku" name="rak_buku" class="form-control" required>
                                    <option value="">-- Pilih Rak --</option>
                                    @php
                                        $rakOptions = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
                                        $selectedRak = old('rak_buku'); // old input saat create
                                    @endphp
                                    @foreach ($rakOptions as $rak)
                                        <option value="{{ $rak }}" {{ $selectedRak == $rak ? 'selected' : '' }}>
                                            {{ $rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Cover Buku --}}
                            <div class="form-group">
                                <label for="cover">Cover Buku</label>
                                <input type="file" name="cover" id="cover" class="form-control-file"
                                    accept="image/*" required>
                            </div>

                            {{-- Button --}}
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('show_book') }}" class="btn btn-danger">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
