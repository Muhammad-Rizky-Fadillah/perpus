<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use carbon\carbon;
use App\Models\User;
use App\Notifications\NewMemberRegistered;

class MemberController extends Controller
{
    public function create_member()
    {
        if (Member::where('user_id', Auth::id())->exists()) {
            return redirect()->route('home')->with('error', 'Anda sudah terdaftar sebagai anggota.');
        }
        // Ambil user yang sedang login
        $user = auth()->user();

        // Ambil tahun ajaran dari user dan hitung expire 3 tahun setelah tahun ajaran
        $startYear = (int) explode('/', $user->tahun_ajaran)[0];
        $expire = Carbon::create($startYear + 3, 6, 30)->format('Y-m-d'); // 30 Juni tahun ke-3

        // Generate kode anggota otomatis
        $last = Member::orderBy('id', 'desc')->first();
        $number = $last ? (int) substr($last->kode, -4) + 1 : 1;
        $kode = 'AG' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // Kirim semua variabel ke view
        return view('create_member', compact('kode', 'user', 'expire'));
    }



    public function store_member(Request $request)
    {
        if (Member::where('user_id', Auth::id())->exists()) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar sebagai anggota.');
        }

        $request->validate([
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('member', 'public');
        }

        // Generate kode anggota otomatis
        $last = Member::orderBy('id', 'desc')->first();
        $number = $last ? (int) substr($last->kode, -4) + 1 : 1;
        $kode = 'AG' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // Ambil tahun ajaran dari user
        $tahunAjaran = Auth::user()->tahun_ajaran; // misal "2024/2025"
        $startYear = (int) explode('/', $tahunAjaran)[0];

        // Set status default dan expire 3 tahun setelah tahun ajaran
        $status = 'Tidak Aktif';
        $expire = Carbon::create($startYear + 3, 6, 30)->format('Y-m-d'); // ambil 30 Juni tahun ke-3

        $member = Member::create([
            'user_id' => Auth::id(),
            'foto' => $fotoPath,
            'kode' => $kode,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'status' => $status,
            'expire' => $expire,
        ]);

        // Kirim notifikasi ke admin
        $admins = User::where('is_admin', true)->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewMemberRegistered($member));
        }

        return redirect()->back()->with('success', 'Pendaftaran Anggota berhasil ditambahkan.');
    }

    public function show_member(Request $request)
    {
        $query = Member::with('user');

        // Filter berdasarkan tahun_ajaran jika ada
        if ($request->tahun_ajaran) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('tahun_ajaran', $request->tahun_ajaran);
            });
        }

        $members = $query->get();

        // Update status jika tanggal expire sudah lewat
        foreach ($members as $member) {
            if (Carbon::parse($member->expire)->lt(Carbon::today()) && $member->status === 'Aktif') {
                $member->status = 'Tidak Aktif';
                $member->save();
            }
        }

        return view('show_member', compact('members'));
    }


    public function edit_member(Member $member)
    {
        return view('edit_member', compact('member'));
    }

    public function update_member(Request $request, Member $member)
    {
        $request->validate([
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'status' => 'required',
            'expire' => 'required|date',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($member->foto && Storage::disk('public')->exists($member->foto)) {
                Storage::disk('public')->delete($member->foto);
            }
            $member->foto = $request->file('foto')->store('member', 'public');
        }

        $member->tempat_lahir = $request->tempat_lahir;
        $member->tanggal_lahir = $request->tanggal_lahir;
        $member->alamat = $request->alamat;
        $member->telepon = $request->telepon;
        $member->status = $request->status;
        $member->expire = $request->expire;

        $member->save();

        return Redirect::route('show_member')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function delete_member(Member $member)
    {
        if ($member->foto && Storage::disk('public')->exists($member->foto)) {
            Storage::disk('public')->delete($member->foto);
        }
        $member->delete();
        return Redirect::route('show_member')->with('success', 'Data anggota berhasil dihapus.');
    }

    public function cetak_member(Request $request)
    {
        // Ambil filter tahun ajaran dari request
        $tahunAjaran = $request->input('tahun_ajaran');

        // Query anggota dengan relasi user
        $members = Member::with('user')
            ->when($tahunAjaran, function ($query) use ($tahunAjaran) {
                $query->whereHas('user', function ($q) use ($tahunAjaran) {
                    $q->where('tahun_ajaran', $tahunAjaran);
                });
            })
            ->get();

        $pdf = Pdf::loadView('cetak_member', compact('members'))
            ->setPaper('A4', 'landscape');

        // Nama file PDF bisa tambahkan tahun ajaran jika difilter
        $fileName = 'Anggota';
        if ($tahunAjaran) {
            $fileName .= '-' . str_replace('/', '-', $tahunAjaran);
        }
        $fileName .= '.pdf';

        return $pdf->stream($fileName);
    }


    public function printCard($id)
    {
        $member = Member::with('user')->find($id);

        if (!$member) {
            return response()->json(['message' => 'Anggota tidak ditemukan'], 404);
        }
        $pdf = Pdf::loadView('member_card', compact('member'));

        $pdf->setPaper([0, 0, 236.400, 155.079], 'portrait'); // width, height dalam pt

        return $pdf->stream('kartu-anggota-' . $member->kode . '.pdf');
    }

    public function verifikasiIndex()
    {
        $members = Member::where('status', 'Tidak Aktif')->get();
        return view('admin.verifikasi_member', compact('members'));
    }

    public function verifikasiStore($id)
    {
        $member = Member::findOrFail($id);
        $member->status = 'Aktif';
        $member->save();

        return back()->with('success', 'Anggota berhasil diverifikasi dan diaktifkan.');
    }
}
