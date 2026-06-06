@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Verifikasi Anggota</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Anggota</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->kode }}</td>
                    <td>{{ $member->user->name ?? '-' }}</td>
                    <td>{{ $member->tempat_lahir }}</td>
                    <td>{{ $member->tanggal_lahir }}</td>
                    <td>{{ $member->alamat }}</td>
                    <td>{{ $member->telepon }}</td>
                    <td>
                        <form action="{{ route('member.verifikasi.store', $member->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">Tidak ada anggota yang menunggu verifikasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
