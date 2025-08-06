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

{{-- Search Results Section --}}
<section class="technology text-center py-5">
  <h2 class="section-title mb-4" data-aos="fade-in">
   Technologies
    <hr class="hr">
  </h2>
<div class="container-page">
    <div class="card">
    <div class="card-body">
        <p>No content Available</p>
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
