@extends('layouts.app')

@section('title', 'Agriculture Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'agriculture'])

{{-- Page Content --}}
<div class="container-page py-5">
  {{-- Card Section --}}
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-agri.png') }}" 
              alt="Modern agriculture" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Modern Agricultural Challenges <hr></h3>
            <p>
              Agriculture refers to the cultivation of crops and the raising of animals to provide essential products such as food, fiber, and fuel. It plays a fundamental role in sustaining human life and the global economy. However, modern agriculture faces numerous challenges including climate change, soil degradation, water scarcity, and pest infestations.
            </p>
            <p>
              Current agricultural challenges include under-utilization of natural resources, crop mismanagement, and wasteful practices. The misuse of chemical fertilizers and pesticides also contributes to long-term ecological damage and health risks. Farmers need support to transition toward more sustainable and scientifically guided practices.
            </p>
          </div>
        </div>

        <h3>Initiatives <hr></h3>
        <p>
          Addressing these challenges requires innovative solutions and research-backed practices. Various institutions and local communities are working together to introduce sustainable technologies, educate farmers, and promote integrated systems. Examples include crop rotation, organic farming, and precision agriculture using sensors and data analytics.
        </p>

        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Develop innovative pest management strategies, particularly for the Golden Apple Snail.</li>
          <li>Enhance science-based production management strategies for agriculture.</li>
          <li>Explore bamboo's full potential as a sustainable resource in agriculture and rural development.</li>
          <li>Promote climate-resilient farming practices to mitigate the impact of extreme weather conditions.</li>
          <li>Study the use of renewable energy sources in agricultural operations such as solar irrigation systems.</li>
          <li>Integrate agroforestry techniques in rural farming landscapes to improve productivity and biodiversity.</li>
        </ul>

        <h3>Recommendations <hr></h3>
        <ul>
          <li>Adopt modern agricultural technologies such as remote sensing, GIS, and AI-based farm planning tools.</li>
          <li>Invest in farmer education programs focused on sustainable land management and responsible fertilizer use.</li>
          <li>Focus on innovative uses of agricultural waste such as composting, biogas generation, and biochar production.</li>
          <li>Encourage policy support for small-scale farmers to access credit, insurance, and markets.</li>
          <li>Strengthen public-private partnerships in research and extension services to drive innovation on the ground.</li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
