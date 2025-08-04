@extends('layouts.app')

@section('title', 'Newsletter')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/newsletter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.media-navbar', ['active' => 'newsletter'])

@include('layouts.components.generic-background')

{{-- Background Image Overlay --}}
<div class="background-container">
    <picture>
        <source srcset="{{ asset('assets/img/logos-bg.webp') }}" type="image/webp">
        <img src="{{ asset('assets/img/logos-bg.png') }}" alt="Abstract Background" loading="lazy" class="background-img">
    </picture>
    <div class="background-overlay"></div>
</div>

{{-- Newsletter PDF Cards --}}
<section class="container-page my-5">
    <div id="newsletterCards" class="row g-4">
        @foreach ($newsletters as $index => $newsletter)
            <div class="col-md-6 col-lg-4 newsletter-card {{ $index >= 6 ? 'collapsed' : '' }}">
                <a href="{{ asset('storage/newsletter/' . $newsletter->file) }}" target="_blank" class="text-decoration-none">
                    <div class="pdf-card">
                        <img src="{{ asset('storage/newsletter_thumbnail/' . $newsletter->png) }}"
                             alt="Preview of Newsletter"
                             loading="lazy"
                             class="img-fluid">
                        <div class="card-body text-center mt-2">
                            <h6>{{ $newsletter->title }}</h6>
                            <small>Click to open PDF</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-4">
        <button id="toggleNewsletterBtn" class="btn btn-primary">Show More</button>
    </div>
</section>


@push('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endpush


{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
