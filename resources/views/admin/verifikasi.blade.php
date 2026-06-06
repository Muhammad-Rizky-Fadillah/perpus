@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Verifikasi User Baru</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tahun Ajaran</th>
                <th>NIS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->tahun_ajaran }}</td>
                    <td>{{ $user->nis }}</td>
                    <td>
                        <form action="{{ route('user.verifikasi.store', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada user menunggu verifikasi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
