@extends('layouts.alumni')

@section('content')
<div class="search-content">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profil</li>
        </ol>
    </nav>
    <h4>Profil</h4>
    <div class="container-fluid col-lg-12 col-sm-12 pt-4 w-full" style="overflow-y: hidden;">
        <div class="col-lg-12 col-sm-12">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>
    <div class="container-fluid col-lg-12 col-sm-12 pt-4 w-full" style="overflow-y: hidden;">
        <div class="col-lg-12 col-sm-12">
            @include('profile.partials.update-password-form')
        </div>
    </div>
    <!-- <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div> -->
</div>
</div>
@endsection