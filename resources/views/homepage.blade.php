@extends('layouts.app')

@section('title', 'Home')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research_section.css') }}">
@endpush


@section('home')
    <section class="video-banner" data-aos="fade-down" data-aos-duration="1500">
        <video autoplay muted loop playsinline preload="auto" width="80%" height="300" style="border: 0;">
          <source src="{{ asset('assets/videos/compressed_homebanner.mp4') }}" type="video/mp4">

        Your browser does not support the video tag.
      </video>
        <div class="video-overlay"></div>
    </section>

    <!-- Media Resources -->
    <section id="media-resources" class="py-5">
        <h2 class="text-center mb-4 section-title" data-aos="fade-up">
            Media Resources
        <hr class="hr">
        </h2>

        <div class="container-page">
            <div class="row">
              <!-- ICTV Card -->
              <div class="col-md-4 mb-4 media-container" data-aos="zoom-in" data-aos-delay="100">
                  <a href="ictv.html" class="text-decoration-none">
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
                  <a href="iec.html" class="text-decoration-none">
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
                  <a href="modules.html" class="text-decoration-none">
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
                  <a href="newsletter.html" class="text-decoration-none">
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
                  <a href="tech portfolio.html" class="text-decoration-none">
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

                <div class="container">
                    <div class="row g-0">
            <div class="col-md-3 p-2 d-flex " style="border: none;">
              <a href="agriculture.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-agri.png" alt="Agriculture" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Agriculture</h5>
                      <p class="card-texts">Study on sustainable agricultural practices.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="aquaculture.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-aqua.png" alt="Aquaculture" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Aquaculture</h5>
                      <p class="card-texts">Research on aquaculture development and sustainability.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="livestock.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-livestock.png" alt="Livestock" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Livestock</h5>
                      <p class="card-texts">Innovative practices for livestock farming.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="livelihood.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-livelihood.png" alt="Livelihood" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Livelihood</h5>
                      <p class="card-texts">Projects aimed at improving rural livelihoods.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="biotechnology.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-biotechnology.png" alt="Biotechnology" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Biotechnology</h5>
                      <p class="card-texts">Advancements in genetic engineering and medicine.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="root-crops.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-rootcrops.png" alt="Root Crops" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Root Crops</h5>
                      <p class="card-texts">Exploration of root crops for food security.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="iot.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-iot.png" alt="Internet of Things" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Internet of Things</h5>
                      <p class="card-texts">Using IoT for precision agriculture and research.</p>
                      <span class="read-more">Read more →</span>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-md-3 p-2 d-flex">
              <a href="others.html" class="text-decoration-none w-100 h-100">
                <div class="new_research-card h-100">
                  <div class="d-flex flex-column flex-md-row h-100">
                    <img src="./assets/img/research_thumbnails/reseach-icon-others.png" alt="Others" loading="lazy" class="icon-img-research" />
                    <div class="card-body">
                      <h5 class="card-title">Others</h5>
                      <p class="card-texts">Exploring emerging research topics and  innovations.</p>
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
            <h2 class="text-center section-title mb-5"  data-aos="fade-down" data-aos-duration="800">
                Sustainable Development Goals (SDG)
            <hr class="hr">
            </h2>
        
        <div class="container-page">
            <!-- SDG Grid -->
            <div class="row g-4 justify-content-center">
                <!-- Example of one card -->
        <!-- SDG Cards -->
                    <!-- Add animation to each card with staggered delays -->

                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <a href="./sdg.html#sdg1" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/1.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <a href="./sdg.html#sdg2" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/2.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <a href="./sdg.html#sdg3" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/3.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="100">
                        <a href="./sdg.html#sdg4" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/4.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="400">
                        <a href="./sdg.html#sdg5" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/5.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="400">
                        <a href="./sdg.html#sdg6" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/6.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="400">
                        <a href="./sdg.html#sdg7" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/7.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="400">
                        <a href="./sdg.html#sdg8" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/8.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="500">
                        <a href="./sdg.html#sdg9" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/9.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="500">
                        <a href="./sdg.html#sdg10" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/10.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="500">
                        <a href="./sdg.html#sdg11" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/11.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="500">
                        <a href="./sdg.html#sdg12" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/12.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="600">
                        <a href="./sdg.html#sdg13" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/13.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="600">
                        <a href="./sdg.html#sdg14" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/14.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="600">
                        <a href="./sdg.html#sdg15" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/15.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="600">
                        <a href="./sdg.html#sdg16" class="text-decoration-none">
                            <div class="card sdg-card">
                    
                            <img src="./assets/img/sdgs/16.png" alt="Image" loading="lazy" class="background-img-sdg">
                    
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="700">
                        <a href="./sdg.html#sdg17" class="text-decoration-none">
                            <div class="card sdg-card">
                                <img src="./assets/img/sdgs/17.png" alt="Image" loading="lazy" class="background-img-sdg">
                            </div>
                    
                        </a>
                    </div>
                    <!-- Last card (banner) -->
                    <div class=" col-md-3 mb-4" data-aos="zoom-in" data-aos-delay="700">
                        <a href="#sdgs" class="text-decoration-none">
                            <div class="card sdg-card">                 
                                <img src="./assets/img/sdgs/SDGS-banner.png" alt="Image" loading="lazy" class="background-img-sdg">
                            </div>
                        </a>
                    </div>
            </div>
        </div>
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
@endsection



