<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBiodata;
use App\Models\ValidasiBiodata;
use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:validasi-show|validasi-validate|validasi-update', ['only' => ['index', 'show']]);
        $this->middleware('permission:validasi-validate', ['only' => ['update']]);
        $this->middleware('permission:validasi-update', ['only' => ['updateBiodata']]);
    }
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pengajuan = PengajuanBiodata::where('status_validasi', 'Menunggu')
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                        ->orWhere('tahun_lulus', 'LIKE', "%{$search}%")
                        ->orWhere('universitas', 'LIKE', "%{$search}%")
                        ->orWhere('jurusan', 'LIKE', "%{$search}%")
                        ->orWhere('jalur_penerimaan', 'LIKE', "%{$search}%");
                });
            })
            ->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.partials.table-body', compact('pengajuan'))->render(),
                'pagination' => view('admin.partials.pagination', compact('pengajuan'))->render()
            ]);
        }

        return view('admin.validasi', compact('pengajuan'));
    }

    public function show($id)
    {
        $biodata = PengajuanBiodata::findOrFail($id);
        return view('admin.detail-data', compact('biodata'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanBiodata::findOrFail($id);

            if ($request->status === 'valid') {
                // Update status pengajuan
                $pengajuan->status_validasi = 'Disetujui';
                $pengajuan->save();

                // Insert ke tabel biodata
                Biodata::updateOrCreate(
                    ['user_id' => $pengajuan->user_id], // mencari berdasarkan user_id
                    [
                        'nisn' => $pengajuan->nisn,
                        'nama_lengkap' => $pengajuan->nama_lengkap,
                        'kelas' => $pengajuan->kelas,
                        'tahun_lulus' => $pengajuan->tahun_lulus,
                        'universitas' => $pengajuan->universitas,
                        'fakultas' => $pengajuan->fakultas,
                        'jurusan' => $pengajuan->jurusan,
                        'jalur_penerimaan' => $pengajuan->jalur_penerimaan,
                        'pilihan_pertama' => $pengajuan->pilihan_pertama,
                        'pilihan_kedua' => $pengajuan->pilihan_kedua,
                        'skor_utbk' => $pengajuan->skor_utbk,
                        'tahun_diterima' => $pengajuan->tahun_diterima,
                        'status_bekerja' => $pengajuan->status_bekerja,
                        'foto_pribadi' => $pengajuan->foto_pribadi,
                        'status_validasi' => 'Disetujui'
                    ]
                );
            } else if ($request->status === 'tidak_valid') {
                $pengajuan->status_validasi = 'Ditolak';
                $pengajuan->save();
            }

            // tabel validasi_biodata
            ValidasiBiodata::create([
                'biodata_id' => $pengajuan->id,
                'verifikator' => Auth::id(), // ID admin yang sedang login
                'status' => $pengajuan->status_validasi,
                'tanggal_verifikasi' => now()
            ]);

            DB::commit();

            return redirect()->route('antrian-validasi')
                ->with('success', 'Data berhasil divalidasi');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memvalidasi data: ' . $e->getMessage());
        }
    }

    public function updateBiodata(Request $request, $id)
    {
        $request->validate([
            'nisn' => 'required',
            'nama_lengkap' => 'required',
            'kelas' => 'required',
            'tahun_lulus' => 'required|numeric',
            'status_bekerja' => 'required',
            'universitas' => 'required',
            'fakultas' => 'required',
            'jurusan' => 'required',
            'jalur_penerimaan' => 'required',
            'pilihan_pertama' => 'required',
            'pilihan_kedua' => 'required',
            'skor_utbk' => 'required|numeric',
            'tahun_diterima' => 'required|numeric',
            'foto_pribadi' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $biodata = PengajuanBiodata::findOrFail($id);

        // Handle foto upload jika ada
        if ($request->hasFile('foto_pribadi')) {
            if ($biodata->foto_pribadi) {
                Storage::delete($biodata->foto_pribadi);
            }
            $path = $request->file('foto_pribadi')->store('public/foto_pribadi');
            $biodata->foto_pribadi = str_replace('public/', '', $path);
        }

        // Update data lainnya
        $biodata->update([
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'tahun_lulus' => $request->tahun_lulus,
            'status_bekerja' => $request->status_bekerja,
            'universitas' => $request->universitas,
            'fakultas' => $request->fakultas,
            'jurusan' => $request->jurusan,
            'jalur_penerimaan' => $request->jalur_penerimaan,
            'pilihan_pertama' => $request->pilihan_pertama,
            'pilihan_kedua' => $request->pilihan_kedua,
            'skor_utbk' => $request->skor_utbk,
            'tahun_diterima' => $request->tahun_diterima
        ]);

        return redirect()->back()->with('success', 'Biodata berhasil diperbarui');
    }
}
