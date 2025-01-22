<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AlumniExport;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:laporan-show|laporan-export', ['only' => ['index']]);
        $this->middleware('permission:laporan-export', ['only' => ['export']]);
    }

    public function index(Request $request)
    {
        $query = Biodata::query();
        
        // Get selected columns or use defaults
        $defaultColumns = ['nisn', 'nama_lengkap', 'tahun_lulus', 'universitas', 'jurusan'];
        $selectedColumns = $request->get('columns', $defaultColumns);
        
        // Remove NISN and nama_lengkap if they exist in the array
        $selectedColumns = array_diff($selectedColumns, ['nisn', 'nama_lengkap']);
        
        // Add NISN and nama_lengkap at the beginning
        array_unshift($selectedColumns, 'nama_lengkap');
        array_unshift($selectedColumns, 'nisn');
        
        // Limit to 6 columns maximum (including NISN and nama_lengkap)
        $selectedColumns = array_slice($selectedColumns, 0, 6);

        // Handle Search based on selected columns only
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm, $selectedColumns) {
                // First iteration flag to handle proper OR conditions
                $firstWhere = true;

                foreach ($selectedColumns as $column) {
                    if ($firstWhere) {
                        $q->where($column, 'LIKE', "%{$searchTerm}%");
                        $firstWhere = false;
                    } else {
                        $q->orWhere($column, 'LIKE', "%{$searchTerm}%");
                    }
                }
            });
        }

        // Get selected columns or use defaults
        $defaultColumns = ['nisn', 'nama_lengkap', 'tahun_lulus', 'universitas', 'jurusan'];
        $selectedColumns = $request->get('columns', $defaultColumns);
        
        // Remove NISN and nama_lengkap if they exist in the array
        $selectedColumns = array_diff($selectedColumns, ['nisn', 'nama_lengkap']);
        
        // Add NISN and nama_lengkap at the beginning
        array_unshift($selectedColumns, 'nama_lengkap');
        array_unshift($selectedColumns, 'nisn');
        
        // Limit to 6 columns maximum (including NISN and nama_lengkap)
        $selectedColumns = array_slice($selectedColumns, 0, 6);

        // Get paginated results
        $alumni = $query->select($selectedColumns)
                       ->paginate(15)
                       ->appends($request->query());

        // Get all available columns for the dropdown (excluding NISN and nama_lengkap)
        $availableColumns = [
            'tahun_lulus' => 'Tahun Lulus',
            'universitas' => 'Universitas',
            'jurusan' => 'Jurusan',
            'jalur_penerimaan' => 'Jalur Penerimaan',
            'pilihan_pertama' => 'Pilihan Pertama',
            'pilihan_kedua' => 'Pilihan Kedua',
            'skor_utbk' => 'Skor UTBK',
            'tahun_diterima' => 'Tahun Diterima'
        ];

        $allColumns = [
            'nisn' => 'NISN',
            'nama_lengkap' => 'Nama Lengkap',
        ] + $availableColumns;

        return view('admin.laporan', compact('alumni', 'availableColumns', 'selectedColumns', 'allColumns'));
    }

    public function export(Request $request)
    {
        $selectedColumns = $request->get('columns', [
            'nisn', 'nama_lengkap', 'tahun_lulus', 'universitas', 'jurusan'
        ]);

        // Ensure NISN and nama_lengkap are at the beginning
        $selectedColumns = array_diff($selectedColumns, ['nisn', 'nama_lengkap']);
        array_unshift($selectedColumns, 'nama_lengkap');
        array_unshift($selectedColumns, 'nisn');

        return Excel::download(new AlumniExport($selectedColumns, $request->search), 'data-alumni.xlsx');
    }
}