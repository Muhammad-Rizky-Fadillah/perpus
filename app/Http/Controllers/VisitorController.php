<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class VisitorController extends Controller
{
    public function create_visitor()
    {
        return view("create_visitor");
    }

    public function store_visitor(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun_ajaran' => 'required',
            'tujuan' => 'required',
            'tanda_tangan' => 'required|string',
        ]);

        $path = $this->saveSignature($request->tanda_tangan);

        Visitor::create([
            'nama' => $request->nama,
            'tahun_ajaran' => $request->tahun_ajaran,
            'tujuan' => $request->tujuan,
            'tanda_tangan' => $path,
        ]);

        return back()->with('success', 'Data pengunjung berhasil disimpan.');
    }

    public function show_visitor(Request $request)
    {
        $visitorsQuery = Visitor::query();

        // Filter berdasarkan tahun ajaran jika ada
        if ($request->has('tahun_ajaran') && $request->tahun_ajaran != '') {
            $visitorsQuery->where('tahun_ajaran', $request->tahun_ajaran);
        }

        $visitors = $visitorsQuery->latest()->get();

        // Ambil daftar tahun ajaran unik untuk dropdown
        $tahunAjaranList = Visitor::select('tahun_ajaran')->distinct()->pluck('tahun_ajaran');

        return view('show_visitor', compact('visitors', 'tahunAjaranList'));
    }


    public function edit_visitor(Visitor $visitor)
    {
        return view('edit_visitor', compact('visitor'));
    }

    public function update_visitor(Visitor $visitor, Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:50',
            'tujuan' => 'required|string|max:255',
            'tanda_tangan' => 'nullable|string'
        ]);

        $path = $visitor->tanda_tangan; // default ke tanda tangan lama jika tidak diupdate

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
            if ($visitor->tanda_tangan && Storage::disk('public')->exists($visitor->tanda_tangan)) {
                Storage::disk('public')->delete($visitor->tanda_tangan);
            }
        }

        // Update data visitor
        $visitor->update([
            'nama' => $request->nama,
            'tahun_ajaran' => $request->tahun_ajaran,
            'tujuan' => $request->tujuan,
            'tanda_tangan' => $path
        ]);

        return Redirect::route('show_visitor', $visitor)->with('success', 'Data visitor berhasil diperbarui.');
    }


    public function delete_visitor(Visitor $visitor)
    {
        // Hapus file tanda tangan jika ada
        if ($visitor->tanda_tangan && Storage::disk('public')->exists($visitor->tanda_tangan)) {
            Storage::disk('public')->delete($visitor->tanda_tangan);
        }

        $visitor->delete();

        return Redirect::route('show_visitor')->with('success', 'Data pengunjung berhasil dihapus.');
    }

    public function cetak_visitor(Request $request)
    {
        // Ambil filter tahun ajaran dari request
        $tahunAjaran = $request->input('tahun_ajaran');

        // Query pengunjung
        $visitors = Visitor::when($tahunAjaran, function ($query) use ($tahunAjaran) {
            $query->where('tahun_ajaran', $tahunAjaran);
        })->get();

        // Generate PDF
        $pdf = Pdf::loadView('cetak_visitor', compact('visitors'))
            ->setPaper('A4', 'portrait');

        // Nama file PDF bisa tambahkan tahun ajaran jika difilter
        $fileName = 'Pengunjung-Siswa';
        if ($tahunAjaran) {
            $fileName .= '-' . str_replace('/', '-', $tahunAjaran);
        }
        $fileName .= '.pdf';

        return $pdf->stream($fileName);
    }


    /**
     * Menyimpan tanda tangan base64 ke storage/public/signatures
     * dan mengembalikan path relative untuk disimpan di database.
     */
    private function saveSignature($base64Signature)
    {
        if (strpos($base64Signature, 'data:image') !== 0) {
            return null;
        }

        list($type, $data) = explode(';', $base64Signature);
        list(, $data) = explode(',', $data);
        $data = base64_decode($data);

        $folder = 'signatures';
        $fileName = 'ttd_' . uniqid() . '.png';
        $path = $folder . '/' . $fileName;

        // Pastikan folder ada
        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        Storage::disk('public')->put($path, $data);

        return $path;
    }
}
