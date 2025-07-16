@extends('layouts.app')

@section('title', 'Home')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/research.css') }}">

<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/research_section.css') }}">

@endpush
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

@section('content')
<section id="video-hero" data-aos="fade-down" data-aos-duration="1500">
<div class="video-banner" data-aos="fade-down" data-aos-duration="1500">
  <video autoplay muted loop playsinline preload="auto">
    <source src="{{ asset('assets/videos/compressed_homebanner.mp4') }}" type="video/mp4">
    Your browser does not support the video tag.
  </video>
  <div class="video-overlay">
    <div class="video-content">
    <a href="#media-resources" class="explore-btn">
      Explore <span class="arrow">&#8595;</span>
    </a>
    </div>
  </div>
</div>
</section>




<!-- KMU Cards (Insert Here) -->
<section class="kmu-section mt-4">
  <div class="absolute-cards-container">
    <div class="card-box transparent-card" data-aos="fade-right" data-aos-duration="1500">
      <i class="fa-solid fa-magnifying-glass card-icon"></i>
      <h5 class="text-white">Acquiring</h5>
      <p><em>Learn. Discover. Collect.</em></p>
    </div>
    <div class="card-box primary-card" data-aos="fade-up" data-aos-duration="1500">
      <i class="fa-solid fa-bullhorn card-icon"></i>
      <h5 class="text-white">Promoting</h5>
      <p><em>Highlight. Inspire. Engage.</em></p>
    </div>
    <div class="card-box secondary-card" data-aos="fade-left" data-aos-duration="1500">
      <i class="fa-solid fa-share-nodes card-icon"></i>
      <h5 class="text-white">Sharing</h5>
      <p><em>Spread. Connect. Empower.</em></p>
    </div>
  </div>
</section>
<!-- Media Resources -->
<section id="media-resources" class="py-5">
  <h2 class="text-center mb-4 section-title">
    Media Resources
    <hr class="hr">
  </h2>

  <div class="container-page">
    <div class="row">
      <!-- ICTV Card -->
      <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="100">
        <a href="	{{ route('ictv') }}" class="text-decoration-none">
          <div class="card text-center media-card">
            <div class="position-relative">
              <picture>
                <source srcset="{{ asset('assets/img/media_thumbnail/media_ictv.webp') }}" type="image/webp">
                <img src="{{ asset('assets/img/media_thumbnail/media_ictv.png') }}" class="card-img-top media-img" alt="ICTV">
              </picture>
              <div class="media-overlay">See more →</div>
            </div>
            <div class="card-body">
              <h5 class="card-title">ICTV</h5>
            </div>
          </div>
        </a>
      </div>

      <!-- IEC Materials Card -->
      <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="200">
        <a href="	{{ route('iec') }}" class="text-decoration-none">
          <div class="card text-center media-card">
            <div class="position-relative">
              <picture>
                <source srcset="{{ asset('assets/img/media_thumbnail/media_iec.webp') }}" type="image/webp">
                <img src="{{ asset('assets/img/media_thumbnail/media_iec.png') }}" class="card-img-top media-img" alt="IEC Materials">
              </picture>
              <div class="media-overlay">See more →</div>
            </div>
            <div class="card-body">
              <h5 class="card-title">IEC Materials</h5>
            </div>
          </div>
        </a>
      </div>

      <!-- MODULES Card -->
      <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="300">
        <a href="	{{ route('modules') }}" class="text-decoration-none">
          <div class="card text-center media-card">
            <div class="position-relative">
              <picture>
                <source srcset="{{ asset('assets/img/media_thumbnail/media_modules.webp') }}" type="image/webp">
                <img src="{{ asset('assets/img/media_thumbnail/media_modules.png') }}" class="card-img-top media-img" alt="Modules">
              </picture>
              <div class="media-overlay">See more →</div>
            </div>
            <div class="card-body">
              <h5 class="card-title">MODULES</h5>
            </div>
          </div>
        </a>
      </div>

      <!-- NEWSLETTER Card -->
      <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="400">
        <a href="	{{ route('newsletter') }}" class="text-decoration-none">
          <div class="card text-center media-card">
            <div class="position-relative">
              <picture>
                <source srcset="{{ asset('assets/img/media_thumbnail/media_news.webp') }}" type="image/webp">
                <img src="{{ asset('assets/img/media_thumbnail/media_news.png') }}" class="card-img-top media-img" alt="Newsletter">
              </picture>
              <div class="media-overlay">See more →</div>
            </div>
            <div class="card-body">
              <h5 class="card-title">NEWS LETTER</h5>
            </div>
          </div>
        </a>
      </div>

      <!-- TECH PORTFOLIO Card -->
      <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="500">
        <a href="	{{ route('tech-portfolio') }}" class="text-decoration-none">
          <div class="card text-center media-card">
            <div class="position-relative">
              <picture>
                <source srcset="{{ asset('assets/img/media_thumbnail/media_techprof.webp') }}" type="image/webp">
                <img src="{{ asset('assets/img/media_thumbnail/media_techprof.png') }}" class="card-img-top media-img" alt="Tech Portfolio">
              </picture>
              <div class="media-overlay">See more →</div>
            </div>
            <div class="card-body">
              <h5 class="card-title">TECH PORTFOLIO</h5>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Research Section -->
