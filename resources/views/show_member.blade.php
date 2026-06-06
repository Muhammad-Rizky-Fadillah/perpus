@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-primary font-weight-bold mb-0">📖 Daftar Anggota Perpustakaan</h3>
            <div>
                <form method="GET" action="{{ route('cetak_member') }}" class="d-inline">
                    <input type="hidden" name="tahun_ajaran" value="{{ request('tahun_ajaran') }}">
                    <button type="submit" class="btn btn-info shadow-sm">
                        <i class="fas fa-print mr-1"></i> Cetak Data
                    </button>
                </form>

            </div>
        </div>

        {{-- Filter Tahun Ajaran --}}
        <div class="mb-3">
            <form method="GET" action="{{ route('show_member') }}" class="form-inline">
                <label for="tahun_ajaran" class="mr-2">Filter Tahun Ajaran:</label>
                <select name="tahun_ajaran" id="tahun_ajaran" class="form-control mr-2">
                    <option value="">-- Semua Tahun Ajaran --</option>
                    @foreach ($members->pluck('user.tahun_ajaran')->unique() as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun_ajaran') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <div class="card shadow rounded-lg">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="dataTable" width="100%">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th>Kode Anggota</th>
                                <th>Foto</th>
                                <th>Nama Lengkap</th>
                                <th>Tahun Ajaran</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Status</th>
                                <th>Expire</th>
                                <th>Kartu Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($members as $member)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $member->kode }}</td>
                                    <td class="text-center">
                                        @if ($member->foto)
                                            <img src="{{ asset('storage/' . $member->foto) }}" class="img-thumbnail rounded"
                                                style="max-width: 50px;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->user->name ?? '-' }}</td>
                                    <td class="text-center">{{ $member->user->tahun_ajaran ?? '-' }}</td>
                                    <td>{{ $member->tempat_lahir }}</td>
                                    <td class="text-center">{{ $member->tanggal_lahir }}</td>
                                    <td>{{ $member->alamat }}</td>
                                    <td class="text-center">{{ $member->telepon }}</td>
                                    <td class="text-center">
                                        @if ($member->status == 'Aktif')
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $member->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $member->expire }}</td>
                                    <td class="text-center">
                                        @if ($member->status == 'Aktif')
                                            <a href="{{ route('members.printCard', $member->id) }}"
                                                class="btn btn-sm btn-primary shadow-sm">
                                                <i class="fas fa-id-card"></i> Cetak Kartu
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('edit_member', $member) }}"
                                            class="btn btn-sm btn-info shadow-sm mb-1" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('delete_member', $member) }}" method="post"
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
                            @if ($members->isEmpty())
                                <tr>
                                    <td colspan="12" class="text-center text-muted">Tidak ada data anggota.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
