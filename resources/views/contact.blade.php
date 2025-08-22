@extends('layouts.app')

@section('title', 'Contact Us')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

{{-- Contact Section --}}


<section class="container-page">
<h2 class="text-center mb-4 mt-3 section-title" data-aos="fade-up">Get in <span class="title-highlight">touch with us!</span> </h2>
<div class="row g-4 mb-3">
  <!-- Right Column (Form) -->
  <div class="col-md-7 order-1 order-md-2">
  <div class="card form-card p-4">
    <h4 class="mb-3 fw-bold highlight">Send us a message</h4>
    <form id="contactForm" action="https://formspree.io/f/xzzvwzyn" method="POST">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" name="name" class="form-control" placeholder="eg. Juan Dela Cruz" required>
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" placeholder="eg. juan.delacruz@email.com" required>
        </div>
      </div>

      <div class="mt-3">
        <label class="form-label">Subject</label>
        <input type="text" name="subject" class="form-control" placeholder="How can we help?" required>
      </div>

      <div class="mt-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" rows="4" placeholder="Share details to help us assist you efficiently." required></textarea>
      </div>

      <p class="small mt-2 text-muted"><em>We aim to respond to all inquiries within 1–2 business days.</em></p>
      <button type="submit" class="btn btn-hero px-4 mt-2">Send message</button>
    </form>
    <div id="formStatus" class="mt-3"></div>
  </div>
</div>


  <!-- Left Column (Contact Info) -->
  <div class="col-md-5 order-2 order-md-1">
    <div class="card contact-card mb-3 p-3 d-flex flex-row align-items-center">
      <div class="contact-icon me-3"><i class="bi bi-phone"></i></div>
      <div class="info-card">
        <h5 class="mb-1 fw-bold highlight">Mobile Number</h5>
        <p class="mb-0 text-muted">+63 936 745 0668<br>For inquiries, feel free to call or message us.</p>
      </div>
    </div>
    <div class="card contact-card mb-3 p-3 d-flex flex-row align-items-center">
      <div class="contact-icon me-3"><i class="bi bi-envelope-at"></i></div>
      <div class="info-card">
        <h5 class="mb-1 fw-bold highlight">Email Support</h5>
        <p class="mb-0 text-muted">kmc@psau.edu.ph<br>Avg. reply: Within business hours</p>
      </div>
    </div>
    <div class="card contact-card mb-3 p-3 d-flex flex-row align-items-center">
      <div class="contact-icon me-3"><i class="bi bi-geo"></i></div>
      <div class="info-card">
        <h5 class="mb-1 fw-bold highlight">Headquarters</h5>
        <p class="mb-0 text-muted">ICTRD, Pampanga State Agricultural University <br> PAC, San Agustin, Magalang, Pampanga, Philippines.</p>
      </div>
    </div>
    <div class="card contact-card mb-3 p-3 d-flex flex-row align-items-center">
      <div class="contact-icon me-3"><i class="bi bi-clock"></i></div>
      <div class="info-card">
        <h5 class="mb-1 fw-bold highlight">Office Hours</h5>
        <p class="mb-0 text-muted">Mon–Fri: 8:00 AM – 5:00 PM<br>Sat–Sun & Holidays: Closed</p>
      </div>
    </div>
  </div>
</div>

</section>

    <div class="map-container d-flex justify-content-center ">
<iframe
  width="100%"
  height="300"
  style="border:0;"
  loading="lazy"
  allowfullscreen
  referrerpolicy="no-referrer-when-downgrade"
  src="https://www.google.com/maps?q=15.2176833,120.6932849&z=14&output=embed">
</iframe>

    </div>
{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')

<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/email.js') }}"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
@endpush