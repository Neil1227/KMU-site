@extends('layouts.app')

@section('title', 'ICTV')

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
<section class="container-page my-5">
    <div class="row justify-content-center">
        @foreach ($episodes as $episode)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <picture>
                        <source srcset="{{ asset('assets/img/ictv_thumbnail/' . $episode['webp']) }}" type="image/webp">
                        <img src="{{ asset('assets/img/ictv_thumbnail/' . $episode['png']) }}" class="card-img-top media-img" alt="{{ $episode['title'] }}">
                    </picture>
                    <div class="card-body">
                        <h5 class="ictv-card-title">{{ $episode['title'] }}</h5>
                        <p class="card-text">{{ $episode['description'] }}</p>
                        <a href="{{ $episode['link'] }}" target="_blank" class="btn watch-btn">Watch Episode</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Only show sub-footer on this page --}}
@include('layouts.components.sub-footer')


@endsection
