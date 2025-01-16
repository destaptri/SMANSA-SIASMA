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
                        <img src="{{ $biodata->foto_pribadi ? asset('storage/' . $biodata->foto_pribadi) : Vite::asset('public/images/default_avatar.png') }}"
                            class="img-fluid mb-3"
                            alt="Foto Alumni"
                            id="profile-image">
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
                                    <th>Pilihan Pertama</th>
                                    <td class="editable">{{ $biodata->pilihan_pertama }}</td>
                                </tr>
                                <tr>
                                    <th>Pilihan Kedua</th>
                                    <td class="editable">{{ $biodata->pilihan_kedua }}</td>
                                </tr>
                                <tr>
                                    <th>Skor UTBK</th>
                                    <td class="editable">{{ $biodata->skor_utbk }}</td>
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
                        <div class="d-flex justify-content-end mt-4">
                            <form action="{{ route('validasi.update', $biodata->id) }}" method="POST" class="d-flex flex-row gap-2">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editBiodataModal" style="background-color: #083579;">
                                    Edit Biodata
                                </button>
                                <button type="submit" name="status" value="valid" class="btn btn-success">
                                    Validasi
                                </button>
                                <button type="submit" name="status" value="tidak_valid" class="btn btn-danger">
                                    Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Edit Biodata Modal -->
<div class="modal fade" id="editBiodataModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Biodata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.biodata.update', ['id' => $biodata->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('POST')
                <div class="modal-body">
                    <!-- Foto Profile Section -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ $biodata->foto_pribadi ? asset('storage/' . $biodata->foto_pribadi) : Vite::asset('public/images/default_avatar.png') }}"
                                class="rounded me-2"
                                alt="Preview"
                                id="preview-image"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <label class="form-label mb-0">Foto Profil</label>
                                <input type="file" name="foto_pribadi" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Data Pribadi -->
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label small mb-1">NISN</label>
                                <input type="text" name="nisn" class="form-control form-control-sm" value="{{ $biodata->nisn }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control form-control-sm" value="{{ $biodata->nama_lengkap }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Kelas</label>
                                <input type="text" name="kelas" class="form-control form-control-sm" value="{{ $biodata->kelas }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="form-control form-control-sm" value="{{ $biodata->tahun_lulus }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Status Pekerjaan</label>
                                <input type="text" name="status_bekerja" class="form-control form-control-sm" value="{{ $biodata->status_bekerja }}">
                            </div>
                        </div>

                        <!-- Data Pendidikan -->
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label small mb-1">Universitas</label>
                                <input type="text" name="universitas" class="form-control form-control-sm" value="{{ $biodata->universitas }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Fakultas</label>
                                <input type="text" name="fakultas" class="form-control form-control-sm" value="{{ $biodata->fakultas }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control form-control-sm" value="{{ $biodata->jurusan }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Jalur Penerimaan</label>
                                <input type="text" name="jalur_penerimaan" class="form-control form-control-sm" value="{{ $biodata->jalur_penerimaan }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Pilihan Pertama</label>
                                <input type="text" name="pilihan_pertama" class="form-control form-control-sm" value="{{ $biodata->pilihan_pertama }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Pilihan Kedua</label>
                                <input type="text" name="pilihan_pertama" class="form-control form-control-sm" value="{{ $biodata->pilihan_kedua }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Skor UTBK</label>
                                <input type="text" name="pilihan_pertama" class="form-control form-control-sm" value="{{ $biodata->skor_utbk }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Tahun Diterima</label>
                                <input type="number" name="tahun_diterima" class="form-control form-control-sm" value="{{ $biodata->tahun_diterima }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-primary" style="background-color:#28A745; border-color:#28A745">Simpan Pengajuan</button>
                </div>
            </form>
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