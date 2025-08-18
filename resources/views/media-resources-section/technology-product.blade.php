@extends('layouts.app')

@section('title', 'Technology Products')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ictv.css') }}">
@endpush

@section('content')

    {{-- Header --}}
    @include('layouts.components.header')

    {{-- Navbar --}}
    @include('layouts.components.navbar')

    {{-- Background --}}
    @include('layouts.components.generic-background')

    {{-- Technology Product Cards --}}
    <section class="container-page mb-5" id="technology">
        <div class="row justify-content-center g-4 mt-4" id="technologyCards">
            @forelse ($technologies as $index => $technology)
                <div class="col-md-4 mb-4 transition-card technology-card {{ $index >= 6 ? 'd-none' : '' }}">
                    <div class="card">
                        <img src="{{ asset('storage/technology_thumbnail/' . $technology->png) }}" 
                             class="card-img media-img" 
                             alt="{{ $technology->title }}">
                        <div class="card-body">
                            <h5 class="ictv-card-title">{{ $technology->title }}</h5>
                            <p class="card-text">{{ $technology->description }}</p>
                            <a href="{{ $technology->link }}" target="_blank" class="btn watch-btn">View Product</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center">No technology products available at the moment.</p>
            @endforelse
        </div>

        {{-- Toggle Button --}}
        @if ($technologies->count() > 6)
            <div class="text-center mt-4">
                <button id="toggleTechnologyBtn" class="btn btn-primary">Show More</button>
            </div>
        @endif
    </section>

    @push('scripts')
        <script src="{{ asset('js/show.js') }}"></script>
    @endpush

    {{-- Only show sub-footer on this page --}}
    @include('layouts.components.sub-footer')

@endsection
