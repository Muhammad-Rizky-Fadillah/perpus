@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm mb-4">
            <div
                class="card-header d-flex flex-column flex-md-row justify-content-between align-items-center bg-primary text-white">
                <h4 class="mb-3 mb-md-0">
                    <i class="fas fa-clipboard-list me-2"></i> Riwayat Stok Opname Perpustakaan
                </h4>
                <a href="{{ route('cetak_opname', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                    target="_blank" class="btn btn-success">
                    Cetak PDF
                </a>
            </div>

            <div class="card-body">

                {{-- Filter per tanggal --}}
                <form action="{{ route('index_opname') }}" method="GET" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" class="form-control"
                            value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('index_opname') }}" class="btn btn-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </a>
                    </div>
                </form>

                {{-- Alert Success --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Table --}}
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0" id="dataTable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Stok Fisik</th>
                                <th>Selisih</th>
                                <th>Petugas</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($opnames as $index => $opname)
                                @php
                                    $stokSistem = $opname->book->stock ?? 0;
                                    $selisih = $opname->actual_stock - $stokSistem;
                                    $progress =
                                        $stokSistem > 0 ? min(100, ($opname->actual_stock / $stokSistem) * 100) : 0;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $opname->book->judul }}</strong>
                                        <br>
                                        <small class="text-muted"><i class="fas fa-box"></i> Rak:
                                            {{ $opname->book->rak_buku ?? 'Tidak ada' }}</small>
                                    </td>
                                    <td class="text-center text-white">
                                        <span class="badge bg-primary">
                                            <i class="fas fa-box-open"></i> {{ $opname->actual_stock }}
                                        </span>
                                        <div class="progress mt-1" style="height: 5px; width: 80%; margin: 0 auto;">
                                            <div class="progress-bar 
                                            @if ($selisih > 0) bg-success
                                            @elseif($selisih < 0) bg-danger
                                            @else bg-secondary @endif"
                                                role="progressbar" style="width: {{ $progress }}%;"></div>
                                        </div>
                                        <small class="text-muted">{{ round($progress) }}% cocok</small>
                                    </td>
                                    <td class="text-center text-white">
                                        @if ($selisih > 0)
                                            <span class="badge bg-success">
                                                <i class="fas fa-arrow-up"></i> +{{ $selisih }}
                                            </span>
                                        @elseif($selisih < 0)
                                            <span class="badge bg-danger">
                                                <i class="fas fa-arrow-down"></i> {{ $selisih }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-check"></i> Sama
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <i class="fas fa-user"></i> {{ $opname->user->name }}
                                    </td>
                                    <td class="text-center">
                                        <i class="fas fa-calendar-alt"></i> {{ $opname->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-info-circle me-1"></i> Belum ada data opname.
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
