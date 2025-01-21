<?php

namespace App\Exports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AlumniExport implements FromQuery, WithHeadings, WithMapping
{
    protected $columns;
    protected $searchTerm;

    public function __construct($columns, $searchTerm = null)
    {
        $this->columns = $columns;
        $this->searchTerm = $searchTerm;
    }

    public function query()
    {
        $query = Biodata::query()->select($this->columns);
        
        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('nisn', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('nama_lengkap', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('universitas', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('jurusan', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('tahun_lulus', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('jalur_penerimaan', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('pilihan_pertama', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('pilihan_kedua', 'LIKE', "%{$this->searchTerm}%")
                  ->orWhere('tahun_diterima', 'LIKE', "%{$this->searchTerm}%");
            });
        }

        return $query;
    }

    public function headings(): array
    {
        $headers = [];
        foreach ($this->columns as $column) {
            $headers[] = ucwords(str_replace('_', ' ', $column));
        }
        return $headers;
    }

    public function map($row): array
    {
        $data = [];
        foreach ($this->columns as $column) {
            $data[] = $row->{$column};
        }
        return $data;
    }
}