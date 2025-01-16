@extends('layouts.alumni')
@section('content')
<div class="biodata">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('hasil-pencarian') }}">Pencarian Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data Alumni</li>
        </ol>
    </nav>

    <div class="container-biodata col-lg-12">
        <div class="row justify-content-center col-lg-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="text-lg-start text-center">Data Alumni</h3>

                <div class="row">

                    <!-- Tabel Biodata Alumni -->
                    <div class="col-lg-12 col-md-12">
                        <table class="table table-bordered" id="biodata-table">
                            <tbody>
                                <tr>
                                    <th>NISN</th>
                                    <td class="editable">{{ $alumni->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td class="editable">{{ $alumni->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td class="editable">{{ $alumni->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td class="editable">{{ $alumni->tahun_lulus }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pekerjaan</th>
                                    <td class="editable">{{ $alumni->status_bekerja }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas</th>
                                    <td class="editable">{{ $alumni->universitas }}</td>
                                </tr>
                                <tr>
                                    <th>Fakultas</th>
                                    <td class="editable">{{ $alumni->fakultas }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td class="editable">{{ $alumni->jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>Jalur Penerimaan</th>
                                    <td class="editable">{{ $alumni->jalur_penerimaan }}</td>
                                </tr>
                                <tr>
                                    <th>Pilihan Pertama</th>
                                    <td class="editable">{{ $alumni->pilihan_pertama }}</td>
                                </tr>
                                <tr>
                                    <th>Pilihan Kedua</th>
                                    <td class="editable">{{ $alumni->pilihan_kedua }}</td>
                                </tr>
                                <tr>
                                    <th>Skor UTBK</th>
                                    <td class="editable">{{ $alumni->skor_utbk }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Diterima</th>
                                    <td class="editable">{{ $alumni->tahun_diterima }}</td>
                                </tr>
                                <tr>
                                    <th>Status Validasi</th>
                                    <td class="editable">{{ $alumni->status_validasi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection