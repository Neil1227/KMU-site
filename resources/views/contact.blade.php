@extends('layouts.app')

@section('title', 'Contact Us')

@push('css')

    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">

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
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2476.777044480476!2d120.69328491244967!3d15.217683326258085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396ef00529fdd05%3A0x7c6e3080efd62457!2sInformation%20Communication%20Technology%20Research%20and%20Development%20-%20PSAU!5e0!3m2!1sen!2sph!4v1750837917550!5m2!1sen!2sph"
    width="80%" 
    height="300" 
    style="border:0;" 
    allowfullscreen="" 
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
