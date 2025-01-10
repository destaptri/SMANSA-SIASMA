<?php

namespace App\Http\Controllers;

use App\Models\PengajuanBiodata;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{

public function index(Request $request)
{
    $search = $request->input('search');
    
    $pengajuan = PengajuanBiodata::where('status_validasi', 'menunggu')
        ->when($search, function($query) use ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('tahun_lulus', 'LIKE', "%{$search}%")
                  ->orWhere('universitas', 'LIKE', "%{$search}%")
                  ->orWhere('jurusan', 'LIKE', "%{$search}%");
            });
        })
        ->paginate(10);
        
    if($request->ajax()) {
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
    $biodata = PengajuanBiodata::findOrFail($id);
    $biodata->status_validasi = $request->status;
    $biodata->save();

    return redirect()->route('validasi')
        ->with('success', 'Status validasi berhasil diperbarui');
}

}