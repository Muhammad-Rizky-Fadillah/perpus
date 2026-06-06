@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">📦 Backup Database</h1>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Form Backup --}}
    <form id="backupForm" action="{{ route('backup.run') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-primary">Buat Backup Baru</button>
        <span id="loadingSpinner" style="display:none;">
            <svg class="spinner" width="20" height="20" viewBox="0 0 50 50">
                <circle cx="25" cy="25" r="20" stroke="#007bff" stroke-width="5" fill="none" stroke-linecap="round"/>
            </svg>
            Sedang membuat backup...
        </span>
    </form>

    {{-- List Backup --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>Ukuran</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($backups as $index => $backup)
                @php
                    $fileName = basename($backup);
                    $size = Storage::size($backup);
                    $lastModified = Storage::lastModified($backup);

                    if($size >= 1048576) {
                        $sizeFormatted = number_format($size / 1048576, 2) . ' MB';
                    } elseif($size >= 1024) {
                        $sizeFormatted = number_format($size / 1024, 2) . ' KB';
                    } else {
                        $sizeFormatted = $size . ' B';
                    }

                    $dateFormatted = date('d M Y H:i:s', $lastModified);
                @endphp
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $fileName }}</td>
                    <td>{{ $sizeFormatted }}</td>
                    <td>{{ $dateFormatted }}</td>
                    <td>
                        <a href="{{ route('backup.download', $fileName) }}" class="btn btn-success btn-sm">Download</a>
                        <form action="{{ route('backup.destroy', $fileName) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus backup ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada backup.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Spinner CSS --}}
<style>
.spinner {
    animation: spin 1s linear infinite;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

{{-- JavaScript untuk loading --}}
<script>
document.getElementById('backupForm').addEventListener('submit', function() {
    document.querySelector('#backupForm button[type="submit"]').disabled = true;
    document.getElementById('loadingSpinner').style.display = 'inline-block';
});
</script>
@endsection