<section id="research" class="py-5">
  <!-- Title with Gray icon and Centered -->
  <h2 class="text-center section-title mb-4" data-aos="fade-up">
    Research
    <hr class="hr">
  </h2>

  <div class="container-page">
    <div class="row g-0">

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="900" data-aos-duration="1000">
        <a href="{{ url('agriculture') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-agri.png') }}" alt="Agriculture" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Agriculture</h5>
                <p class="card-texts">Study on sustainable agricultural practices.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="600" data-aos-duration="1000">
        <a href="{{ url('aquaculture') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-aqua.png') }}" alt="Aquaculture" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Aquaculture</h5>
                <p class="card-texts">Research on aquaculture development and sustainability.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="300" data-aos-duration="1000">
        <a href="{{ url('livestock') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-livestock.png') }}" alt="Livestock" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Livestock</h5>
                <p class="card-texts">Innovative practices for livestock farming.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="700" data-aos-duration="1000">
        <a href="{{ url('livelihood') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-livelihood.png') }}" alt="Livelihood" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Livelihood</h5>
                <p class="card-texts">Projects aimed at improving rural livelihoods.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
        <a href="{{ url('biotechnology') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-biotechnology.png') }}" alt="Biotechnology" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Biotechnology</h5>
                <p class="card-texts">Advancements in genetic engineering and medicine.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="800" data-aos-duration="1000">
        <a href="{{ url('root-crops') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-rootcrops.png') }}" alt="Root Crops" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Root Crops</h5>
                <p class="card-texts">Exploration of root crops for food security.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="300" data-aos-duration="1000">
        <a href="{{ url('iot') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-iot.png') }}" alt="Internet of Things" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Internet of Things</h5>
                <p class="card-texts">Using IoT for precision agriculture and research.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

      <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="400" data-aos-duration="1000">
        <a href="{{ url('others') }}" class="text-decoration-none w-100 h-100">
          <div class="new_research-card h-100">
            <div class="d-flex flex-column flex-md-row h-100">
              <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-others.png') }}" alt="Others" loading="lazy" class="icon-img-research" />
              <div class="card-body">
                <h5 class="card-title">Others</h5>
                <p class="card-texts">Exploring emerging research topics and innovations.</p>
                <span class="read-more">Read more →</span>
              </div>
            </div>
          </div>
        </a>
      </div>

    </div>
  </div>

</section>

<!-- SDGs Section -->
<section id="sdgs" class="py-5">
  <!-- Title -->
  <h2 class="text-center section-title mb-5" data-aos="fade-down" data-aos-duration="800">
    Sustainable Development Goals (SDG)
    <hr class="hr">
  </h2>

  <div class="container-page">
    <div class="row g-4 justify-content-center">
      @for ($i = 1; $i <= 17; $i++)
        <div class="col-md-3 mb-4"
        data-aos="zoom-in"
        data-aos-delay="{{ 100 + floor(($i - 1) / 4) * 100 }}">
        <a href="{{ url('/sdgs#sdg' . $i) }}" class="text-decoration-none">
          <div class="card sdg-card">
            <img src="{{ asset('assets/img/sdgs/' . $i . '.png') }}"
              alt="SDG {{ $i }}"
              loading="lazy"
              class="background-img-sdg">
          </div>
        </a>
    </div>
    @endfor

    <!-- Final SDGs Banner Card -->
    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="700">
      <a href="{{ url('/sdgs#sdgs') }}" class="text-decoration-none">
        <div class="card sdg-card">
          <img src="{{ asset('assets/img/sdgs/SDGS-banner.png') }}"
            alt="SDG Banner"
            loading="lazy"
            class="background-img-sdg">
        </div>
      </a>
    </div>
  </div>
  </div>
</section>


</section>


<!-- About Section -->
<section id="about" class="py-5 about-section">
  <h2 class="section-title text-center mb-5" data-aos="fade-up">About Us

    <hr class="hr">
  </h2>

  <div class="row align-items-center">
    <div class="container-page">
      <!-- Left Column: Text -->
      <div class="left-col mb-5" data-aos="fade-right">
        <div class="about-box p-3 d-flex align-items-start gap-3 flex-md-row flex-column">
          <img src="assets/img/kmlogo.png" alt="Kamp Maalam Logo" class="about-logo" style="max-width: 100px; height: auto;">
          <p class="mb-0">
            The <strong>Knowledge Management</strong> <em>(KM)</em> unit operates to foster an environment where knowledge resources
            are acquired, promoted, and shared in alignment with quality assurance standards, supporting the continuous
            improvement and accessibility of the information it handles. By establishing a centralized framework,
            it creates space and best practices for knowledge sharing activities, making knowledge-based assets
            accessible to all.
          </p>
        </div>
      </div>


      <!-- Right Column: Text + Logo -->
      <div class="right-col mb-4" data-aos="fade-left">
        <div class="about-box p-3 text-center">
          <p>
            <strong><em>Kamp Maalam</em> </strong>is an initiative of KM's knowledge-sharing activities. It seeks to modernize practices by
            leveraging available resources and expanding its reach to a broader audience. The ultimate goal is to
            foster a community where knowledge is shared, nurtured, and grows.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- the issue is the research_section -->
@include('layouts.components.footer')
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.absolute-cards-container .card-box');
    let current = 0;

    function cycleZoom() {
      cards.forEach(card => card.classList.remove('zoom-effect'));
      cards[current].classList.add('zoom-effect');

      current = (current + 1) % cards.length;
    }

    cycleZoom(); // initial run
    setInterval(cycleZoom, 2500); // run every 2.5 seconds
  });
</script>

<script src="{{ asset('js/navbar.js') }}"></script>
@endpush
@endsection