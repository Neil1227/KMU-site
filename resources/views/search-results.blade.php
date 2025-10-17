@extends('layouts.app')

@section('title', 'KMU | Search Results')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

{{-- Search Results Section --}}
<section class="search-results text-center py-5">
  <h2 class="section-title mb-4" data-aos="fade-in">
        Search Results for: "{{ $query }}" 
    ({{ $totalResults }} found)
    <hr class="hr">
  </h2>

  @if(count($results) > 0)
    <div class="container">
      <div class="row justify-content-center">
        @foreach ($results as $result)
          <div class="col-md-8 mb-4">
            <div class="bento-card glass-effect text-start p-4">
              @php
                $query = request('query');
                $highlight = function ($text) use ($query) {
                  return $query
                    ? preg_replace('/(' . preg_quote($query, '/') . ')/i', '<mark>$1</mark>', $text)
                    : $text;
                };
              @endphp

              <h4 class="mb-2">{{$result['title']}}</h4>
              <p>{!! $highlight($result['snippet']) !!}</p>

              <a href="{{ $result['url'] }}?query={{ request('query') }}" class="btn btn-view btn-sm mt-2">View Page ⇀</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  @else
    <p class="mt-4">No results found. Please try a different search term.</p>
  @endif
</section>

{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
@endpush
