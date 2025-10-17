@extends('layouts.app')

@section('title', 'KMU | ICTV')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ictv.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.media-navbar', ['active' => 'ictv'])

@include('layouts.components.generic-background')

{{-- ICTV Episode Cards --}}
<section class="container-page mb-5">
    <div class="row justify-content-center g-4 mt-4" id="ictvCards">
        @foreach ($episodes as $index => $episode)
            <div class="col-md-4 transition-card ictv-card {{ $index >= 6 ? 'collapsed' : '' }}">
                <div class="card">
                    <img src="{{ asset('storage/ictv_thumbnail/' . $episode->png) }}" class="card-img media-img" alt="{{ $episode->title }}">
                    <div class="card-body">
                        <h5 class="ictv-card-title">{{ $episode->title }}</h5>
                        <p class="card-text">{{ $episode->description }}</p>
                        <a href="{{ route('video.show', ['type' => 'ictv', 'id' => $episode->id]) }}" class="btn watch-btn">
                            Watch Episode
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if (count($episodes) > 6)
        <div class="text-center mt-4">
            <button id="toggleIctvBtn" class="btn btn-primary">Show More</button>
        </div>
    @endif
</section>


@push('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endpush

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
