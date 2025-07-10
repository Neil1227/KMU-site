@extends('layouts.app')

@section('title', 'Livelihood Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'livelihood'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Main Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-livelihood.png') }}" 
              alt="Livelihood" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; object-position: top; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Livelihood Sustainability <hr></h3>
            <p>
              Livelihood refers to the means or methods by which individuals or communities sustain themselves financially and support their basic needs, such as food, shelter, and clothing. It encompasses the activities, resources, and strategies people use to earn a living, whether through work, agriculture, trade, services, or other economic activities.
            </p>
            <p>
              Climate change is a widespread issue that significantly impacts ecosystems and biodiversity, leading to the disruption of natural habitats and altering species' survival. Alongside this, climate-related disasters, such as floods, droughts, and storms, can devastate communities, destroying people's economic, cultural, and social lives. These events worsen existing vulnerabilities and lead to increased poverty and food insecurity. The effectiveness of initiatives like the National Greening Program (NGP) is critical in addressing these challenges. By focusing on poverty reduction, food security, and environmental stability, NGP aims to mitigate the effects of climate change and promote sustainable development. However, its success in achieving these goals depends on effective implementation and coordination across various sectors.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          The assessment of the exposure and socio-economic effects of women agricultural entrepreneurs highlights significant challenges they face, including limited access to resources, training, and financial support, which restrict their ability to thrive in the sector. Gender disparities are especially evident in disaster management, where women often bear a disproportionate burden due to societal roles and lack of inclusion in decision-making processes. These disparities further exacerbate the vulnerability of women in agriculture during climate-related disasters.
        </p>
        <p>
          In addition, farmers have generally perceived little impact of the National Greening Program (NGP) on their overall well-being, with many reporting that it has not led to noticeable improvements in their livelihoods, food security, or environmental stability. This suggests a need for more targeted interventions and a deeper understanding of the specific challenges faced by these communities to ensure the effectiveness of such programs.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Climate Change and Environmental Sustainability</li>
          <li>Gender and Livelihood (Perceived Gender Roles of Households)</li>
          <li>Economic Impact of National Greening Program (NGP) on Poverty Alleviation and Food Security in Pampanga</li>
          <li>Household Waste Oil as a Potential Biodiesel Source</li>
          <li>Social protection and livelihood security</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>
            Building climate-resilient livelihoods is not just an environmental issue, but a critical pathway to ensuring the survival and well-being of vulnerable communities facing increasingly unpredictable weather patterns and ecosystem degradation.
          </li>
          <li>
            It is important to think both practically and sustainably when it comes to livelihood. To help communities cope with the changing weather patterns and ecosystem degradation, it needs to examine climate-resilient livelihoods, such as drought-resistant crops or sustainable fisheries management. Additionally, to address gender-sensitive livelihood, such as the strategies and policies that support women and other disadvantaged groups. Lastly, the role of social protection programs in improving security, especially during crises.
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
