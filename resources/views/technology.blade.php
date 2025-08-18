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
<section class="technology py-4">

  {{-- Technology Product Cards --}}
<div class="container-page my-5">

  <div class="row align-items-center mb-5">
    <!-- Left Column (Text) -->
    <div class="col-md-6 ">
        <h1 class="section-title p-0 mb-2" data-aos="fade-in">
        Technology
        </h1>
          <h2 class="fw-bold highlight tech-title mb-3">Tamarind Juice</h2>
            <p class="text-muted">
              Our distinctive blend perfectly balances the tangy flavor of sour tamarind fruits
              with the lush sweetness of brown sugar. Combined with the subtle richness of
              dry active yeast and the refreshing clarity of mineral water, this mixture goes
              beyond typical flavors to enrich any dish it graces.
            </p>
            <p class="fs-5 npv-value mt-3">Net Present Value: ₱<span>50,713,134.60</span></p>
        
      <div class="d-flex align-items-center gap-3 mt-3">
          <!-- Profit Badge -->
          <a href="#" class="profit-btn">Earn 55% Profit!</a>

          <!-- Trigger Button with Icon -->
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
      <div class="col-md-6 d-flex justify-content-center">
        <div class="image-card p-3 rounded-4 shadow-lg bg-white">
          <img src="./assets/img/juice.png" 
              alt="NeuroSync Wearable" 
              class="img-fluid rounded-3"
              style="max-width: 280px; transition: transform 0.3s ease;">
        </div>
      </div>

    </div>
            
  <hr>

<!-- Inventors -->
<div class="mb-5 row align-items-start">
  <div class="col-md-4">
    <h5 class="fw-bold tech-title">
      <i class="bi bi-people me-2 icon-colored"></i> Inventors
    </h5>
  </div>
  <div class="col-md-8">
    <ul class="list-unstyled text-muted mb-0">
      <li class="mb-2 fw-semibold"><i class="bi bi-person-fill me-2 icon-colored"></i> Filomena K. Reyes</li>
      <li class="mb-2 fw-semibold"><i class="bi bi-person-fill me-2 icon-colored"></i> Warlina M. Guzman</li>
      <li class="mb-2 fw-semibold"><i class="bi bi-person-fill me-2 icon-colored"></i> Glenn M. Velasquez</li>
    </ul>
  </div>
</div>

<!-- IP Status -->
<div class="mb-5 row align-items-start">
  <div class="col-md-4">
    <h5 class="fw-bold tech-title">
      <i class="bi bi-shield-lock me-2 icon-colored"></i> IP Status
    </h5>
  </div>
  <div class="col-md-8">
    <p class="fw-semibold text-muted mb-1">Registration No. 2/2020/050418</p>
  </div>
</div>


  <!-- Product Propositions & Consumer Benefits -->
  <div class="row mb-5">
    <div class="col-md-6">
      <h5 class="fw-bold tech-title"><i class="bi bi-graph-up-arrow me-2 icon-colored"></i> Product Propositions</h5>
      <ul class="mt-3 text-muted">
        <li>100% Philippine product</li>
        <li>Made from the first-ever sweet tamarind varienty registered in the Philippines</li>
        <li>Sold in an ergonomic plastic bottle</li>
      </ul>
    </div>
    <div class="col-md-6">
      <h5 class="fw-bold tech-title"><i class="bi bi-people-fill me-2 icon-colored"></i> Consumer Benefits</h5>
      <ul class="mt-3 text-muted">
        <li>Rich in Antioxidants</li>
        <li>High in Calcium</li>
        <li>Heart-healthy</li>
        <li>Offers heathly benefits for the liver</li>
      </ul>
    </div>
  </div>

<!-- Contact -->
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
