@extends('layouts.app')

@section('title', 'Technology Products')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/research.css') }}">
<link rel="stylesheet" href="{{ asset('css/technology.css') }}">
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
        <div class="col-md-4 mb-4 transition-card  {{ $index >= 6 ? 'd-none' : '' }}">
            <div class="technology-card h-100">
                {{-- Technology Image --}}
                <img
                    src="{{ $technology->poster && file_exists(storage_path('app/public/technologies/' . $technology->poster)) 
                                    ? asset('storage/technologies/' . $technology->poster) 
                                    : asset('assets/img/kmlogo.png') }}"
                    class="card-img media-img"
                    alt="{{ $technology->product ?? 'Technology Product' }}">


                <div class="card-body d-flex flex-column">
                    {{-- Product Title --}}
                    <h5 class="tech-card-title">{{ $technology->product ?? 'Untitled Product' }}</h5>

                    {{-- Net Present Value --}}
                    @php
                    $netRaw = trim($technology->net ?? '');
                    $net = is_numeric($netRaw) ? floatval($netRaw) : null;
                    @endphp

                    @if(!is_null($net) && $net > 0)
                    <p class="card-text mb-1">Net Present Value: ₱{{ number_format($net, 2) }}</p>
                    @elseif(!is_null($net) && $net == 0)
                    <p class="card-text mb-1 text-secondary"><em>Net Present Value: Not available</em></p>
                    @else
                    <p class="card-text mb-1 text-muted"><em>Net Present Value: Not available</em></p>
                    @endif


                    {{-- IP Status --}}
                    @if($technology->ip_status)
                    <p class="card-text mb-2">IP Status: {{ $technology->ip_status }}</p>
                    @endif

                    {{-- Buttons --}}
                    <div class="mt-auto d-flex gap-2 flex-wrap">
                        {{-- External link --}}
                        @if($technology->link)
                        <a href="{{ $technology->link }}" target="_blank" class="btn watch-btn">View Product</a>
                        @endif

                        {{-- Redirect to internal product page --}}
                        <a href="{{ route('technologies.show', $technology->id) }}" class="btn watch-btn">See Details</a>
                    </div>
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
<script src="{{ asset('js/navbar.js') }}"></script>
@endpush

{{-- Only show sub-footer on this page --}}
@include('layouts.components.sub-footer')

@endsection