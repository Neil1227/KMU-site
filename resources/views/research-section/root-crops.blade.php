@extends('layouts.app')

@section('title', 'Root Crops Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'root-crops'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Main Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-rootcrops.png') }}" 
              alt="Root Crops" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>How Simple Plants Can Protect Crops and People <hr></h3>
            <p>
              The effect of different extracts on major mungbean diseases has been a subject of study, with various plant-based solutions showing potential in controlling these diseases. Additionally, the impact of different rates of plant growth promoters (PGP) on disease reactions, insect pest infestations, and the yield potential of mungbean varieties has been observed, revealing that optimal PGP application can improve both plant health and productivity.
            </p>
            <p>
              Moringa water extract, known for its medicinal properties, has also been explored for its potential benefits in crop management. Furthermore, the medicinal properties of invasive plants are being increasingly recognized, with some showing promise in treating various ailments, even as they continue to pose threats to agricultural systems.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        {{-- (No initiatives content provided in HTML, keeping section structure here in case you want to add later) --}}

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Medicinal properties of selected invasive plant species.</li>
          <li>Improvement of integrated crop management systems of mungbean.</li>
          <li>Post-harvest handling and storage of root crops.</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>
            It needs to explore more about the medicinal properties of the root crops. Also to research about the carbon sequestration potential of root crops and their role in mitigating climate change. Additionally, to have a database of medicinal properties of invasive plants for future research/study. Overall, it also needs to observe and develop on how to improve the quality of the root crops.
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
