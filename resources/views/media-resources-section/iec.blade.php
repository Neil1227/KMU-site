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

{{-- IEC Brochures Cards --}}
<section class="container-page mb-5">
    <div class="row justify-content-center g-4 mt-4" id="brochureCards">
        @forelse ($brochures as $index => $brochure)
            <div class="col-md-4 col-lg-4 mb-4 transition-card {{ $index >= 6 ? 'd-none' : '' }}">
                <div class="card">
                    <div class="image-container">
                        <img src="{{ asset('storage/iec_thumbnail/' . $brochure->png) }}" 
                            alt="{{ $brochure->title }}" 
                            class="card-img" 
                            loading="lazy">
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
        @empty
            <div class="col-12 text-center">
                <p>No brochures available at the moment.</p>
            </div>
        @endforelse
    </div>

    {{-- Toggle Button --}}
    @if (count($brochures) > 6)
    <div class="text-center mt-4">
        <button id="toggleBrochureBtn" class="btn btn-primary">Show More</button>
    </div>
    @endif
</section>

@push('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endpush

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
