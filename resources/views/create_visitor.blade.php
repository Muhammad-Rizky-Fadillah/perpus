@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Input Data Pengunjung Siswa</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Input Pengunjung Siswa</h6>
                    </div>
                    <div class="card-body">
                        <form id="signature-form" action="{{ route('store_visitor') }}" method="POST"
                            enctype="multipart/form-data">
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
                                <label for="nama">Nama :</label>
                                <input type="text" name="nama" class="form-control form-control-user" required
                                    placeholder="Masukkan nama siswa" value="{{ old('nama', Auth::user()->name) }} "
                                    readonly>
                            </div>

                            <div class="form-group">
                                <label for="nis">NIS :</label>
                                <input type="text" name="nis" class="form-control form-control-user" required
                                    value="{{ old('nis', Auth::user()->nis) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="tahun_ajaran">Tahun Ajaran :</label>
                                <input type="text" name="tahun_ajaran" class="form-control form-control-user" required
                                    value="{{ old('tahun_ajaran', Auth::user()->tahun_ajaran) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="tujuan">Tujuan Pengunjung :</label>
                                <select id="tujuan" name="tujuan" class="form-control form-control-user" required>
                                    <option value="" disabled selected>Pilih Tujuan</option>
                                    <option value="Membaca" {{ old('tujuan') == 'Membaca' ? 'selected' : '' }}>Membaca
                                    </option>
                                    <option value="Mengerjakan Tugas"
                                        {{ old('tujuan') == 'Mengerjakan Tugas' ? 'selected' : '' }}>Mengerjakan Tugas
                                    </option>
                                    <option value="Meminjam Buku" {{ old('tujuan') == 'Meminjam Buku' ? 'selected' : '' }}>
                                        Meminjam Buku</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tanda Tangan :</label>
                                <input type="hidden" id="signature-data" name="tanda_tangan">
                                <div>
                                    <canvas id="signature-pad" class="signature-pad"
                                        style="border: 2px solid #000;"></canvas>
                                </div>
                                <button type="button" id="clear-button" class="btn btn-secondary mt-2">Clear</button>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary btn-user">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('show_visitor') }}" class="btn btn-danger btn-user">
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

            form.addEventListener('submit', function(e) {
                if (signaturePad.isEmpty()) {
                    alert('Tanda tangan harus diisi.');
                    e.preventDefault();
                } else {
                    var dataURL = signaturePad.toDataURL();
                    document.getElementById('signature-data').value = dataURL;
                }
            });

            document.getElementById('clear-button').addEventListener('click', function() {
                signaturePad.clear();
            });
        });
    </script>
@endsection
