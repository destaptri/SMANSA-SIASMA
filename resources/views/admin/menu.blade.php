@extends('layouts.sidebar')
@section('content')

<div class="search-content">
    <h4>Menu Admin</h4>
    <div class="row">
        <div class="admin-menu col-lg-4" style="margin-left: none;">
            <a  href="{{ route('pencarian-data') }}" class="btn"><i class="bi bi-people-fill"></i> Data Alumni</a>
        </div>
        <div class="admin-menu col-lg-4">
            <a href="{{ route('antrian-validasi') }}" class="btn"><i class="bi bi-check2-circle"></i> Validasi Data Alumni</a>
        </div>
        <div class="admin-menu col-lg-4">
            <a class="btn"><i class="bi bi-newspaper"></i> Berita</a>
        </div>
        <div class="admin-menu col-lg-4 mt-0">
            <a href="{{ route('admin.laporan') }}" class="btn"><i class="bi bi-file-earmark-text"></i> Laporan</a>
        </div>
    </div>
</div>
@endsection