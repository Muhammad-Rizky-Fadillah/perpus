<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    // Menampilkan list backup
    public function index()
    {
        // Ambil semua file backup dari folder storage/app/backups
        $backups = Storage::files('backups');

        // Urutkan dari terbaru
        $backups = collect($backups)->sortDesc();

        return view('backup.index', compact('backups'));
    }

    // Menjalankan backup
    public function run()
    {
        try {
            // Nama file backup dengan timestamp
            $fileName = 'backup-' . now()->format('Y-m-d_H-i-s') . '.sql';
            $filePath = storage_path('app/backups/' . $fileName);

            // Jalankan command mysqldump via artisan
            $dbConnection = config('database.default');
            $dbHost = config("database.connections.$dbConnection.host");
            $dbPort = config("database.connections.$dbConnection.port");
            $dbDatabase = config("database.connections.$dbConnection.database");
            $dbUsername = config("database.connections.$dbConnection.username");
            $dbPassword = config("database.connections.$dbConnection.password");

            // Pastikan folder backup ada
            if (!Storage::exists('backups')) {
                Storage::makeDirectory('backups');
            }

            // Command backup database (untuk MySQL)
            $command = "mysqldump --user={$dbUsername} --password={$dbPassword} --host={$dbHost} --port={$dbPort} {$dbDatabase} > {$filePath}";
            exec($command);

            return redirect()->back()->with('success', 'Backup berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Backup gagal: ' . $e->getMessage());
        }
    }

    // Download backup
    public function download($file)
    {
        $filePath = 'backups/' . $file;

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    // Hapus backup
    public function destroy($file)
    {
        $filePath = 'backups/' . $file;

        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return redirect()->back()->with('success', 'Backup berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
