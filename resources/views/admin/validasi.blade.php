@extends('layouts.sidebar')
@section('content')
<div class="search-content">
    <h4>Validasi Data Alumni</h4>

    <div class="container-search">
        <form class="search-box d-flex w-100">
            <div class="input-group flex-grow-1">
                <input class="form-control" type="search" name="search"
                    placeholder="Cari Data Alumni..."
                    value="{{ request('search') }}"
                    aria-label="Search">
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
                    <tbody id="resultBody">
                        @forelse($pengajuan as $data)
                        <tr>
                            <td data-label="Nama Lengkap">{{ $data->nama_lengkap }}</td>
                            <td data-label="Tahun Lulus">{{ $data->tahun_lulus }}</td>
                            <td data-label="Universitas">{{ $data->universitas }}</td>
                            <td data-label="Jurusan">{{ $data->jurusan }}</td>
                            <td data-label="Jalur Penerimaan">{{ $data->jalur_penerimaan }}</td>
                            <td style="text-align: center; vertical-align: middle;">
                                <a href="{{ route('detail-data', $data->id) }}" class="btn btn-primary" style="padding-top:3px">Lihat</a>
                                <!-- <button class="btn btn-danger">Hapus</button> -->
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Antrian validasi kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Update pagination section -->
    <div class="pagination-container">
        {{ $pengajuan->links('pagination.custom') }}
    </div>
</div>
</div>
@endsection