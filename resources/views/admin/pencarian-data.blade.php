@extends('layouts.sidebar')
@section('content')
<div class="search-content">
    <h4>Data Alumni</h4>

    <div class="container-search">
        <form class="search-box d-flex w-100" action="{{ route('pencarian-data') }}" method="GET">
            <div class="input-group flex-grow-1">
                <input class="form-control" type="search" name="search" placeholder="Cari Data Alumni..."
                    aria-label="Search" value="{{ request('search') }}">
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
                            <th>Jalur Penerimaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alumni as $data)
                        <tr>
                            <td data-label="Nama Lengkap">{{ $data->nama_lengkap }}</td>
                            <td data-label="Tahun Lulus">{{ $data->tahun_lulus }}</td>
                            <td data-label="Universitas">{{ $data->universitas }}</td>
                            <td data-label="Jurusan">{{ $data->jurusan }}</td>
                            <td data-label="Jalur Penerimaan">{{ $data->jalur_penerimaan }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('detail-pencarian', $data->id) }}"
                                    class="btn btn-primary justify-content-center" style="padding-top:3px">Lihat</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data yang ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination Section -->
    <div class="pagination-container">
        {{ $alumni->withQueryString()->links() }}
    </div>
</div>
@endsection