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
        Filter By
    </button>

      <div class="dropdown-menu" id="filterMenu">
            <h6>Universitas</h6>
            <div class="custom-radio-group">
                <div class="custom-radio">
                    <input type="radio" name="universitas" id="untan" value="Universitas Tanjungpura">
                    <label for="untan">Universitas Tanjungpura</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="universitas" id="pnp" value="Politeknik Negeri Pontianak">
                    <label for="pnp">Politeknik Negeri Pontianak</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="universitas" id="ugm" value="Universitas Gadjah Mada">
                    <label for="ugm">Universitas Gadjah Mada</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="universitas" id="itb" value="Institut Teknologi Bandung">
                    <label for="itb">Institut Teknologi Bandung</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="universitas" id="lainnya-universitas" value="Lainnya">
                    <label for="lainnya-universitas">Lainnya</label>
                </div>
            </div>

            <h6 class="mt-4">Jurusan</h6>
            <div class="custom-radio-group">
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="si" value="Sistem Informasi">
                    <label for="si">Sistem Informasi</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="statistika" value="Statistika">
                    <label for="statistika">Statistika</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="kedokteran" value="Kedokteran">
                    <label for="kedokteran">Kedokteran</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="manajemen" value="Manajemen">
                    <label for="manajemen">Manajemen</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="psikologi" value="Psikologi">
                    <label for="psikologi">Psikologi</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="jurusan" id="lainnya-jurusan" value="Lainnya">
                    <label for="lainnya-jurusan">Lainnya</label>
                </div>
            </div>

            <h6 class="mt-4">Tahun Lulus</h6>
            <div class="custom-radio-group">
                <div class="custom-radio">
                    <input type="radio" name="tahun" id="2023" value="2023">
                    <label for="2023">2023</label>
                </div>
                <div class="custom-radio">
                    <input type="radio" name="tahun" id="2024" value="2024">
                    <label for="2024">2024</label>
                </div>
            </div>

            <button class="btn apply-btn" id="applyBtn">Terapkan</button>
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