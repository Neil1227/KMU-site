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
@include('layouts.components.media-navbar', ['active' => 'iec'])

@include('layouts.components.generic-background')

<div class="container-page mb-5">
    <div class="row g-4 mt-4">
        @foreach ($brochures as $brochure)
            <div class="col-md-6 col-lg-6">
                <a href="{{ asset('assets/files/iec_brochure/' . $brochure['pdf']) }}" target="_blank" class="text-decoration-none">
                    <div class="card h-100 shadow brochure-card">
                        <img src="{{ asset('storage/iec_thumbnail/' . $brochure['image']) }}" alt="{{ $brochure['title'] }}" class="card-img-top" loading="lazy">
                        <div class="overlay"><i class="fa fa-eye" style="font-size: 24px;"></i></div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $brochure['title'] }}</h5>
                            <p class="card-text small text-muted">{{ $brochure['description'] }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>


{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
