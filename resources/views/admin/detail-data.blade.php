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
                <h3 class="text-lg-start text-center">Data Alumni</h3>

                <div class="row">
                    <!-- Foto Profil -->
                    <div class="col-lg-3 col-md-12 text-center">
                        <img src="{{ $biodata->foto_pribadi ? asset('storage/' . $biodata->foto_pribadi) : Vite::asset('resources/images/default_avatar.png') }}"
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
                                    <th>Universitas Pilihan Pertama</th>
                                    <td class="editable">{{ $biodata->pilihan_pertama }}</td>
                                </tr>
                                <tr>
                                    <th>Universitas Pilihan Kedua</th>
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
                            <form action="{{ route('validasi.update', $biodata->id) }}" method="POST" class="d-flex flex-row gap-2" id="validasiForm">
                                @csrf
                                @method('PUT')
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editBiodataModal" style="background-color: #083579; border-color: #083579">
                                    Edit Biodata
                                </button>
                                <button type="submit" name="status" value="valid" class="btn btn-success" onclick="confirmAccept()">
                                    Validasi
                                </button>
                                <button type="button" class="btn btn-danger" onclick="confirmReject(event)">
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
                            <img src="{{ $biodata->foto_pribadi ? asset('storage/' . $biodata->foto_pribadi) : Vite::asset('resources/images/default_avatar.png') }}"
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
                                <label class="form-label small mb-1"> Universitas Pilihan Pertama</label>
                                <input type="text" name="pilihan_pertama" class="form-control form-control-sm" value="{{ $biodata->pilihan_pertama }}" placeholder="Contoh: Universitas Diponegoro">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small mb-1"> Universitas Pilihan Kedua</label>
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

    document.addEventListener('DOMContentLoaded', function() {
        <?php if (session('success')): ?>
            Swal.fire({
                html: `
                <h2 style="margin-top:20px; margin-bottom: 15px; font-size:16px; font-family: 'Inter', sans-serif; color:#062A61;font-weight:bold;">Data Tersimpan!</h2>
                <img src='{{ Vite::asset("resources/images/new_releases.png") }}' width="100" height="100" style="display: block; margin: 5px auto;">
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
    })

    // SweetAlert2 untuk Validasi
    function confirmAccept() {
        Swal.fire({
            html: `
                <h2 style="margin-top:20px; margin-bottom: 15px; font-size:16px; font-family: 'Inter', sans-serif; color:#062A61;font-weight:bold;">Berhasil!</h2>
                <img src='{{ Vite::asset("resources/images/new_releases.png") }}' width="100" height="100" style="display: block; margin: 5px auto;">
                <p style="margin: 15px 30px; font-size: 16px; font-family: 'Inter', sans-serif; color:#062A61; font-weight:bold;">Data Telah Validasi</p>`,
            imageAlt: 'Success Icon',
            showCloseButton: true,
            showConfirmButton: false,
            width: 'auto',
            customClass: {
                closeButton: 'custom-close-btn'
            }
        })
        .then(() => {
            document.forms[0].submit();
        });
    }

    // SweetAlert2 untuk Tolak
    function confirmReject(event) {
        Swal.fire({
            html: `
                <h2 style="margin:20px 30px; font-size:16px; font-family: 'Inter', sans-serif; color:#062A61;font-weight:bold;">Tolak Pengajuan Biodata?</h2>
                <img src='{{ Vite::asset("resources/images/release_alert.png") }}' width="100" height="100" style="display: block; margin: 5px auto;">`,
            imageAlt: 'Success Icon',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            confirmButtonColor:'#F21C30',
            width: 'auto',
            customClass: {
                closeButton: 'custom-close-btn',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('validasiForm');
                const statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                statusInput.value = 'tidak_valid';
                form.appendChild(statusInput);

                Swal.fire({
                    html: `
                <h2 style="margin-top:20px; margin-bottom: 15px; font-size:16px; font-family: 'Inter', sans-serif; color:#062A61;font-weight:bold;">Berhasil!</h2>
                <img src='{{ Vite::asset("resources/images/new_releases.png") }}' width="100" height="100" style="display: block; margin: 5px auto;">
                <p style="margin: 15px 30px; font-size: 16px; font-family: 'Inter', sans-serif; color:#062A61; font-weight:bold;">Data Telah Ditolak</p>`,
            imageAlt: 'Success Icon',
            showCloseButton: false,
            showConfirmButton: false,
            width: 'auto',
            timer:1000,
            customClass: {
                closeButton: 'custom-close-btn'
            }
                }).then(() => {
                    setTimeout(function() {
                        form.submit();
                    }, 1000);
                });
            } else {
                return false;
            }
        });
    }
</script>
@endsection