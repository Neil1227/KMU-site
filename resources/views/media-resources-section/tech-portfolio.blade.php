@extends('layouts.app')

@section('title', 'Tech Portfolio')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tech-portfolio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">

@endpush

@section('content')
@include('layouts.components.header')
@include('layouts.components.media-navbar', ['active' => 'tech-portfolio'])

@include('layouts.components.generic-background')

<section class="container-page my-5">
    <div class="row g-4">
        @foreach ($techImages as $image)
            <div class="col-md-6 col-lg-4">
                <div class="image-card">
                    <div class="image-container">
                        <img src="{{ asset('assets/img/tech_thumbnail/' . $image) }}" alt="Tech Image" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-transparent border-0 position-relative">
            <button type="button" class="btn-close custom-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body text-center p-0">
                <img id="modalImage" src="" alt="" class="img-fluid rounded-4 shadow-lg" />
                <p id="modalCaption" class="text-white bg-dark bg-opacity-75 mt-2 p-2 rounded-3 d-inline-block"></p>
            </div>
            <button id="prevBtn" class="btn btn-light position-absolute top-50 start-0 translate-middle-y ms-3">&#8592;</button>
            <button id="nextBtn" class="btn btn-light position-absolute top-50 end-0 translate-middle-y me-3">&#8594;</button>
        </div>
    </div>
</div>

@include('layouts.components.sub-footer')

@push('scripts')
<script src="{{ asset('js/tech-portfolio-image.js') }}"></script>
@endpush
@endsection
