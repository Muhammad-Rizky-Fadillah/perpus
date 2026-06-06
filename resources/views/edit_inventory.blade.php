@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Perbarui Data Inventaris') }}</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('update_inventory', $inventory) }}" method="post">
                            @method('patch')
                            @csrf

                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" name="nama" class="form-control"
                                    value="{{ old('nama', $inventory->nama) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Merk</label>
                                <input type="text" name="merk" class="form-control"
                                    value="{{ old('merk', $inventory->merk) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Tahun</label>
                                <input type="number" name="tahun" class="form-control"
                                    value="{{ old('tahun', $inventory->tahun) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" class="form-control"
                                    value="{{ old('jumlah', $inventory->jumlah) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control"
                                    value="{{ old('harga', $inventory->harga) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="keadaan">Keadaan</label>
                                <select name="keadaan" id="keadaan" class="form-control" required>
                                    <option value="" disabled
                                        {{ old('keadaan', $inventory->keadaan) == '' ? 'selected' : '' }}>Pilih keadaan
                                        barang</option>
                                    <option value="Baik"
                                        {{ old('keadaan', $inventory->keadaan) == 'Baik' ? 'selected' : '' }}>Baik</option>
                                    <option value="Rusak Ringan"
                                        {{ old('keadaan', $inventory->keadaan) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak
                                        Ringan</option>
                                    <option value="Rusak Berat"
                                        {{ old('keadaan', $inventory->keadaan) == 'Rusak Berat' ? 'selected' : '' }}>Rusak
                                        Berat</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" name="keterangan" class="form-control"
                                    value="{{ old('keterangan', $inventory->keterangan) }}">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Perbarui Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
