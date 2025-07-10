@extends('layouts.app')

@section('title', 'Contact Us')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('styles/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/global.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/navbar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

{{-- Floating socials --}}
<div class="floating-socials d-none" id="floatingSocials">
  <a href="https://www.facebook.com/psau.kmc" class="social-icon" target="_blank"><i class="fa-brands fa-facebook"></i></a>
  <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
  <a href="#" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
  <a href="#" class="social-icon"><i class="fas fa-envelope"></i></a>
</div>

{{-- Google Map --}}
<div class="map-container d-flex justify-content-center py-5">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!..." 
    width="80%" 
    height="300" 
    style="border:0;" 
    allowfullscreen 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>

{{-- Contact Section --}}
<section class="contact text-center">
  <h2 class="text-center mb-4 section-title" data-aos="fade-up">
    Contact us
    <hr class="hr">
  </h2>

  <div class="comment-section">
    <h3 class="mb-4">Leave a Comment</h3>
    <form class="comment-form" id="commentForm">
      <input type="text" id="name" placeholder="Your Name" required />
      <textarea id="comment" placeholder="Your Comment" rows="4" required></textarea>
      <button type="submit">Submit</button>
    </form>
    <div id="commentList" class="comment-list"></div>
  </div>
</section>

{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('message.js') }}"></script>
<script src="{{ asset('assets/js/navbar.js') }}"></script>
<script>
    AOS.init();
</script>
@endpush
