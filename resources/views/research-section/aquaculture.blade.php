@extends('layouts.app')

@section('title', 'Aquaculture Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'aquaculture'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-md-12">
      <div class="bento-card h-100">

        {{-- Main Research Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-aqua.png') }}" 
              alt="Aquaculture" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Aquaculture Practices for Sustainable Fish Farming <hr></h3>
            <p>
              Aquaculture is the farming of aquatic organisms, such as fish and plants in controlled environments like ponds, tanks, or ocean enclosures. It involves the cultivation of both freshwater and marine species for commercial purposes, typically for food production.
            </p>
            <p>
              The stocking ratio in aquaculture has become an important consideration due to the increasing demand for fish as food and for other purposes. As more people seek fish for consumption and various industries utilize aquatic species, the demand for aquaculture production has surged. This heightened demand has led to a rise in the price of commercial fish diets, as the cost of quality feed increases. Consequently, managing the stocking ratio effectively is crucial to ensure sustainable fish farming practices, balancing the need for optimal growth rates while minimizing feed costs and maximizing production efficiency.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          The stocking ratio of red tilapia and giant freshwater prawn plays a significant role in determining their growth performance and survival rates in aquaculture. Maintaining an optimal stocking density ensures that both species can grow efficiently without excessive competition for resources, leading to improved health and survival rates.
        </p>
        <p>
          In terms of nutrition, velvet bean, a leguminous plant, has shown promising results when incorporated into aquaculture diets. Its nutritional and phytochemical properties have been studied for their impact on reproductive performance in both male and female fish.
        </p>
        <p>
          Velvet bean has also been linked to influencing the sex inversion rate and enhancing the growth response of fish during the grow-out phase. Furthermore, feeding velvet beans in aquaculture systems may affect the ectoparasite composition and intensity, with potential implications for fish health. Understanding these factors is essential for optimizing stocking ratios and improving overall aquaculture production while ensuring the sustainability of farming practices.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>The Aquaculture Performance of Red Tilapia and Giant Freshwater prawn as influenced by Different Stocking Ratios.</li>
          <li>Utilization of Velvet Bean as Feedstuff on the Aquaculture Performance of Red Tilapia</li>
          <li>Develop a sustainable feed development strategy</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>
            Aquaculture has become increasingly important for global food security and sustainable resources management. It must prioritize reducing its environmental footprint. It includes managing waste, minimizing the use of antibiotics and chemicals, and preventing habitat destruction. Also, it needs to look into alternative protein sources for fish feed as it is crucial for making aquaculture more sustainable.
          </li>
          <li>
            While aquaculture has enormous potential to meet the growing demand for seafood and contribute to global food security, it needs to evolve in ways that prioritize sustainability, technology, and community involvement.
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
