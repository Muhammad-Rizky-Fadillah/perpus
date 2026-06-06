@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Header action --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0 text-primary fw-bold">
                <i class="fas fa-book-dead"></i> Data Buku Rusak
            </h4>
            <div>
                <a href="{{ route('create_damaged') }}" class="btn btn-primary btn-sm shadow-sm me-2">
                    <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Laporan
                </a>
                <a href="{{ route('cetak_damaged', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    target="_blank" class="btn btn-info btn-sm shadow-sm">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>
        </div>

        {{-- Alert success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="GET" action="{{ route('index_damaged') }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <label for="start_date">Tanggal Awal</label>
                    <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}"
                        class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="end_date">Tanggal Akhir</label>
                    <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}"
                        class="form-control">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>

            </div>
        </form>
        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0" id="dataTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Judul Buku</th>
                                <th>Rak Buku</th>
                                <th>Jumlah Rusak</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $item->book->judul }}</td>
                                    <td class="text-center">{{ $item->book->rak_buku ?? '-' }}</td>
                                    <td class="text-center">{{ $item->jumlah }}</td>
                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_damaged', $item->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete_damaged', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle me-1"></i> Tidak ada data buku rusak.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
