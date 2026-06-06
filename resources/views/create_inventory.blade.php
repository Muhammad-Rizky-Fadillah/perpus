@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Buat Inventaris Baru</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Tambah Inventaris</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store_inventory') }}" method="POST" class="user">
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
                                <label for="nama">Nama Barang:</label>
                                <input type="text" name="nama" class="form-control form-control-user"
                                    placeholder="Masukkan nama barang" value="{{ old('nama') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="merk">Merk:</label>
                                <input type="text" name="merk" class="form-control form-control-user"
                                    placeholder="Masukkan merk barang" value="{{ old('merk') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <input type="number" name="tahun" class="form-control form-control-user"
                                    placeholder="Masukkan tahun pembelian" value="{{ old('tahun') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" name="jumlah" class="form-control form-control-user"
                                    placeholder="Masukkan jumlah barang" value="{{ old('jumlah') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="text" name="harga" id="harga"
                                        class="form-control form-control-user" placeholder="Masukkan harga barang"
                                        value="{{ old('harga') ? number_format(old('harga'), 0, ',', '.') : '' }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keadaan">Keadaan:</label>
                                <select name="keadaan" id="keadaan" class="form-control" required>
                                    <option value="" disabled selected>Pilih keadaan barang</option>
                                    <option value="Baik" {{ old('keadaan') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Rusak Ringan" {{ old('keadaan') == 'Rusak Ringan' ? 'selected' : '' }}>
                                        Rusak Ringan</option>
                                    <option value="Rusak Berat" {{ old('keadaan') == 'Rusak Berat' ? 'selected' : '' }}>
                                        Rusak Berat</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="keterangan">Keterangan:</label>
                                <input type="text" name="keterangan" class="form-control form-control-user"
                                    placeholder="Masukkan keterangan tambahan" value="{{ old('keterangan') }}">
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-user">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('show_inventory') }}" class="btn btn-danger btn-user">
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
