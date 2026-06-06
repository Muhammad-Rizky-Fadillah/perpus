@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Header dan Tombol Tambah & Cetak --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary fw-bold mb-0">👨‍🏫 Daftar Pengunjung Guru</h3>
            <div>
                <a href="{{ route('create_teacher') }}" class="btn btn-success shadow-sm me-2">
                    <i class="fas fa-plus me-1"></i> Tambah Data
                </a>
                <a href="{{ route('cetak_teacher', request()->all()) }}" target="_blank" class="btn btn-primary shadow-sm">
                    <i class="fas fa-print me-1"></i> Cetak Data
                </a>

            </div>
        </div>

        {{-- Filter --}}
        <form action="{{ route('show_teacher') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <a href="{{ route('show_teacher') }}" class="btn btn-secondary">
                    <i class="fas fa-redo me-1"></i> Reset
                </a>
            </div>
        </form>


        {{-- Tabel Guru --}}
        <div class="card shadow rounded-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle" id="dataTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Tujuan</th>
                                <th>Tanda Tangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($teachers as $key => $teacher)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $teacher->nama }}</td>
                                    <td class="text-center">{{ $teacher->jabatan }}</td>
                                    <td class="text-center">{{ $teacher->tujuan }}</td>
                                    <td class="text-center">
                                        @if ($teacher->tanda_tangan)
                                            <img src="{{ asset('storage/' . $teacher->tanda_tangan) }}" alt="Tanda Tangan"
                                                class="img-thumbnail" style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_teacher', $teacher) }}"
                                            class="btn btn-sm btn-info shadow-sm me-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete_teacher', $teacher) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Tidak ada data guru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
