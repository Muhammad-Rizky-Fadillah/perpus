@extends('layouts.app')

@section('content')
    <div class="container py-4">

        {{-- Header dan Tombol Cetak --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary fw-bold mb-0">
                <i class="fas fa-book-reader"></i> Daftar Peminjaman
            </h4>
            <a href="{{ route('cetak_borrower', [
                'start_date' => request('start_date'),
                'end_date' => request('end_date'),
            ]) }}"
                target="_blank" class="btn btn-success shadow-sm">
                <i class="fas fa-print me-1"></i> Cetak Data
            </a>

        </div>

        {{-- Filter --}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('index_borrower') }}" method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">Tanggal Pinjam Mulai</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ request('start_date') }}">
                    </div>

                    <div class="col-md-3">
                        <label for="end_date" class="form-label">Tanggal Pinjam Selesai</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ request('end_date') }}">
                    </div>

                    <div class="col-md-3 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('index_borrower') }}" class="btn btn-secondary">
                            <i class="fas fa-redo me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>



        {{-- Table --}}
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="dataTable">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>NIS</th>
                            <th>Tahun Ajaran</th>
                            <th>Email</th>
                            <th>Buku Dipinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Denda</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotalDenda = 0; @endphp
                        @forelse ($borrowers as $borrower)
                            @php
                                $today = \Carbon\Carbon::today();
                                $tglKembali = \Carbon\Carbon::parse($borrower->tgl_kembali);
                                $terlambat = $today->greaterThan($tglKembali) ? $today->diffInDays($tglKembali) : 0;
                                $dendaPerHari = 1000;
                                $totalDenda = $terlambat * $dendaPerHari;
                                $grandTotalDenda += $totalDenda;
                            @endphp
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $borrower->user->name ?? 'User tidak ditemukan' }}</td>
                                <td class="text-center">{{ $borrower->user->nis ?? '-' }}</td>
                                <td class="text-center">{{ $borrower->user->tahun_ajaran ?? '-' }}</td>
                                <td>{{ $borrower->user->email ?? '-' }}</td>
                                <td>
                                    @if ($borrower->books->isNotEmpty())
                                        <ul class="mb-0 ps-3">
                                            @foreach ($borrower->books as $book)
                                                <li>{{ $book->judul }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <em>- Tidak ada data buku -</em>
                                    @endif
                                </td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($borrower->tgl_pinjam)->format('d-m-Y') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($borrower->tgl_kembali)->format('d-m-Y') }}</td>
                                <td class="text-center text-white">
                                    @if ($borrower->is_confirm)
                                        <span class="badge bg-success">Disetujui</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($totalDenda > 0)
                                        <span class="text-danger">Rp{{ number_format($totalDenda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-success">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="text-center text-white">
                                    @if ($borrower->is_confirm && !$borrower->tgl_kembali_confirm)
                                        <form action="{{ route('borrowers.return', $borrower->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-undo"></i> Konfirmasi Pengembalian
                                            </button>
                                        </form>
                                    @elseif($borrower->tgl_kembali_confirm)
                                        <span class="badge bg-secondary">
                                            Dikembalikan <br>
                                            {{ \Carbon\Carbon::parse($borrower->tgl_kembali_confirm)->format('d-m-Y') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Menunggu Persetujuan</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">
                                    <i class="fas fa-info-circle me-1"></i> Belum ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="9" class="text-end">Total Denda Keseluruhan:</th>
                            <th colspan="2" class="text-danger text-center">
                                Rp{{ number_format($grandTotalDenda, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection
