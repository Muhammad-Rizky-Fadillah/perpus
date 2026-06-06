@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-4">
                <h1 class="h4 text-gray-900">Tambahkan Kategori Baru</h1>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Kategori</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_category') }}" method="POST" class="user">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori:</label>
                            <input type="text" name="nama_kategori" class="form-control form-control-user" placeholder="Masukkan nama kategori buku" value="{{ old('nama_kategori') }}" required>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary btn-user">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                            <a href="{{ route('show_category') }}" class="btn btn-danger btn-user">
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
