<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\PengajuanBiodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    /**
     * Tampilkan biodata pengguna.
     */
    public function show()
    {
        $userId = Auth::id();

        // Ambil data dari tabel biodata berdasarkan user yang login
        $biodata = Biodata::where('user_id', $userId)->first();

        // Jika biodata belum ada, buat biodata baru sementara berdasarkan data user
        if (!$biodata) {
            $user = Auth::user();
            $biodata = new Biodata([
                'user_id' => $userId,
                'nisn' => $user->nisn, // NISN dari tabel users
                'nama_lengkap' => $user->name, // Nama dari tabel users
            ]);
        }

        return view('biodata.biodata', compact('biodata'));
    }

    /**
     * Proses pengajuan perubahan biodata.
     */
    public function update(Request $request)
    {
        // Validasi input dari form
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

        // Cek apakah ada biodata yang sudah ada
        $biodata = Biodata::where('user_id', $userId)->first();

        if ($biodata) {
            // Update biodata yang sudah ada
            $biodata->update($validated);
        } else {
            // Jika biodata tidak ada, buat biodata baru
            $biodata = Biodata::create(array_merge($validated, ['user_id' => $userId]));
        }

       // Jika ada foto yang di-upload
       if ($request->hasFile('foto_pribadi')) {
        // Mengambil file foto yang di-upload
        $file = $request->file('foto_pribadi');
        $fileName = $file->store('biodata_foto', 'public');  // Menyimpan foto di folder storage/app/public/biodata_foto

        // Hapus foto lama jika ada
        if ($biodata->foto_pribadi) {
            Storage::disk('public')->delete($biodata->foto_pribadi);
        }

        // Menyimpan path foto baru di database
        $biodata->foto_pribadi = $fileName;
    }

        // Simpan pengajuan perubahan biodata
        PengajuanBiodata::create([
            'user_id' => $userId,
            'nisn' => $biodata->nisn,
            'nama_lengkap' => $biodata->nama_lengkap,
            'kelas' => $biodata->kelas,
            'tahun_lulus' => $biodata->tahun_lulus,
            'universitas' => $biodata->universitas,
            'fakultas' => $biodata->fakultas,
            'jurusan' => $biodata->jurusan,
            'jalur_penerimaan' => $biodata->jalur_penerimaan,
            'tahun_diterima' => $biodata->tahun_diterima,
            'status_bekerja' => $biodata->status_bekerja,
            'foto_pribadi' => $biodata->foto_pribadi,
            'status_validasi' => 'tidak',
            'tanggal_pengajuan' => now(),
        ]);

        return redirect()->route('alumni.biodata')->with('success', 'Pengajuan perubahan biodata berhasil diajukan.');
    }
}
