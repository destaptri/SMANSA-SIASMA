@extends('layouts.kepsek')
@section('content')

<div class="search-content">
    <h4>Menu Kepala Sekolah</h4>
    <div class="row">    
    <div class="admin-menu col-lg-4" style="margin-left: none;">
        <a href="{{ route('kepsek.laporan') }}" class="btn"><i class="bi bi-file-earmark-text"></i> Laporan</a>
        </div>
    </div>
</div>
@endsection