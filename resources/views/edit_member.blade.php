@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h4 class="m-0 font-weight-bold text-primary">Edit Data Anggota</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('update_member', $member) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label>Kode Anggota</label>
                        <input type="text" name="kode" class="form-control" value="{{ $member->kode }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="foto">Foto Anggota Saat Ini:</label><br>
                        @if ($member->foto)
                            <img src="{{ Storage::url($member->foto) }}" alt="Foto Anggota" style="max-width: 150px;" class="mb-2">
                        @else
                            <p class="text-muted">Belum ada foto.</p>
                        @endif
                        <input type="file" name="foto" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $member->tempat_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $member->tanggal_lahir) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $member->alamat) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $member->telepon) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Aktif" {{ old('status', $member->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ old('status', $member->status) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Tanggal Expire</label>
                        <input type="date" name="expire" class="form-control" value="{{ old('expire', $member->expire) }}" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                        <a href="{{ route('show_member') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
