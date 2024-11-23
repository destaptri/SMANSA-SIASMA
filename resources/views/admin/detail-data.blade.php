@extends('layouts.sidebar') 
@section('content')
<div class="biodata">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Hasil Pencarian</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Alumni</li>
        </ol>
    </nav>

    <div class="container-biodata col-lg-12">
        <div class="row justify-content-center col-lg-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <!-- Heading -->
                <h3 class="text-lg-start text-center">Biodata Alumni</h3>

                <div class="row">
                    <!-- Foto Profil dan Ganti Foto -->
                    <div class="col-lg-3 col-md-12 text-center">
                        <img src="{{ Vite::asset('public/images/ava_demo.png') }}" class="img-fluid mb-3" alt="Foto Alumni" id="profile-image">
                        <button class="btn btn-primary d-none" id="change-photo-btn">Ganti Foto</button>
                        <input type="file" class="form-control d-none" id="upload-photo">
                    </div>

                    <!-- Tabel Biodata Alumni -->
                    <div class="col-lg-9 col-md-12">
                        <table class="table table-bordered" id="biodata-table">
                            <tbody>
                                <tr>
                                    <th>NISN</th>
                                    <td contenteditable="false" class="editable">1234567890</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td contenteditable="false" class="editable">John Doe</td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td contenteditable="false" class="editable">12 IPA 1</td>
                                </tr>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <td contenteditable="false" class="editable">2020</td>
                                </tr>
                                <tr>
                                    <th>Universitas</th>
                                    <td contenteditable="false" class="editable">Universitas ABC</td>
                                </tr>
                                <tr>
                                    <th>Fakultas</th>
                                    <td contenteditable="false" class="editable">Fakultas Teknik</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td contenteditable="false" class="editable">Teknik Informatika</td>
                                </tr>
                                <tr>
                                    <th>Jalur Penerimaan</th>
                                    <td contenteditable="false" class="editable">SNMPTN</td>
                                </tr>
                                <tr>
                                    <th>Tahun Diterima</th>
                                    <td contenteditable="false" class="editable">2021</td>
                                </tr>
                                <tr>
                                    <th>Status Pekerjaan</th>
                                    <td contenteditable="false" class="editable">Bekerja</td>
                                </tr>
                                <tr>
                                    <th>Biodata Valid</th>
                                    <td contenteditable="false" class="editable">Ya</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Tombol Simpan dan Batal -->
                        <div class="d-flex justify-content-center justify-content-lg-end mt-4">
                            <button class="btn btn-success me-2" id="edit-btn">Edit Biodata</button>
                            <button class="btn btn-primary d-none" id="save-btn">Simpan</button>
                            <button class="btn btn-secondary d-none" id="cancel-btn">Batal</button>
                        </div>
                    </div>
                </div> <!-- end of row -->
            </div> <!-- end of column -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('edit-btn');
        const saveBtn = document.getElementById('save-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        const changePhotoBtn = document.getElementById('change-photo-btn');
        const uploadPhoto = document.getElementById('upload-photo');
        const tableCells = document.querySelectorAll('.editable');

        editBtn.addEventListener('click', function () {
            tableCells.forEach(cell => cell.setAttribute('contenteditable', 'true'));
            editBtn.classList.add('d-none');
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
            changePhotoBtn.classList.remove('d-none');
        });

        saveBtn.addEventListener('click', function () {
            tableCells.forEach(cell => cell.setAttribute('contenteditable', 'false'));
            editBtn.classList.remove('d-none');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
            changePhotoBtn.classList.add('d-none');
        });

        cancelBtn.addEventListener('click', function () {
            tableCells.forEach(cell => cell.setAttribute('contenteditable', 'false'));
            editBtn.classList.remove('d-none');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
            changePhotoBtn.classList.add('d-none');
        });

        changePhotoBtn.addEventListener('click', function () {
            uploadPhoto.click();
        });

        uploadPhoto.addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('profile-image').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
