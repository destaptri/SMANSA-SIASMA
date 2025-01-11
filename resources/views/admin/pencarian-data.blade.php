@extends('layouts.sidebar')
@section('content')
<div class="search-content">
    <h4>Data Alumni</h4>

    <div class="container-search">
        <form class="search-box d-flex w-100">
            <div class="input-group flex-grow-1">
                <input class="form-control" type="search" placeholder="Cari Data Alumni..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="row pencarian">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Tahun Lulus</th>
                            <th>Universitas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        <tr>
                            <td data-label="Nama Lengkap">John Doe</td>
                            <td data-label="Tahun Lulus">2020</td>
                            <td data-label="Universitas">Universitas Indonesia</td>
                            <td data-label="Jurusan">Sistem Informasi</td>
                            <td style="text-align: center; vertical-align: middle;">
                            <button class="btn btn-primary justify-content-center">Lihat</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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