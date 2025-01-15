<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\PengajuanBiodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $biodata = Biodata::where('user_id', $userId)->first();
        
        if (!$biodata) {
            $user = Auth::user();
            $biodata = new Biodata([
                'user_id' => $userId,
                'nisn' => $user->nisn,
                'nama_lengkap' => $user->name,
            ]);
        }

        // Get pengajuan history
        $pengajuan_biodata = PengajuanBiodata::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('biodata.biodata', compact('biodata', 'pengajuan_biodata'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:10',
            'tahun_lulus' => 'nullable|digits:4',
            'universitas' => 'nullable|string|max:255',
            'fakultas' => 'nullable|string|max:255',
            'jurusan' => 'nullable|string|max:255',
            'jalur_penerimaan' => 'nullable|string|max:255',
            'tahun_diterima' => 'nullable|digits:4',
            'status_bekerja' => 'nullable|string|max:255',
            'foto_pribadi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userId = Auth::id();
        
        $fotoPath = null;
        if ($request->hasFile('foto_pribadi')) {
            $fotoPath = $request->file('foto_pribadi')->store('biodata_foto', 'public');
        }

         PengajuanBiodata::create([
            'user_id' => $userId,
            'nisn' => $validated['nisn'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'kelas' => $validated['kelas'],
            'tahun_lulus' => $validated['tahun_lulus'],
            'universitas' => $validated['universitas'],
            'fakultas' => $validated['fakultas'],
            'jurusan' => $validated['jurusan'],
            'jalur_penerimaan' => $validated['jalur_penerimaan'],
            'tahun_diterima' => $validated['tahun_diterima'],
            'status_bekerja' => $validated['status_bekerja'],
            'foto_pribadi' => $fotoPath,
        ]);

        return redirect()->route('alumni.biodata')
            ->with('success', 'Pengajuan perubahan biodata berhasil diajukan dan menunggu validasi.');
    }
}