@extends('layouts.app')

@section('title', 'Other Research Areas')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'others'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Main Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-others.png') }}" 
              alt="Other Research" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Helping Local Communities Recover and Thrive <hr></h3>
            <p>
              Commercially available stoves for briquettes are often not suitable for the biomass briquettes produced at PSAU. Additionally, the COVID-19 pandemic had a significant impact on the ecotourism sector in the SPCW, leading to a decline in visitor numbers, disruption of local livelihoods, and a negative effect on environmental sustainability.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          The stove designed for biomass briquettes highlights the need for public-private partnerships and emphasizes the importance of continuous monitoring and evaluation to ensure the long-term sustainability of the SPCW's ecotourism sector. This collaborative approach is essential for maintaining the balance between economic development, environmental protection, and local community benefits.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Proposed Fabrication and Performance Evaluation of PSAU Briquette Stove.</li>
          <li>Drawing Lessons from the COVID-19 Pandemic and Charting a Way Forward for Ecotourism Policy.</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>There are other studies that need to be explored and developed. With this, other researchable areas are highly recommended.</li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
