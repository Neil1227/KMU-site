@extends('layouts.app')

@section('title', 'KMU | About Us')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

{{-- Contact Section --}}


<!-- About Section -->
<section id="about" class="py-5 about-section">
  <div class="about-section py-5" data-aos="fade-up">
    <div class="container text-center">
      <h2 class="section-title text-center mb-3">
        What is <span class="title-highlight">Knowledge Management Unit?</span>
      </h2>

      <div class="about-content d-flex flex-column flex-md-row align-items-center text-start gap-4 mb-5">
        <img src="assets/img/kmlogo.png" alt="Kamp Maalam Logo" class="about-logo" style="max-width: 120px; height: auto; ">

        <p class="subtitle m-0">
          The <strong>Knowledge Management</strong> <em>(KM)</em> unit operates to foster an environment where knowledge resources
          are acquired, promoted, and shared in alignment with quality assurance standards, supporting the continuous
          improvement and accessibility of the information it handles. By establishing a centralized framework,
          it creates space and best practices for knowledge sharing activities, making knowledge-based assets
          accessible to all.
        </p>
      </div>

      <div class="mission-box p-4 rounded">
        <h4 class="text-white mb-3">Our Mission</h4>
        <p class="text-white mb-0">
          <strong><em>Kamp Maalam</em> </strong>is an initiative of KM's knowledge-sharing activities. It seeks to modernize practices by
          leveraging available resources and expanding its reach to a broader audience. The ultimate goal is to
          foster a community where knowledge is shared, nurtured, and grows.
        </p>
      </div>
    </div>
  </div>

  <div class="team-section">
    <h2 class="section-title text-center mb-5">Meet Our <span class="title-highlight">Team</span> </h2>
    <div class="team-container">
      <div class="team-card active">
        <img src="{{ asset('assets/img/about/21.png') }}" alt="Walter Pacunana">
        <h4 class="highlight">Dir. Walter Pacunana</h4>
        <p class="role">Director of Office of Innovation</p>
        <p class="desc">Visionary leader with 15+ years in strategic business development.</p>
      </div>
      <div class="team-card">
        <img src="{{ asset('assets/img/about/26.png') }}" alt="Allen Mark Demapanag">
        <h4 class="highlight">Allen Mark Demapanag</h4>
        <p class="role">Project Technical Assistant I</p>
        <p class="desc">Tech innovator passionate about scalable solutions and emerging technologies.</p>
      </div>
      <div class="team-card">
        <img src="{{ asset('assets/img/about/2.png') }}" alt="Alexandra Gumba">
        <h4 class="highlight">Alexandra Gumba</h4>
        <p class="role">Technical staff</p>
        <p class="desc">Conducts plagiarism screening and determines the study’s potential for technological or research development.  </p>
      </div>
      <div class="team-card">
        <img src="{{ asset('assets/img/about/4.png') }}" alt="Neil Patrick Acierto">
        <h4 class="highlight">Neil Patrick Acierto</h4>
        <p class="role">Technical staff</p>
        <p class="desc">Responsible for developing responsive web solutions and centralizing the KMU office’s data for efficient access and management.</p>
      </div>
    </div>
  </div>

  <div class="values-section">
    <h2 class="section-title text-center mb-5">Our <span class="title-highlight">Objectives</span></h2>
    <div class="values-container">
      <div class="value-card">
        <div class="value-icon"><i class="fas fa-circle-down fs-4"></i></div>
        <div class="value-title highlight">Aquire</div>
        <div class="value-desc">Aquire and organize Knowledge resources created by university stakeholders to be come purposeful assets of PSAU.</div>
      </div>
      <div class="value-card">
        <div class="value-icon"><i class="fas fa-check-circle fs-4"></i></div>
        <div class="value-title highlight">Promote</div>
        <div class="value-desc">Create space and best practice for knowledge sharing activities, making knowledge-based assets accessible to all.</div>
      </div>
      <div class="value-card">
        <div class="value-icon"><i class="fas fa-users fs-4"></i></div>
        <div class="value-title highlight">Share</div>
        <div class="value-desc">Ensure knowledge resources are acquiescent to existing quality assurance rules and regulations.</div>
      </div>
    </div>
  </div>

</section>
{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')

<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/email.js') }}"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="{{ asset('js/map.js') }}"></script>
@endpush