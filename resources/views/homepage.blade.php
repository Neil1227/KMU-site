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


@section('content')

    {{-- Header --}}
    @include('layouts.components.header')

    {{-- Navbar --}}
    @include('layouts.components.navbar')

    <section id="hero-section" class="hero-section">
        <div class="container-hero" data-aos="fade-in" data-aos-duration="2000">
            <div class="hero-row">

                <!-- Left Text Content -->
                <div class="hero-text">
                    <h1 class="hero-title"><span class="hero-initial">K</span>nowledge <br> <span
                            class="hero-initial">M</span>anagement
                        <span class="hero-initial">U</span>nit
                    </h1>
                    <p class="hero-subtitle">
                        Advancing institutional innovation by acquiring, promoting, and sharing knowledge through strategic
                        communication and collaboration with the Information Communication
                        Technology - Research and Development or ICT-RD.
                    </p>



                    <div class="hero-buttons">
                        <a href="{{ route('ip.registered') }}" class="btn btn-hero mb-1"><span class="counter"
                                data-target="{{ $ipAppliedCount }}">0</span> IP Applied ⇀</a>
                    </div>

                    <div class="hero-stats">
                        {{-- <div class="clickable">
                            <a href="{{ route('ip.registered') }}">
                                <strong><span class="counter" data-target="{{ $ipAppliedCount }}">0</span></strong><br>
                                IP Applied
                            </a>


                        </div> --}}
                        <div><strong><span class="highlight counter" data-target="400">0</span>+</strong><br>Plagiarism
                            Certificates</div>
                        <div><strong><span class="highlight counter" data-target="621">0</span>+</strong><br>Satisfied
                            Clients</div>
                        <div><strong><span class="highlight counter" data-target="10">0</span>+</strong><br>Years Experience
                        </div>
                    </div>

                </div>

                <!-- Right Video -->
                <div class="video-banner">
                    <video autoplay muted loop playsinline preload="auto">
                        <source src="{{ asset('assets/videos/compressed_homebanner.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

            </div>
        </div>
    </section>

    <!-- Media Resources -->
    <section id="media-resources" class="py-5">
        <h2 class="text-center mb-2 section-title">
            Media <span class="title-highlight">Resources</span>
            <hr class="hr">
        </h2>

        <div class="container-page">
            <div class="row d-flex justify-content-start">
                <!-- Updates Card -->
                <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="100">
                    <a href="	{{ route('updates.index') }}" class="text-decoration-none">
                        <div class="card text-center media-card">
                            <div class="position-relative">
                                <img src="{{ asset('assets/img/media_thumbnail/updates.jpg') }}"
                                    class="card-img-top media-img" alt="ICTV">
                                <div class="media-overlay">See more ⇀</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Updates</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- ICTV Card -->
                <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="100">
                    <a href="	{{ route('ictv') }}" class="text-decoration-none">
                        <div class="card text-center media-card">
                            <div class="position-relative">
                                <picture>
                                    <source srcset="{{ asset('assets/img/media_thumbnail/media_ictv.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('assets/img/media_thumbnail/media_ictv.png') }}"
                                        class="card-img-top media-img" alt="ICTV">
                                </picture>
                                <div class="media-overlay">See more ⇀</div>
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
                                    <source srcset="{{ asset('assets/img/media_thumbnail/media_iec.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('assets/img/media_thumbnail/media_iec.png') }}"
                                        class="card-img-top media-img" alt="IEC Materials">
                                </picture>
                                <div class="media-overlay">See more ⇀</div>
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
                                    <source srcset="{{ asset('assets/img/media_thumbnail/media_modules.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('assets/img/media_thumbnail/media_modules.png') }}"
                                        class="card-img-top media-img" alt="Modules">
                                </picture>
                                <div class="media-overlay">See more ⇀</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Modules</h5>
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
                                    <source srcset="{{ asset('assets/img/media_thumbnail/media_news.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('assets/img/media_thumbnail/media_news.png') }}"
                                        class="card-img-top media-img" alt="Newsletter">
                                </picture>
                                <div class="media-overlay">See more ⇀</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Newsletters</h5>
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
                                    <source srcset="{{ asset('assets/img/media_thumbnail/media_techprof.webp') }}"
                                        type="image/webp">
                                    <img src="{{ asset('assets/img/media_thumbnail/media_techprof.png') }}"
                                        class="card-img-top media-img" alt="Tech Portfolio">
                                </picture>
                                <div class="media-overlay">See more ⇀</div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Tech Portfolio</h5>
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
        <h2 class="text-center section-title mb-2" data-aos="fade-up">
            <span class="title-highlight">Research</span>
            <hr class="hr">
        </h2>

        <div class="container-page">
            <div class="row g-0">
                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="900" data-aos-duration="1000">
                    <a href="{{ url('agriculture') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-agri.png') }}"
                                    alt="Agriculture" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Agriculture</h5>
                                    <p class="card-texts">Study on sustainable agricultural practices.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="600" data-aos-duration="1000">
                    <a href="{{ url('aquaculture') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-aqua.png') }}"
                                    alt="Aquaculture" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Aquaculture</h5>
                                    <p class="card-texts">Research on aquaculture development and sustainability.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="300" data-aos-duration="1000">
                    <a href="{{ url('livestock') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-livestock.png') }}"
                                    alt="Livestock" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Livestock</h5>
                                    <p class="card-texts">Innovative practices for livestock farming.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="700" data-aos-duration="1000">
                    <a href="{{ url('livelihood') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-livelihood.png') }}"
                                    alt="Livelihood" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Livelihood</h5>
                                    <p class="card-texts">Projects aimed at improving rural livelihoods.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="200" data-aos-duration="1000">
                    <a href="{{ url('biotechnology') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-biotechnology.png') }}"
                                    alt="Biotechnology" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Biotechnology</h5>
                                    <p class="card-texts">Advancements in genetic engineering and medicine.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="800" data-aos-duration="1000">
                    <a href="{{ url('root-crops') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-rootcrops.png') }}"
                                    alt="Root Crops" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Root Crops</h5>
                                    <p class="card-texts">Exploration of root crops for food security.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="300" data-aos-duration="1000">
                    <a href="{{ url('iot') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-iot.png') }}"
                                    alt="Internet of Things" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Internet of Things</h5>
                                    <p class="card-texts">Using IoT for precision agriculture and research.</p>
                                    <span class="read-more">Read more ⇀</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 p-2 d-flex" data-aos="fade-in" data-aos-delay="400" data-aos-duration="1000">
                    <a href="{{ url('others') }}" class="text-decoration-none w-100 h-100">
                        <div class="new_research-card h-100">
                            <div class="d-flex flex-column flex-md-row h-100">
                                <img src="{{ asset('assets/img/research_thumbnails/reseach-icon-others.png') }}"
                                    alt="Others" loading="lazy" class="icon-img-research" />
                                <div class="card-body">
                                    <h5 class="card-title">Others</h5>
                                    <p class="card-texts">Exploring emerging research topics and innovations.</p>
                                    <span class="read-more">Read more ⇀</span>
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
            Sustainable <span class="title-highlight">Development Goals (SDG)</span>
            <hr class="hr">
        </h2>

        <div class="container-page">
            <div class="row g-2 justify-content-center">
                @for ($i = 1; $i <= 17; $i++)
                    <div class="col-md-2 mb-2 mx-1" data-aos="zoom-in"
                        data-aos-delay="{{ 100 + floor(($i - 1) / 4) * 100 }}">
                        <a href="{{ url('/sdgs#sdg' . $i) }}" class="text-decoration-none">
                            <div class="card sdg-card">
                                <img src="{{ asset('assets/img/sdgs/' . $i . '.png') }}" alt="SDG {{ $i }}"
                                    loading="lazy" class="background-img-sdg">
                            </div>
                        </a>
                    </div>
                @endfor

                <!-- Final SDGs Banner Card -->
                <div class="col-md-2 mb-2 mx-1" data-aos="zoom-in" data-aos-duration="1700">
                    <a href="{{ url('/sdgs#sdgs') }}" class="text-decoration-none">
                        <div class="card sdg-card">
                            <img src="{{ asset('assets/img/sdgs/SDGS-banner.png') }}" alt="SDG Banner" loading="lazy"
                                class="background-img-sdg">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- the issue is the research_section -->
    @include('layouts.components.footer')

    @push('scripts')
        <script src="{{ asset('js/navbar.js') }}"></script>
        <!-- counter for the hero -->
        <script src="{{ asset('js/counter.js') }}"></script>
    @endpush
@endsection
