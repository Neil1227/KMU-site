@extends('layouts.app')

@section('title', 'Podcast')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/promotional-activities.css') }}">
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

{{-- Podcast Cards --}}
<section class="container-page my-5">
    <div class="row justify-content-center" id="podcastCards">
        @foreach ($podcasts as $index => $podcast)
            <div class="col-md-4 mb-4 transition-card podcast-card {{ $index >= 6 ? 'd-none' : '' }}">
                <div class="card">
                    <img src="{{ asset('storage/podcast_thumbnail/' . $podcast->png) }}" class="card-img-top media-img" alt="{{ $podcast->title }}">
                    <div class="card-body">
                        <h5 class="ictv-card-title">{{ $podcast->title }}</h5>
                        <p class="card-text">{{ $podcast->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Toggle Button --}}
    @if (count($podcasts) > 6)
        <div class="text-center mt-4">
            <button id="togglePodcastBtn" class="btn btn-primary">Show More</button>
        </div>
    @endif
</section>

@push('scripts')
<script>
document.getElementById('togglePodcastBtn')?.addEventListener('click', function () {
    const hiddenCards = document.querySelectorAll('.podcast-card.d-none');
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
