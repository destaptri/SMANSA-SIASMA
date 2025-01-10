@extends('layouts.sidebar') 
@section('content')
<div class="biodata">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('antrian-validasi') }}">Validasi Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Data Alumni</li>
        </ol>
    </nav>

    <div class="container-biodata col-lg-12">
        <div class="row justify-content-center col-lg-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="text-lg-start text-center">Biodata Alumni</h3>

                <div class="row">
                    <!-- Foto Profil -->
                    <div class="col-lg-3 col-md-12 text-center">
                        <img src="{{ asset('storage/' . $biodata->foto) }}" class="img-fluid mb-3" alt="Foto Alumni" id="profile-image">
                    </div>

                    <!-- Tabel Biodata Alumni -->
                    <div class="col-lg-9 col-md-12">
                        <table class="table table-bordered" id="biodata-table">
                            <tbody>
                                <tr>
                                    <th>NISN</th>
                                    <td class="editable">{{ $biodata->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td class="editable">{{ $biodata->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td class="editable">{{ $biodata->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td class="editable">{{ $biodata->tahun_lulus }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pekerjaan</th>
                                    <td class="editable">{{ $biodata->status_bekerja }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas</th>
                                    <td class="editable">{{ $biodata->universitas }}</td>
                                </tr>
                                <tr>
                                    <th>Fakultas</th>
                                    <td class="editable">{{ $biodata->fakultas }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td class="editable">{{ $biodata->jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>Jalur Penerimaan</th>
                                    <td class="editable">{{ $biodata->jalur_penerimaan }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Diterima</th>
                                    <td class="editable">{{ $biodata->tahun_diterima }}</td>
                                </tr>
                                <tr>
                                    <th>Status Validasi</th>
                                    <td class="editable">{{ $biodata->status_validasi }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Tombol Validasi -->
                        <div class="d-flex justify-content-center justify-content-lg-end mt-4">
                            <form action="{{ route('validasi.update', $biodata->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="valid" class="btn btn-success me-2">Validasi</button>
                                <button type="submit" name="status" value="tidak_valid" class="btn btn-danger me-2">Tidak Valid</button>
                            </form>
                            <a href="{{ route('antrian-validasi') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection