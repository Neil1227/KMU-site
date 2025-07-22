@extends('layouts.app')

@section('title', 'Modules')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.media-navbar', ['active' => 'modules'])

@include('layouts.components.generic-background')

{{-- Background Image Overlay --}}
<div class="background-container">
    <picture>
        <source srcset="{{ asset('assets/img/logos-bg.webp') }}" type="image/webp">
        <img src="{{ asset('assets/img/logos-bg.png') }}" alt="Abstract Background" loading="lazy" class="background-img">
    </picture>
    <div class="background-overlay"></div>
</div>

<section class="container-page my-5">
    <div class="row g-4" id="moduleCards">
        @foreach ($modules as $index => $module)
            <div class="col-md-6 col-lg-4 module-card transition-card {{ $index >= 6 ? 'hidden-card' : '' }}">
                <a href="{{ asset('storage/modules/' . $module->file) }}" target="_blank" class="text-decoration-none">
                    <div class="pdf-card">
                        <img src="{{ asset('storage/modules_thumbnail/' . $module->png) }}" 
                            alt="{{ $module->title }}"
                            loading="lazy"
                            class="img-fluid">
                        <div class="card-body text-center mt-2">
                            <h6>{{ $module->title }}</h6>
                            <small>Click to open PDF</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Toggle Button --}}
    @if ($modules->count() > 6)
        <div class="text-center mt-4">
            <button id="toggleBtn" class="btn btn-primary">Show More</button>
        </div>
    @endif
</section>




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.module-card.transition-card');
    const toggleBtn = document.getElementById('toggleBtn');
    let expanded = false;

    toggleBtn.addEventListener('click', () => {
        cards.forEach((card, index) => {
            if (index >= 6) {
                card.classList.toggle('hidden-card');
            }
        });

        toggleBtn.textContent = expanded ? 'Show More' : 'Show Less';
        expanded = !expanded;

        if (!expanded) {
            document.getElementById('moduleCards').scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>
@endpush




{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
