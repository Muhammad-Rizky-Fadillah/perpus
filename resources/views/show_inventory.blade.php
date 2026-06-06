@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Header dan Tombol Aksi --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary font-weight-bold mb-0">📦 Daftar Inventaris Perpustakaan</h3>
            <div>
                <a href="{{ route('create_inventory') }}" class="btn btn-success shadow-sm mr-2">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                </a>
                <form action="{{ route('cetak_inventory') }}" method="get" class="d-inline">
                    <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                    <button class="btn btn-primary shadow-sm">
                        <i class="fas fa-print mr-1"></i> Cetak Data
                    </button>
                </form>
            </div>
        </div>

        {{-- Filter Per Tahun --}}
        <div class="card shadow rounded-lg mb-4">
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">🔍 Filter Data Inventaris Berdasarkan Tahun</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('show_inventory') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" id="tahun" name="tahun" class="form-control"
                            value="{{ request('tahun') }}" placeholder="Masukkan tahun">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary mr-2">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                        <a href="{{ route('show_inventory') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Data --}}
        <div class="card shadow rounded-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Merk</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Keadaan</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $key => $inventory)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $inventory->nama }}</td>
                                    <td class="text-center">{{ $inventory->merk }}</td>
                                    <td class="text-center">{{ $inventory->tahun }}</td>
                                    <td class="text-center">{{ $inventory->jumlah }}</td>
                                    <td class="text-center">Rp. {{ number_format($inventory->harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($inventory->keadaan == 'Baik')
                                            <span class="badge badge-success">Baik</span>
                                        @elseif($inventory->keadaan == 'Rusak Ringan')
                                            <span class="badge badge-secondary">Rusak Ringan</span>
                                        @elseif($inventory->keadaan == 'Rusak Berat')
                                            <span class="badge badge-danger">Rusak Berat</span>
                                        @else
                                            <span class="badge badge-primary">{{ $inventory->keadaan }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $inventory->keterangan }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_inventory', $inventory) }}"
                                            class="btn btn-sm btn-info shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete_inventory', $inventory) }}" method="post"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($inventories->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-center text-muted">Tidak ada data inventaris.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
