@extends('layouts.app')

@section('title', 'Technology')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/technology.css') }}">
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

<section class="technology py-4">
    <div class="container-page my-5">

        @php
            $inventors = $technology->inventors ?? [];
            $propositions = $technology->proposition ?? [];
            $benefits = $technology->benefits ?? [];
        @endphp

<div class="row align-items-center mb-5">
    <!-- Left Column (Text) -->
    <div class="col-md-6 d-flex flex-column">
        <h1 class="section-title p-0 mb-2" data-aos="fade-in">
            Technology
        </h1>

        <h2 class="fw-bold highlight tech-title mb-3">{{ $technology->product }}</h2>

        <p class="text-muted">{{ $technology->desc }}</p>

        <p class="fs-5 npv-value mt-3">
            Net Present Value: ₱<span>{{ number_format($technology->net ?? 0, 2) }}</span>
        </p>

        <!-- Profit & Button for medium and up -->
        <div class="d-none d-md-flex align-items-center gap-3 mt-3">
            <a href="#" class="profit-btn">Earn {{ $technology->profit ?? 'N/A' }} Profit!</a>

            <button type="button" 
                    class="btn btn-light d-flex align-items-center gap-2 shadow-sm rounded-3 px-3 py-2"
                    data-bs-toggle="modal" 
                    data-bs-target="#downloadModal"
                    style="cursor: pointer;">
                <i class="bi bi-download fs-5 icon-colored"></i>
                <span class="fw-semibold text-dark">View & Download</span>
            </button>

            @include('layouts.components.modal-technology')
        </div>
    </div>

    <!-- Right Column (Image) -->
    <div class="col-md-6 d-flex flex-column align-items-center">
        <div class="image-card p-3 rounded-4 shadow-lg bg-white mb-3">
            @php
                $imagePath = $technology->image && file_exists(storage_path('app/public/technologies/' . $technology->image))
                            ? asset('storage/technologies/' . $technology->image)
                            : asset('assets/img/kmlogo.png');
            @endphp

            <img src="{{ $imagePath }}" 
                alt="{{ $technology->product ?? 'Technology' }}" 
                class="img-fluid rounded-3"
                style="max-width: 220px; max-height: 280px; transition: transform 0.3s ease;">
        </div>

        <!-- Profit & Button for mobile only -->
        <div class="d-flex d-md-none flex-column gap-2 w-100 mt-2 align-items-center">
            <a href="#" class="profit-btn">Earn {{ $technology->profit ?? 'N/A' }} Profit!</a>

            <button type="button" 
                    class="btn btn-light d-flex align-items-center gap-2 shadow-sm rounded-3 px-3 py-2"
                    data-bs-toggle="modal" 
                    data-bs-target="#downloadModal"
                    style="cursor: pointer;">
                <i class="bi bi-download fs-5 icon-colored"></i>
                <span class="fw-semibold text-dark">View & Download</span>
            </button>
        </div>
    </div>
</div>


        <hr>
        <!-- Inventors -->
        @if(count($inventors))
        <div class="mb-5 row align-items-start">
            <div class="col-md-4">
                <h5 class="fw-bold tech-title">
                    <i class="bi bi-people me-2 icon-colored"></i> Inventors
                </h5>
            </div>
            <div class="col-md-8">
                <ul class="list-unstyled text-muted mb-0">
                    @foreach($inventors as $inventor)
                    <li class="mb-2 fw-semibold">
                        <i class="bi bi-person-fill me-2 icon-colored"></i> {{ $inventor }}
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- IP Status -->
        @if($technology->ip_status)
        <div class="mb-5 row align-items-start">
            <div class="col-md-4">
                <h5 class="fw-bold tech-title">
                    <i class="bi bi-shield-lock me-2 icon-colored"></i> IP Status
                </h5>
            </div>
            <div class="col-md-8">
                <p class="fw-semibold text-muted mb-1">Registration no. {{ $technology->ip_status }}</p>
            </div>
        </div>
        @endif

        <!-- Product Propositions & Consumer Benefits -->
        <div class="row mb-5">
            @if(count($propositions))
            <div class="col-md-6">
                <h5 class="fw-bold tech-title"><i class="bi bi-graph-up-arrow me-2 icon-colored"></i> Product Propositions</h5>
                <ul class="mt-3 text-muted">
                    @foreach($propositions as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(count($benefits))
            <div class="col-md-6">
                <h5 class="fw-bold tech-title"><i class="bi bi-people-fill me-2 icon-colored"></i> Consumer Benefits</h5>
                <ul class="mt-3 text-muted">
                    @foreach($benefits as $benefit)
                    <li>{{ $benefit }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- Contact (Static) -->
        <div class="mb-5">
            <h5 class="fw-bold tech-title">
                <i class="bi bi-envelope me-2 icon-colored"></i> Contact
            </h5>
            <div class="row row-cols-2 row-cols-md-3 g-2 mt-3">
                <div class="col">
                    <a href="mailto:ip-tbm@psau.edu.ph" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2 icon-colored"></i> ip-tbm@psau.edu.ph
                    </a>
                </div>
                <div class="col">
                    <a href="mailto:sibul@psau.edu.ph" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2 icon-colored"></i> sibul@psau.edu.ph
                    </a>
                </div>
                <div class="col">
                    <a href="mailto:kmc@psau.edu.ph" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-envelope-fill me-2 icon-colored"></i> kmc@psau.edu.ph
                    </a>
                </div>
                <div class="col">
                    <a href="https://www.facebook.com/psau.iptbm" target="_blank" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-facebook me-2 icon-colored"></i> psau.iptbm
                    </a>
                </div>
                <div class="col">
                    <a href="https://www.facebook.com/psau.tbi" target="_blank" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-facebook me-2 icon-colored"></i> psau.tbi
                    </a>
                </div>
                <div class="col">
                    <a href="https://www.facebook.com/psau.kmc" target="_blank" class="text-decoration-none text-dark contact-link d-flex align-items-center">
                        <i class="bi bi-facebook me-2 icon-colored"></i> psau.kmc
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
@endpush
