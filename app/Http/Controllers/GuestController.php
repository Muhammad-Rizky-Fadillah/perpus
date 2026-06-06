<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Models\Guest;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    public function create_guest()
    {
        return view("create_guest");
    }

    public function store_guest(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'pesan' => 'required',
            'tanda_tangan' => 'required'
        ]);
        // Ambil data base64 dari request
        $tanda_tangan = $request->input('tanda_tangan');

        // Pisahkan tipe data dan base64, ambil bagian base64
        list($type, $data) = explode(';', $tanda_tangan);
        list(, $data) = explode(',', $data);

        // Dekode base64 ke binary data
        $data = base64_decode($data);


        // Tentukan nama file dan path simpan
        $fileName = uniqid() . '.png';
        $path = 'signatures/' . $fileName;

        // Simpan file di storage Laravel
        Storage::disk('public')->put($path, $data);

        guest::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'pesan' => $request->pesan,
            'tanda_tangan' => $path
        ]);

        return Redirect::route('show_guest');
    }

public function show_guest(Request $request)
{
    $query = Guest::query();

    // Filter berdasarkan rentang tanggal jika ada
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    $guests = $query->get();

    return view('show_guest', compact('guests'));
}


    public function edit_guest(Guest $guest)
    {
        return view('edit_guest', compact('guest'));
    }

    public function update_guest(Guest $guest, Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'pesan' => 'required|string|max:1000',
            'tanda_tangan' => 'nullable|string'
        ]);

        $path = $guest->tanda_tangan; // default ke tanda tangan lama jika tidak diupdate

        $tanda_tangan = $request->input('tanda_tangan');

        if ($tanda_tangan) {
            // Pisahkan tipe data dan base64, ambil bagian base64
            list($type, $data) = explode(';', $tanda_tangan);
            list(, $data) = explode(',', $data);

            // Dekode base64 ke binary data
            $data = base64_decode($data);

            // Tentukan nama file dan path simpan
            $fileName = uniqid() . '.png';
            $path = 'signatures/' . $fileName;

            // Simpan file di storage Laravel
            Storage::disk('public')->put($path, $data);

            // Hapus file lama jika ada
            if ($guest->tanda_tangan && Storage::disk('public')->exists($guest->tanda_tangan)) {
                Storage::disk('public')->delete($guest->tanda_tangan);
            }
        }

        // Update data guest
        $guest->update([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'pesan' => $request->pesan,
            'tanda_tangan' => $path
        ]);

        return Redirect::route('show_guest', $guest)->with('success', 'Data tamu berhasil diperbarui.');
    }


    public function delete_guest(guest $guest)
    {
        $guest->delete();
        return Redirect::route('show_guest');
    }

   public function cetak_guest(Request $request)
{
    $query = Guest::query();

    // Filter berdasarkan rentang tanggal jika ada
    if ($request->start_date && $request->end_date) {
        $query->whereBetween('tanggal', [$request->start_date, $request->end_date]);
    }

    $guests = $query->get();

    $pdf = Pdf::loadView('cetak_guest', compact('guests'))
        ->setPaper('A4', 'landscape');

    // Nama file bisa disesuaikan dengan tanggal filter
    $fileName = 'Pengunjung-Tamu';
    if ($request->start_date && $request->end_date) {
        $fileName .= '-' . $request->start_date . '_sampai_' . $request->end_date;
    }
    $fileName .= '.pdf';

    return $pdf->stream($fileName);
}

}
