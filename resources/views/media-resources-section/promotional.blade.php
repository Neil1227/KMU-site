@extends('layouts.app')

@section('title', 'Promotional Activities')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/promotional-activities.css') }}">
@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

@include('layouts.components.generic-background')

{{-- Promotional Activities Cards --}}
<section class="container-page mb-5">
    <div class="row justify-content-center g-4 mt-4" id="promoCards">
        @forelse ($promotional as $index => $promo)
            <div class="col-md-4 mb-4 transition-card ictv-card {{ $index >= 6 ? 'd-none' : '' }}">
                <div class="card">
                    <img src="{{ asset('storage/promotional_thumbnail/' . $promo->png) }}" class="card-img media-img" alt="{{ $promo->title }}">
                    <div class="card-body">
                        <h5 class="ictv-card-title">{{ $promo->title }}</h5>
                        <p class="card-text">{{ $promo->description }}</p>
                        <a href="{{ $promo->link }}" target="_blank" class="btn watch-btn">Watch Episode</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>No promotional activities available at the moment.</p>
            </div>
        @endforelse
    </div>


    {{-- Toggle Button --}}
    @if (count($promotional) > 6)
    <div class="text-center mt-4">
        <button id="togglePromoBtn" class="btn btn-primary">Show More</button>
    </div>
    @endif
</section>

@push('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endpush

{{-- Only show sub-footer on this page --}}
@include('layouts.components.sub-footer')

@endsection
