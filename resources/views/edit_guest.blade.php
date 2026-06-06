@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Perbarui Data Pengunjung Tamu') }}</div>

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
                        <form id="signature-form" action="{{ route('update_guest', $guest) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $guest->tanggal) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $guest->nama) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Asal / Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $guest->alamat) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $guest->jabatan) }}" required>
                            </div>

                            <div class="form-group">
                                <label>Pesan / Kesan</label>
                                <input type="text" name="pesan" class="form-control" value="{{ old('pesan', $guest->pesan) }}" required>
                            </div>

                            <div class="form-group">
                                @if ($guest->tanda_tangan)
                                    <div class="mt-2">
                                        <p>Tanda tangan lama:</p>
                                        <img src="{{ asset('storage/' . $guest->tanda_tangan) }}" alt="Tanda Tangan Lama" style="max-width: 300px;">
                                    </div>
                                @endif
                                <label>Tanda Tangan</label>
                                <div>
                                    <canvas id="signature-pad" class="signature-pad" style="border: 2px solid #000;"></canvas>
                                </div>
                                <input type="hidden" name="tanda_tangan" id="signature-data">
                                <button type="button" id="clear-button" class="btn btn-secondary mt-2">Clear</button>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Tambahkan Script Signature Pad -->
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var canvas = document.getElementById('signature-pad');
            var signaturePad = new SignaturePad(canvas);

            // Load tanda tangan lama ke SignaturePad jika perlu
            @if ($guest->tanda_tangan)
                var oldSignatureUrl = "{{ asset('storage/' . $guest->tanda_tangan) }}";
                var img = new Image();
                img.onload = function() {
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                };
                img.src = oldSignatureUrl;
            @endif

            var form = document.getElementById('signature-form');

            form.addEventListener('submit', function(e) {
                if (!signaturePad.isEmpty()) {
                    var dataURL = signaturePad.toDataURL('image/png');
                    document.getElementById('signature-data').value = dataURL;
                }
            });

            document.getElementById('clear-button').addEventListener('click', function() {
                signaturePad.clear();
            });
        });
    </script>
@endsection
