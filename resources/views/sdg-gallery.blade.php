@extends('layouts.app')

@section('title', "SDG {$sdgData->sdg_number} Gallery")

@push('css')
    <link rel="stylesheet" href="{{ asset('css/sdg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
    <style>
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            /* ALWAYS 3 per row */
            gap: 20px;
            padding: 40px 80px;
        }

        .gallery-grid img {
            width: 100%;
            /* Take full column width */
            height: auto;
            /* Maintain aspect ratio */
            border-radius: 10px;
            cursor: pointer;
            transition: transform .3s;
            display: block;
            /* Removes white gaps under images */
        }

        .gallery-grid img:hover {
            transform: scale(1.05);
        }

        /* 🔥 Responsive for smaller screens */
        @media (max-width: 992px) {
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                /* 2 per row */
                padding: 40px 20px;
            }

        }

        @media (max-width: 576px) {
            .gallery-grid {
                grid-template-columns: repeat(1, 1fr);
                /* 1 per row */
            }
        }
    </style>
@endpush

@include('layouts.components.header')
@include('layouts.components.navbar')

@section('content')

    <h2 class="text-center my-4 section-title" data-aos="fade-up">
        SDG {{ $sdgData->sdg_number }} – Gallery
    </h2>

    <div class="gallery-grid">
        @foreach ($galleryImages as $image)
            <img src="{{ $image }}" alt="Gallery Image">
        @endforeach
    </div>

    @include('layouts.components.footer')

@endsection
