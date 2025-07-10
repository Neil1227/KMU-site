@extends('layouts.app')

@section('title', 'Livestock Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'livestock'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Main Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-livestock.png') }}" 
              alt="Livestock" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Livestock Health Research & Innovation <hr></h3>
            <p>
              It is important to think both practically and sustainably when it comes to livelihood. To help communities cope with changing weather patterns and ecosystem degradation, it needs to examine climate-resilient livelihoods, such as drought-resistant livestock practices and efficient animal health strategies.
            </p>
            <p>
              Additionally, to address gender-sensitive livelihood, such as strategies and policies that support women and other disadvantaged groups. Lastly, the role of social protection programs in improving security, especially during crises.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          It aimed to detect Porcine Epidemic Diarrhea Virus (PEDV) among native pigs in Pampanga using the RT-PCR assay. Findings from trials involving native pigs showed that a mix of corn and roasted soybean, as well as corn and fermented soybean, resulted in better average daily gain and improved feed efficiency.
        </p>
        <p>
          Another aspect of the study focused on the gastrointestinal and respiratory conditions of BT-black native pigs, comparing those fed fermented versus unfermented soybean. This helped in identifying gut resilience, disease resistance, and nutrient absorption efficiency.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Native pigs production</li>
          <li>Animal health and disease control</li>
          <li>Sustainable livestock production</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>
            Developing more effective vitamins or vaccines, and establishing a disease monitoring system in livestock to detect and control outbreaks early. There is a need to improve diagnostics and tracking technologies. Additionally, livestock production can also improve feed efficiency and explore alternative feed ingredients for optimal growth and sustainability.
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
