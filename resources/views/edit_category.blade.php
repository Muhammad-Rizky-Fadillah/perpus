@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Perbaru Data Kategori') }}</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    <form action="{{ route('update_category', $category) }}" method="post">
                        @method('patch')
                        @csrf
                        
                        <div class="form-group">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" value="{{ old('nama_kategori', $category->nama_kategori) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Submit Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
