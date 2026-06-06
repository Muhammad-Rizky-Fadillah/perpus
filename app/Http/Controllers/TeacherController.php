<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;

class TeacherController extends Controller
{
    //
    public function create_teacher()
    {
        return view("create_teacher");
    }

    public function store_teacher(Request $request)
    {


        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'tujuan' => 'required',
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

        Teacher::create([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tujuan' => $request->tujuan,
            'tanda_tangan' => $path
        ]);

        return Redirect::route('show_teacher');
    }

    public function show_teacher(Request $request)
    {
        $query = Teacher::query();

        // Filter berdasarkan tanggal start dan end
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $teachers = $query->get();

        return view('show_teacher', compact('teachers'));
    }


    public function edit_teacher(Teacher $teacher)
    {
        return view('edit_teacher', compact('teacher'));
    }

    public function update_teacher(Teacher $teacher, Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'tanda_tangan' => 'nullable|string'
        ]);

        $path = $teacher->tanda_tangan; // default ke tanda tangan lama jika tidak diupdate

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
            if ($teacher->tanda_tangan && Storage::disk('public')->exists($teacher->tanda_tangan)) {
                Storage::disk('public')->delete($teacher->tanda_tangan);
            }
        }

        // Update data teacher
        $teacher->update([
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tujuan' => $request->tujuan,
            'tanda_tangan' => $path
        ]);

        return Redirect::route('show_teacher', $teacher)->with('success', 'Data guru berhasil diperbarui.');
    }


    public function delete_teacher(Teacher $teacher)
    {
        $teacher->delete();
        return Redirect::route('show_teacher');
    }

    public function cetak_teacher(Request $request)
    {
        $query = Teacher::query();

        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $teachers = $query->get();

        $pdf = Pdf::loadView('cetak_teacher', compact('teachers'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('Daftar-Guru.pdf');
    }
}
