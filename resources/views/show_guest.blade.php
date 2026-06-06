@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Header dan Tombol Aksi --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary font-weight-bold mb-0">📝 Daftar Pengunjung Tamu</h3>
            <div>
                <a href="{{ route('create_guest') }}" class="btn btn-success shadow-sm mr-2">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                </a>
                <a href="{{ route('cetak_guest', [
                    'tanggal' => request('tanggal'),
                    'start_date' => request('start_date'),
                    'end_date' => request('end_date'),
                ]) }}"
                    class="btn btn-primary shadow-sm">
                    <i class="fas fa-print mr-1"></i> Cetak Data
                </a>
            </div>
        </div>

        {{-- Filter Per tanggal --}}
        <form action="{{ route('show_guest') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">
                    <i class="fas fa-filter"></i> Filter
                </button>
                <a href="{{ route('show_guest') }}" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </a>
            </div>
        </form>


        {{-- Tabel Data --}}
        <div class="card shadow rounded-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Asal / Alamat</th>
                                <th>Jabatan</th>
                                <th>Pesan / Kesan</th>
                                <th>Tanda Tangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guests as $guest)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $guest->tanggal }}</td>
                                    <td>{{ $guest->nama }}</td>
                                    <td>{{ $guest->alamat }}</td>
                                    <td class="text-center">{{ $guest->jabatan }}</td>
                                    <td>{{ $guest->pesan }}</td>
                                    <td class="text-center">
                                        @if ($guest->tanda_tangan)
                                            <img src="{{ url('storage/' . $guest->tanda_tangan) }}"
                                                class="img-thumbnail rounded" style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_guest', $guest) }}" class="btn btn-sm btn-info shadow-sm"
                                            title="Edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('delete_guest', $guest) }}" method="post" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($guests->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Tidak ada data tamu.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
