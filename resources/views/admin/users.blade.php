@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4"><i class="fas fa-users"></i> Daftar User</h3>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Email</th>
                            <th>Tahun Ajaran</th>
                            <th>Role</th>
                            <th>Status Verifikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                 <td>{{ $user->nis }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->tahun_ajaran ?? '-' }}</td>
                                <td class="text-white">
                                    @if($user->is_admin)
                                        <span class="badge bg-success">Admin</span>
                                    @else
                                        <span class="badge bg-primary">Siswa</span>
                                    @endif
                                </td>
                                <td class="text-white">
                                    @if($user->is_verified)
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @else
                                        <span class="badge bg-danger">Belum Terverifikasi</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted ">Tidak ada user ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
