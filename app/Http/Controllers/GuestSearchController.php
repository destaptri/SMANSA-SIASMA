<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Biodata;

class GuestSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $alumni = Biodata::query()
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                      ->orWhere('tahun_lulus', 'LIKE', "%{$search}%")
                      ->orWhere('universitas', 'LIKE', "%{$search}%")
                      ->orWhere('jurusan', 'LIKE', "%{$search}%")
                      ->orWhere('jalur_penerimaan', 'LIKE', "%{$search}%");
                });
            })
            ->where('status_validasi', 'Disetujui')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('guest.hasil-pencarian', compact('alumni'));
    }

    public function show($id)
    {
        $alumni = Biodata::findOrFail($id);
        return view('guest.detail-alumni', compact('alumni'));
    }
}
