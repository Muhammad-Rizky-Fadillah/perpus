@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h4 class="mb-0">📚 Tambah Data Stok Opname</h4>
        </div>
        <div class="card-body">
            {{-- Alert Success --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('store_opname') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Stok Fisik</th>
                                <th scope="col">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $index => $book)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <strong>{{ $book->judul }}</strong>
                                        <input type="hidden" name="books[{{ $index }}][book_id]" value="{{ $book->id }}">
                                    </td>
                                    <td>
                                        <input type="number" name="books[{{ $index }}][actual_stock]" class="form-control" min="0" required placeholder="Masukkan stok fisik">
                                    </td>
                                    <td>
                                        <input type="text" name="books[{{ $index }}][note]" class="form-control" placeholder="Catatan jika ada">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4">
                        💾 Simpan Semua Opname
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
