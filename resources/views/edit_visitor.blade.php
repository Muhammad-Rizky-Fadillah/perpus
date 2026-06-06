@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Perbarui Data Kunjungan Siswa') }}</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('update_visitor', $visitor) }}" method="post" enctype="multipart/form-data"
                            id="signature-form">
                            @method('patch')
                            @csrf

                            {{-- Nama --}}
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ old('nama', $visitor->nama) }}" required readonly>
                            </div>

                            {{-- tahun_ajaran --}}
                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" name="tahun_ajaran" id="tahun_ajaran" class="form-control"
                                    value="{{ old('tahun_ajaran', $visitor->tahun_ajaran) }}" required readonly>
                            </div>

                            {{-- Tujuan --}}
                            <div class="form-group">
                                <label for="tujuan">Tujuan Pengunjung</label>
                                <select id="tujuan" name="tujuan" class="form-control" required>
                                    <option value="">-- Pilih Tujuan --</option>
                                    @php
                                        $tujuanOptions = ['Membaca', 'Mengerjakan Tugas', 'Meminjam Buku'];
                                    @endphp
                                    @foreach ($tujuanOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ old('tujuan', $visitor->tujuan) == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tanda Tangan --}}
                            <div class="form-group">
                                {{-- Tampilkan tanda tangan lama --}}
                                @if ($visitor->tanda_tangan)
                                    <div class="mt-2">
                                        <p>Tanda tangan lama:</p>
                                        <img src="{{ asset('storage/' . $visitor->tanda_tangan) }}" alt="Tanda Tangan Lama"
                                            style="max-width: 300px;">
                                    </div>
                                @endif
                                <label>Tanda Tangan</label>
                                <div>
                                    <canvas id="signature-pad" class="signature-pad" style="border: 2px solid"></canvas>
                                </div>
                                <input type="hidden" name="tanda_tangan" id="signature-data">
                                <button type="button" id="clear-button" class="btn btn-secondary mt-2">Clear</button>


                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit Data</button>
                            <a href="{{ route('show_visitor') }}" class="btn btn-danger mt-3">Kembali</a>
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
            @if ($visitor->tanda_tangan)
                var oldSignatureUrl = "{{ asset('storage/' . $visitor->tanda_tangan) }}";
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
