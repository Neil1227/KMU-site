@extends('layouts.app')

@section('title', 'IEC Materials')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iec.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">

@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')


{{-- Navbar --}}
@include('layouts.components.media-navbar', ['active' => 'iec materials'])

@include('layouts.components.generic-background')

<div class="container-page mb-5">
    <div class="row justify-content-center g-4 mt-4">
        @foreach ($brochures as $brochure)
            <div class="col-md-4 col-lg-4 transition-card">
                <div class="card">
                    <div class="image-container">
                        <img src="{{ asset('storage/iec_thumbnail/' . $brochure->png) }}" 
                            alt="{{ $brochure->title }}" 
                            class="card-img" 
                            loading="lazy">
                        <!-- <div class="overlay">
                            <i class="fa fa-eye" style="font-size: 24px;"></i>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <h5 class="card-title-iec">{{ $brochure->title }}</h5>
                        <a href="{{ asset('storage/iec_brochure/' . $brochure->file) }}" 
                        target="_blank" 
                        class="btn watch-btn mt-2">
                            View Brochure
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
