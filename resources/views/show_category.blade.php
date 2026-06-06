@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Header dan Tombol Aksi (Hanya untuk Admin) --}}
    @if (Auth::user()->is_admin)
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary font-weight-bold mb-0">📚 Daftar Kategori</h3>
        <a href="{{ route('create_category') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Data
        </a>
    </div>
    @else
    <h3 class="text-primary font-weight-bold mb-4">📚 Daftar Kategori</h3>
    @endif

    {{-- Tabel Data --}}
    <div class="card shadow rounded-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="dataTable" width="100%">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Nama Kategori</th>
                            @if (Auth::user()->is_admin)
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr class="align-middle">
                            <td>{{ $category->nama_kategori }}</td>
                            @if (Auth::user()->is_admin)
                            <td class="text-center">
                                <a href="{{ route('edit_category', $category) }}" class="btn btn-sm btn-info shadow-sm mb-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('delete_category', $category) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @if($categories->isEmpty())
                        <tr>
                            <td colspan="{{ Auth::user()->is_admin ? '2' : '1' }}" class="text-center text-muted">Tidak ada data kategori.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
