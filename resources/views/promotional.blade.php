@extends('layouts.app')

@section('title', 'Promotion Activities')

@push('css')
<link rel="stylesheet" href="{{ asset('css/promotional-activies.css') }}">
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/research.css') }}">
<link rel="stylesheet" href="{{ asset('css/ictv.css') }}">

@endpush

@section('content')


{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

@include('layouts.components.generic-background')

{{-- Promotional Activities Cards --}}
<section class="container-page my-5">
    <div class="row justify-content-center" id="ictvCards">
        @foreach ($episodes as $index => $episode)
        <div class="col-md-4 mb-4 transition-card ictv-card {{ $index >= 6 ? 'd-none' : '' }}">
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

    {{-- Toggle Button --}}
    @if (count($episodes) > 6)
    <div class="text-center mt-4">
        <button id="toggleIctvBtn" class="btn btn-primary">Show More</button>
    </div>
    @endif
</section>
@push('scripts')
<script>
    document.getElementById('toggleIctvBtn').addEventListener('click', function() {
        const hiddenCards = document.querySelectorAll('.ictv-card.d-none');
        const isHidden = hiddenCards.length > 0;

        hiddenCards.forEach(card => {
            card.classList.toggle('d-none');
        });

        this.textContent = isHidden ? 'Show Less' : 'Show More';
    });
</script>

@endpush

{{-- Only show sub-footer on this page --}}
@include('layouts.components.sub-footer')


@endsection