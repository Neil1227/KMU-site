@extends('layouts.app')

@section('title', 'Search Results')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<style>
  a.btn-view {
  background-color: var(--primary-color);
  color: white;
  border: none;
}

a.btn-view:hover {
  background-color: var(--secondary-color);
  color: white;
}
.bento-card {
  background: rgba(255, 255, 255, 0.15); /* glass effect base */
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border-radius: 20px;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bento-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);
}

.bento-card h4 {
  font-weight: 600;
  color: var(--primary-color);
}

.bento-card p {
  color: #333;
  opacity: 0.85;
}

</style>
@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

{{-- Search Results Section --}}
<section class="search-results text-center py-5">
  <h2 class="section-title mb-4" data-aos="fade-up">
    Search Results for: "{{ request('query') }}"
    <hr class="hr">
  </h2>

  @if(count($results) > 0)
    <div class="container">
      <div class="row justify-content-center">
        @foreach ($results as $result)
          <div class="col-md-8 mb-4">
            <div class="bento-card glass-effect text-start p-4">
              <h4 class="mb-2">{{ $result['title'] }}</h4>
              <p>{{ $result['snippet'] }}</p>
              <a href="{{ $result['url'] }}" class="btn btn-view btn-sm mt-2">View Page ⇀</a>
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
