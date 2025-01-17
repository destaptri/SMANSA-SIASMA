@extends('layouts.sidebar')
@section('content')
<div class="search-content">
    <h4>Laporan Data Alumni</h4>
    <div class="container-search">
        <div class="d-flex align-items-center gap-3">
            <!-- Search Input -->
            <form class="search-box flex-grow-1">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Cari Data Alumni..." aria-label="Search">
                    <button class="btn btn-outline-secondary flex-grow-2" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            <!-- Filter Dropdown -->
            <div class="filter position-relative">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownFilterButton">
                    Pilih Kolom
                </button>

                <div class="dropdown-menu" id="filterMenu">
                    <h6>Pilih Kolom</h6>
                    <div class="custom-checkbox-group">
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="nisn" value="NISN">
                            <label for="nisn">NISN</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="nama_lengkap" value="Nama Lengkap">
                            <label for="nama_lengkap">Nama Lengkap</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="tahun_lulus" value="Tahun Lulus">
                            <label for="tahun_lulus">Tahun Lulus</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="universitas" value="Universitas">
                            <label for="universitas">Universitas</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="jurusan" value="Jurusan">
                            <label for="jurusan">Jurusan</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="jalur_penerimaan" value="Jalur Penerimaan">
                            <label for="jalur_penerimaan">Jalur Penerimaan</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="pilihan_pertama" value="Pilihan Pertama">
                            <label for="pilihan_pertama">Pilihan Pertama</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="pilihan_kedua" value="Pilihan Kedua">
                            <label for="pilihan_kedua">Pilihan Kedua</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="skor_utbk" value="Skor UTBK">
                            <label for="skor_utbk">Skor UTBK</label>
                        </div>
                        <div class="custom-checkbox">
                            <input type="checkbox" name="filter[]" id="tahun_diterima" value="Tahun Diterima">
                            <label for="tahun_diterima">Tahun Diterima</label>
                        </div>
                    </div>
                    <button class="btn apply-btn" id="applyBtn">Terapkan</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row pencarian">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Tahun Lulus</th>
                            <th>Universitas</th>
                            <th>Jurusan</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        <tr>
                            <td data-label="Nama Lengkap">1234567890</td>
                            <td data-label="Nama Lengkap">John Doe</td>
                            <td data-label="Tahun Lulus">2020</td>
                            <td data-label="Universitas">Universitas Indonesia</td>
                            <td data-label="Jurusan">Sistem Informasi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="export d-flex justify-content-end mt-2">
        <button type="button" class="btn" data-bs-toggle="" data-bs-target="" style="background-color: #083579;">
            Export As Excel
        </button>
    </div>

    <!-- Pagination Section -->
    <div class="pagination-container">
        <div class="pagination">
            <button class="page-item" id="prevPage">
                <span>&lt;</span>
            </button>
            <div class="page-item">
                <input type="text" id="currentPage" value="1">
            </div>
            <span class="mx-2">dari</span>
            <span id="totalPages">10</span>
            <button class="page-item" id="nextPage">
                <span>&gt;</span>
            </button>
        </div>
    </div>
</div>
</div>
@endsection