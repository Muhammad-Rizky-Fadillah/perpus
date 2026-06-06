@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Input Data Pengunjung Guru</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Input Pengunjung Guru</h6>
                    </div>
                    <div class="card-body">
                        <form id="signature-form" action="{{ route('store_teacher') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" class="form-control form-control-user" placeholder="Masukkan nama lengkap" required value="{{ old('nama') }}">
                            </div>

                            <div class="form-group">
                                <label for="jabatan">Jabatan:</label>
                                <input type="text" name="jabatan" class="form-control form-control-user" placeholder="Masukkan jabatan" required value="{{ old('jabatan') }}">
                            </div>

                            <div class="form-group">
                                <label for="tujuan">Tujuan:</label>
                                <input type="text" name="tujuan" class="form-control form-control-user" placeholder="Masukkan tujuan" required value="{{ old('tujuan') }}">
                            </div>
                            
                            <div class="form-group">
                                <label>Tanda Tangan:</label>
                                <input type="hidden" name="tanda_tangan" id="signature-data">
                                <div>
                                    <canvas id="signature-pad" class="signature-pad" style="border: 2px solid #000;"></canvas>
                                </div>
                                <button type="button" id="clear-button" class="btn btn-secondary mt-2">Clear</button>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-user">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('show_teacher') }}" class="btn btn-danger btn-user">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    var form = document.getElementById('signature-form');

    form.addEventListener('submit', function (e) {
        if (signaturePad.isEmpty()) {
            alert('Tanda tangan harus diisi.');
            e.preventDefault();
        } else {
            var dataURL = signaturePad.toDataURL();
            document.getElementById('signature-data').value = dataURL;
        }
    });

    document.getElementById('clear-button').addEventListener('click', function () {
        signaturePad.clear();
    });
});
</script>
@endsection

