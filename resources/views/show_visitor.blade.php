@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary font-weight-bold mb-0">📚 Daftar Pengunjung Siswa</h3>


            <form method="GET" action="{{ route('cetak_visitor') }}" class="d-inline">
                <input type="hidden" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}">
                <button type="submit" class="btn btn-info shadow-sm">
                    <i class="fas fa-print mr-1"></i> Cetak Data
                </button>
            </form>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <form method="GET" action="{{ route('show_visitor') }}" class="form-inline">
                <div class="form-group mr-2">
                    <label for="tahun_ajaran" class="mr-2">Filter Tahun Ajaran:</label>
                    <select name="tahun_ajaran" id="tahun_ajaran" class="form-control">
                        <option value="">-- Semua Tahun Ajaran --</option>
                        @foreach ($tahunAjaranList as $ta)
                            <option value="{{ $ta }}" {{ request('tahun_ajaran') == $ta ? 'selected' : '' }}>
                                {{ $ta }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
            </form>
        </div>

        <div class="card shadow rounded-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tahun Ajaran</th>
                                <th>Tujuan</th>
                                <th>Tanda Tangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitors as $key => $visitor)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $visitor->nama }}</td>
                                    <td class="text-center">{{ $visitor->tahun_ajaran }}</td>
                                    <td class="text-center">{{ $visitor->tujuan }}</td>
                                    <td class="text-center">
                                        @if ($visitor->tanda_tangan)
                                            <img src="{{ asset('storage/' . $visitor->tanda_tangan) }}" alt="Tanda Tangan"
                                                class="img-thumbnail" style="max-width: 100px;">
                                        @else
                                            <span class="text-muted">Belum Ada</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_visitor', $visitor) }}"
                                            class="btn btn-sm btn-info shadow-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delete_visitor', $visitor) }}" method="post"
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
                            @if ($visitors->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Tidak ada data pengunjung.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
