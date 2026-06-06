@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <h2 class="text-center mb-4 text-primary">Formulir Peminjaman Buku</h2>
        <p class="text-muted text-center">Silakan pilih buku yang ingin dipinjam. Maksimal peminjaman mengikuti kebijakan
            perpustakaan.</p>

        <!-- Alert Success & Error -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card Form -->
        <div class="card shadow-sm border-primary">
            <div class="card-body">

                <form id="borrowForm" action="{{ route('store_borrower') }}" method="POST">
                    @csrf

                    <!-- Tanggal Pinjam & Kembali -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tgl_pinjam" class="form-label">Tanggal Pinjam:</label>
                            <input type="date" id="tgl_pinjam" name="tgl_pinjam" required class="form-control"
                                value="{{ old('tgl_pinjam', date('Y-m-d')) }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="tgl_kembali_preview" class="form-label">Tanggal Kembali (Estimasi):</label>
                            <input type="date" id="tgl_kembali_preview" readonly class="form-control">
                        </div>
                    </div>

                    <!-- Kolom Pencarian -->
                    <div class="mb-3">
                        <label for="searchBook" class="form-label">Cari Buku:</label>
                        <input type="text" id="searchBook" class="form-control"
                            placeholder="Ketik judul atau pengarang...">
                    </div>
                    <!-- Tombol Submit -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <span id="submitText"><i class="bi bi-send"></i> Ajukan Peminjaman</span>
                            <span id="submitSpinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                        </button>
                    </div>


                    <!-- Katalog Buku -->
                    <div id="bookContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-3">
                        @foreach ($books as $book)
                            <div class="col">
                                <div class="card h-100 shadow-sm border-primary book-card">
                                    @if ($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="Cover {{ $book->judul }}"
                                            class="card-img-top" style="height: 200px; object-fit: contain; padding: 10px;">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title text-primary">{{ $book->judul }}</h5>
                                        <p class="card-text mb-1"><strong>Kategori:</strong>
                                            {{ $book->category->nama_kategori ?? 'Tanpa Kategori' }}</p>
                                        <p class="card-text mb-1"><strong>Pengarang:</strong> {{ $book->pengarang }}</p>
                                        <p class="card-text mb-2">
                                            <strong>Stok:</strong>
                                            @if ($book->stock > 0)
                                                {{ $book->stock }}
                                            @else
                                                <span class="badge bg-danger">Habis</span>
                                            @endif
                                        </p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="book_ids[]"
                                                value="{{ $book->id }}" id="book{{ $book->id }}"
                                                {{ $book->stock == 0 ? 'disabled' : '' }}
                                                {{ in_array($book->id, $selectedBookIds ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="book{{ $book->id }}">
                                                Pilih Buku
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>



                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .book-card:hover {
            transform: scale(1.02);
            transition: 0.3s;
            cursor: pointer;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Tanggal kembali otomatis +7 hari
        const tglPinjamInput = document.getElementById('tgl_pinjam');
        const tglKembaliPreview = document.getElementById('tgl_kembali_preview');

        function updateTanggalKembali() {
            const pinjamValue = tglPinjamInput.value;
            if (!pinjamValue) {
                tglKembaliPreview.value = '';
                return;
            }

            const pinjamDate = new Date(pinjamValue);
            if (isNaN(pinjamDate.getTime())) {
                tglKembaliPreview.value = '';
                return;
            }

            pinjamDate.setDate(pinjamDate.getDate() + 7);

            const yyyy = pinjamDate.getFullYear();
            const mm = ('0' + (pinjamDate.getMonth() + 1)).slice(-2);
            const dd = ('0' + pinjamDate.getDate()).slice(-2);

            tglKembaliPreview.value = `${yyyy}-${mm}-${dd}`;
        }

        tglPinjamInput.addEventListener('change', updateTanggalKembali);
        window.addEventListener('load', updateTanggalKembali);

        // Pencarian live
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchBook');
            const container = document.getElementById('bookContainer');
            const cards = Array.from(container.querySelectorAll('.book-card')).map(card => card.parentElement);

            searchInput.addEventListener('input', function() {
                const keyword = searchInput.value.toLowerCase().trim();
                const matched = [];
                const unmatched = [];

                cards.forEach(col => {
                    const card = col.querySelector('.book-card');
                    const content = card.textContent.toLowerCase();
                    if (content.includes(keyword)) {
                        matched.push(col);
                    } else {
                        unmatched.push(col);
                    }
                });

                container.innerHTML = '';
                matched.forEach(col => {
                    col.style.display = 'block';
                    container.appendChild(col);
                });
                unmatched.forEach(col => {
                    col.style.display = keyword ? 'none' : 'block';
                    container.appendChild(col);
                });
            });
        });

        // Spinner saat submit
        document.getElementById('borrowForm').addEventListener('submit', function() {
            document.getElementById('submitText').classList.add('d-none');
            document.getElementById('submitSpinner').classList.remove('d-none');
        });

        // Scroll ke buku terpilih saat load
        window.addEventListener('load', function() {
            const selected = document.querySelector('.form-check-input:checked');
            if (selected) {
                selected.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }
        });
    </script>
@endsection
