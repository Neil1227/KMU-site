@extends('layouts.app')

@section('title', 'Biotechnology Research')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

@include('layouts.components.generic-background')

{{-- Navbar --}}
@include('layouts.components.header')
@include('layouts.components.research-navbar', ['active' => 'biotechnology'])

{{-- Page Content --}}
<div class="container-page py-5">
  <div class="row g-4 mb-4">
    <div class="col-12">
      <div class="bento-card h-100">

        {{-- Research Card --}}
        <div class="research-card">
          <div class="research-image">
            <img 
              src="{{ asset('assets/img/research_thumbnails/reseach-icon-biotechnology.png') }}" 
              alt="Biotechnology" 
              loading="lazy"
              width="100%" height="auto"
              style="display: block; object-fit: cover; border-radius: 10px;"
            >
          </div>
          <div class="research-text">
            <h3>Using Biotechnology to Make Tamarind Farming Simpler and Smarter <hr></h3>
            <p>
              Sour and Aglibut sweet tamarind are difficult to distinguish, especially when they are seedlings. At this early stage, both varieties appear quite similar, making it challenging to tell them apart. The differences between them become more apparent as they mature, with the sour tamarind exhibiting a more tangy flavor and the Aglibut sweet tamarind developing a milder, sweeter taste. However, in their seedling form, their characteristics are not yet fully developed, contributing to the confusion in identifying them.
            </p>
          </div>
        </div>

        {{-- Initiatives --}}
        <h3>Initiatives <hr></h3>
        <p>
          DNA barcoding using the matK and QR codes for Sour and Sweet Tamarind seedlings is an innovative method to distinguish between the two tamarind varieties at an early developmental stage. The matK gene, a commonly used marker in plant DNA barcoding, is selected for its ability to provide unique genetic identifiers that are consistent within species and can differentiate closely related varieties.
        </p>
        <p>
          By extracting DNA from the seedlings and sequencing the matK region, researchers can create a genetic barcode for both Sour and Sweet Tamarind. This barcode is then encoded into a QR code, which can be scanned to quickly access genetic information about the plant, facilitating efficient identification and classification. This approach not only simplifies the process of distinguishing between these two varieties but also promotes a more precise and accessible method for plant research and conservation.
        </p>

        {{-- R4D Thrusts and Priorities --}}
        <h3>R4D Thrusts and Priorities <hr></h3>
        <ul>
          <li>Molecular Phylogenetics of Sour and Sweet Tamarind using matK DNA marker</li>
          <li>Agricultural biotechnology and food security</li>
          <li>Develop medical treatments</li>
        </ul>

        {{-- Recommendations --}}
        <h3>Recommendations <hr></h3>
        <ul>
          <li>
            There are several possibilities for enhancing crop production, improving sustainability, and addressing challenges when it comes to biotechnology—especially in the context of agriculture and plant breeding.
          </li>
          <li>
            Breeding tamarind in both physical traits and genetic data will be able to identify the differences and right taste of the tamarind. Physical traits can be affected by the environment, so combining them with the DNA analysis gives a cleaner, more reliable picture of the plant’s qualities. Additionally, using additional DNA markers will enhance the discriminatory power in tamarind identification.
          </li>
          <li>
            Overall, biotechnology has the potential to transform tamarind farming and many agricultural practices by integrating advanced genetic tools, sustainable practices, and data-driven approaches. We can improve plant varieties, reduce environmental impact, and increase food security for the future.
          </li>
        </ul>

      </div>
    </div>
  </div>
</div>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
