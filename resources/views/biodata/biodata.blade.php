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
                    <!-- Foto Profil dan Ganti Foto -->
                    <div class="col-lg-3 col-md-12 text-center">
                        <img src="{{ $biodata->foto_pribadi ? asset('storage/' . $biodata->foto_pribadi) : Vite::asset('public/images/default_avatar.png') }}"
                             class="img-fluid mb-3" 
                             alt="Foto Alumni" 
                             id="profile-image">
                        <button class="btn btn-primary d-none" id="change-photo-btn">Ganti Foto</button>
                        <input type="file" name="foto_pribadi" class="form-control d-none" id="upload-photo">
                    </div>

                    <!-- Tabel Biodata Alumni -->
                    <div class="col-lg-9 col-md-12">
                        <form method="POST" action="{{ route('alumni.biodata.update') }}" enctype="multipart/form-data">
                            @csrf

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 25%;">NISN</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="nisn-text">{{ $biodata->nisn }}</span>
                                            <input type="text" name="nisn" class="form-control w-100 d-none" value="{{ old('nisn', $biodata->nisn) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Nama Lengkap</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="nama-lengkap-text">{{ $biodata->nama_lengkap }}</span>
                                            <input type="text" name="nama_lengkap" class="form-control w-100 d-none" value="{{ old('nama_lengkap', $biodata->nama_lengkap) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Kelas</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="kelas-text">{{ $biodata->kelas }}</span>
                                            <input type="text" name="kelas" class="form-control w-100 d-none" value="{{ old('kelas', $biodata->kelas) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Tahun Lulus</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="tahun-lulus-text">{{ $biodata->tahun_lulus }}</span>
                                            <input type="number" name="tahun_lulus" class="form-control w-100 d-none" value="{{ old('tahun_lulus', $biodata->tahun_lulus) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Universitas</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="universitas-text">{{ $biodata->universitas }}</span>
                                            <input type="text" name="universitas" class="form-control w-100 d-none" value="{{ old('universitas', $biodata->universitas) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Fakultas</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="fakultas-text">{{ $biodata->fakultas }}</span>
                                            <input type="text" name="fakultas" class="form-control w-100 d-none" value="{{ old('fakultas', $biodata->fakultas) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Jurusan</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="jurusan-text">{{ $biodata->jurusan }}</span>
                                            <input type="text" name="jurusan" class="form-control w-100 d-none" value="{{ old('jurusan', $biodata->jurusan) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Jalur Penerimaan</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="jalur-penerimaan-text">{{ $biodata->jalur_penerimaan }}</span>
                                            <input type="text" name="jalur_penerimaan" class="form-control w-100 d-none" value="{{ old('jalur_penerimaan', $biodata->jalur_penerimaan) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Tahun Diterima</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="tahun-diterima-text">{{ $biodata->tahun_diterima }}</span>
                                            <input type="number" name="tahun_diterima" class="form-control w-100 d-none" value="{{ old('tahun_diterima', $biodata->tahun_diterima) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%;">Status Pekerjaan</th>
                                        <td class="input-td" onclick="editField(this)">
                                            <span class="editable-text" id="status-pekerjaan-text">{{ $biodata->status_bekerja }}</span>
                                            <input type="text" name="status_bekerja" class="form-control w-100 d-none" value="{{ old('status_bekerja', $biodata->status_bekerja) }}" {{ $biodata->status_validasi != 'tidak' ? 'readonly' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Status Validasi</th>
                                        <td>
                                            <span class="editable-text">{{ $biodata->status_validasi }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center justify-content-lg-end mt-4">
                                <button type="button" class="btn btn-success me-2" id="edit-btn">Edit Biodata</button>
                                <button type="submit" class="btn btn-primary d-none" id="save-btn">Simpan</button>
                                <button type="button" class="btn btn-secondary d-none" id="cancel-btn">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('edit-btn');
    const saveBtn = document.getElementById('save-btn');
    const cancelBtn = document.getElementById('cancel-btn');
    const changePhotoBtn = document.getElementById('change-photo-btn');
    const uploadPhoto = document.getElementById('upload-photo');
    const profileImage = document.getElementById('profile-image');
    const inputs = document.querySelectorAll('.input-td input');
    const spans = document.querySelectorAll('.input-td .editable-text');

    // Simpan nilai awal input untuk mengembalikan ke default saat Batal ditekan
    const originalValues = {};
    inputs.forEach(input => {
        originalValues[input.name] = input.value;
    });

    // Fungsi Tombol Edit Biodata
    editBtn.addEventListener('click', function () {
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        changePhotoBtn.classList.remove('d-none');
        editBtn.classList.add('d-none');

        // Ubah tampilan teks menjadi input field
        spans.forEach(span => span.classList.add('d-none'));
        inputs.forEach(input => {
            input.classList.remove('d-none');
            input.removeAttribute('readonly'); // Pastikan input field bisa diedit
        });
    });

    // Fungsi Tombol Batal dengan Pop-up Konfirmasi
    cancelBtn.addEventListener('click', function () {
        // Tampilkan pop-up konfirmasi
        const confirmation = confirm("Anda yakin ingin membatalkan perubahan? Data yang belum disimpan akan hilang.");
        
        if (confirmation) {
            // Jika pengguna memilih "Ya", kembali ke tampilan semula
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
            changePhotoBtn.classList.add('d-none');
            editBtn.classList.remove('d-none');

            // Kembalikan ke nilai awal dan sembunyikan input field
            inputs.forEach(input => {
                input.classList.add('d-none');
                input.value = originalValues[input.name]; // Reset nilai
                input.setAttribute('readonly', 'true'); // Kunci input field lagi
            });

            spans.forEach(span => {
                span.classList.remove('d-none');
                span.textContent = originalValues[span.dataset.name];
            });
        }
    });

    // Fungsi Ganti Foto
    changePhotoBtn.addEventListener('click', function () {
        uploadPhoto.click();
    });

    // Fungsi Preview Foto
    uploadPhoto.addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profileImage.src = e.target.result; // Tampilkan preview
            };
            reader.readAsDataURL(file);
        }
    });
});

</script>
@endsection
