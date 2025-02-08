@extends('layouts.alumni')

@section('content')
<div class="biodata">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Biodata Alumni</li>
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
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 25%;">NISN</th>
                                    <td>{{ $biodata->nisn }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $biodata->nama_lengkap }}</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>{{ $biodata->kelas }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td>{{ $biodata->tahun_lulus }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas</th>
                                    <td>{{ $biodata->universitas }}</td>
                                </tr>
                                <tr>
                                    <th>Fakultas</th>
                                    <td>{{ $biodata->fakultas }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>{{ $biodata->jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>Jalur Penerimaan</th>
                                    <td>{{ $biodata->jalur_penerimaan }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas Pilihan Pertama</th>
                                    <td>{{ $biodata->pilihan_pertama }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas Pilihan Kedua</th>
                                    <td>{{ $biodata->pilihan_kedua }}</td>
                                </tr>
                                <tr>
                                    <th>Skor UTBK</th>
                                    <td>{{ $biodata->skor_utbk }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Diterima</th>
                                    <td>{{ $biodata->tahun_diterima }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pekerjaan</th>
                                    <td>{{ $biodata->status_bekerja }}</td>
                                </tr>
                                <tr>
                                    <th>Status Validasi</th>
                                    <td>{{ $biodata->status_validasi }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center justify-content-lg-end mt-4">
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#historyModal" style="background-color: #0D6EFD; border-color: #0D6EFD; color:white; margin-right:5px;">
                                Riwayat Pengajuan
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editBiodataModal" style="background-color: #083579; border-color:#083579">
                                Edit Biodata
                            </button>

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
            <form method="POST" action="{{ route('alumni.biodata.update', ['id' => $biodata->id]) }}" enctype="multipart/form-data">
                @csrf
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
                            <div class="mb-2">
                                <label class="form-label small mb-1">Universitas</label>
                                <input type="text" name="universitas" class="form-control form-control-sm" value="{{ $biodata->universitas }}" placeholder="Contoh: Universitas Diponegoro">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Fakultas</label>
                                <input type="text" name="fakultas" class="form-control form-control-sm" value="{{ $biodata->fakultas }}" placeholder="Contoh: FKIP">
                            </div>
                        </div>

                        <!-- Data Pendidikan -->
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label class="form-label small mb-1">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control form-control-sm" value="{{ $biodata->jurusan }}" placeholder="Contoh: Pendidikan Biologi">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Jalur Penerimaan</label>
                                <input type="text" name="jalur_penerimaan" class="form-control form-control-sm" value="{{ $biodata->jalur_penerimaan }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Universitas Pilihan Pertama</label>
                                <input type="text" name="pilihan_pertama" class="form-control form-control-sm" value="{{ $biodata->pilihan_pertama }}" placeholder="Contoh: Universitas Diponegoro">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Universitas Pilihan Kedua</label>
                                <input type="text" name="pilihan_kedua" class="form-control form-control-sm" value="{{ $biodata->pilihan_kedua }}" placeholder="Contoh: Universitas Negeri Semarang">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1">Skor UTBK</label>
                                <input type="text" name="skor_utbk" class="form-control form-control-sm" value="{{ $biodata->skor_utbk }}" placeholder="Contoh: 543.6">
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

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Riwayat Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-2">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 40px">No</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuan_biodata ?? [] as $index => $pengajuan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $pengajuan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($pengajuan->status_validasi == 'Menunggu')
                                <span class="badge bg-warning">Menunggu</span>
                                @elseif($pengajuan->status_validasi == 'Disetujui')
                                <span class="badge bg-success">Disetujui</span>
                                @else
                                <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer py-1">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
    window.onload = function() {
        <?php if (session('flash_success')): ?>
            Swal.fire({
                html: `
                <h2 style="margin-top:20px; margin-bottom: 15px; font-size:16px; font-family: 'Inter', sans-serif; color:#062A61;font-weight:bold;">Berhasil disimpan!</h2>
                <img src='{{ Vite::asset("public/images/new_releases.png") }}' width="100" height="100" style="display: block; margin: 5px auto;">
                <p style="margin: 15px 20px; font-size: 16px; font-family: 'Inter', sans-serif; color:#062A61; font-weight:bold;">Menunggu Proses Validasi</p>`,
                imageAlt: 'Success Icon',
                showCloseButton: true,
                showConfirmButton: false,
                width: 'auto',
                customClass: {
                    closeButton: 'custom-close-btn' // Tambahkan class custom
                }
            });
        <?php endif; ?>
    };
</script>
@endsection