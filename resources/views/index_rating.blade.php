@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center mb-4 fw-bold text-primary">Data Rating Buku</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('cetak_rating') }}" class="btn btn-info" target="_blank">
            <i class="fas fa-print"></i> Cetak PDF
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Buku</th>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Review</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ratings as $rating)
                            <tr>
                                <td>{{ $rating->book->judul ?? '-' }}</td>
                                <td>{{ $rating->user->name ?? '-' }}</td>
                                <td class="text-center">
                                    {{ $rating->rating }} ⭐
                                </td>
                                <td>{{ $rating->review ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('edit_rating', $rating->id) }}" method="GET" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>

                                        <form action="{{ route('delete_rating', $rating->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus rating ini?')" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data rating</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
