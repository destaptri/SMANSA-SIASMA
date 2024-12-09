@extends('layouts.alumni')

@section('content')
<div class="search-content">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hasil Pencarian</li>
        </ol>
    </nav>
    <h4>Hasil Pencarian</h4>

    <div class="container-search">
        <form class="search-box d-flex w-100">
            <div class="input-group flex-grow-1">
                <input class="form-control" type="search" placeholder="Hasil Pencarian" aria-label="Search">
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
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Tahun Lulus</th>
                            <th>Universitas</th>
                            <th>Program Studi</th>
                        </tr>
                    </thead>
                    <tbody id="resultBody">
                        <tr>
                            <td data-label="NISN">12345678</td>
                            <td data-label="Nama Lengkap">John Doe</td>
                            <td data-label="Tahun Lulus">2020</td>
                            <td data-label="Universitas">Universitas Indonesia</td>
                            <td data-label="Program Studi">Teknik Informatika</td>
                        </tr>
                        <tr>
                            <td data-label="NISN">87654321</td>
                            <td data-label="Nama Lengkap">John Smith</td>
                            <td data-label="Tahun Lulus">2019</td>
                            <td data-label="Universitas">Institut Teknologi Bandung</td>
                            <td data-label="Program Studi">Desain Produk</td>
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