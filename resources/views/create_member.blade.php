@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                    <h4 class="m-0 font-weight-bold text-primary">Pendaftaran Anggota Baru</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    <form action="{{ route('store_member') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Kode Anggota</label>
                            <input type="text" name="kode" class="form-control" value="{{ $kode }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Anggota:</label>
                            <input type="file" name="foto" class="form-control-file">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tahun Ajaran</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->tahun_ajaran ?? '-' }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat"
                                value="{{ old('alamat') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="tel" name="telepon" class="form-control" placeholder="Masukkan telepon"
                                value="{{ old('telepon') }}" required>
                        </div>

                        {{-- Status default Tidak Aktif diset di controller, tidak perlu input di blade --}}




                        <div class="form-group">
                            <label>Tanggal Expire</label>
                            <input type="date" class="form-control" value="{{ $expire }}" readonly>
                            <input type="hidden" name="expire" value="{{ $expire }}">
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('show_member') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
