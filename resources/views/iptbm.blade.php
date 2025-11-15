@extends('layouts.app')

@section('title', 'KMU | IP-TBM Unit')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iptbm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
@endpush

@section('content')
    {{-- Header --}}
    @include('layouts.components.header')

    {{-- Navbar --}}
    @include('layouts.components.navbar')

    <section class="container-page-services">
        <div class="iptbm-section py-5" data-aos="fade-up">
            <div class="container text-center">
                <h2 class="section-title text-center mb-3" data-aos="fade-down">
                    General Function of the <span class="title-highlight">IP-TBM Unit</span>
                </h2>

                <div class="about-content d-flex flex-column flex-md-row align-items-center text-start gap-4 mb-5"
                    data-aos="fade-right">
                    <img src="assets/img/iptbm.png" alt="IPTBM Logo" class="about-logo"
                        style="max-width: 120px; height: auto;">
                    <p class="subtitle m-0" data-aos="fade-left" data-aos-delay="200">
                        The <strong>Intellectual Property and Technology Business Management </strong> <em>(IP-TBM)</em>
                        Unit
                        is committed to
                        enhancing R&D productivity by efficiently managing the knowledge resources, technologies, and other
                        intellectual property
                        assets of the PSAU – increasing their quality and value, assessing potential risks,
                        and supporting their readiness, visibility, and transfer to the larger market and/or community
                        through commercialization.
                    </p>
                </div>
                <section class="ip-services-section py-5">
                    <div class="container text-center">

                        <h2 class="section-title mb-2">
                            Intellectual Property <br>
                            <span class="title-highlight">Services & Solutions</span>
                        </h2>

                        <p class="subtitle mx-auto mb-4">
                            Comprehensive IP services to protect, manage, and maximize the value of your innovations
                        </p>

                        <div class="ip-services-grid">

                            <!-- 2.3.1 IP Potential Assessment -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="highlight">IP Potential Assessment</h4>
                                <p>
                                    Evaluation of innovations to identify patentable features and determine commercial
                                    viability.
                                </p>
                            </div>

                            <!-- 2.3.2 IP Consultation and Advisory -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-book"></i>
                                </div>
                                <h4 class="highlight">IP Consultation and Advisory</h4>
                                <p>
                                    Expert guidance on IP strategy, portfolio development, and protection best
                                    practices.
                                </p>
                            </div>

                            <!-- 2.3.3 Education and Awareness Activities -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                </div>
                                <h4 class="highlight">Education and Awareness Activities</h4>
                                <p>
                                    Training and workshops designed to strengthen IP literacy and foster innovation
                                    culture.
                                </p>
                            </div>

                            <!-- 2.3.4 Prior Art Searching -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-search"></i>
                                </div>
                                <h4 class="highlight">Prior Art Searching</h4>
                                <p>
                                    Searches of existing patents and publications to assess novelty and avoid
                                    infringement.
                                </p>
                            </div>

                            <!-- 2.3.5 Patent Drafting -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h4 class="highlight">Patent Drafting</h4>
                                <p>
                                    Preparation of patent applications with clear claims and detailed technical
                                    descriptions.
                                </p>
                            </div>

                            <!-- 2.3.6 IP Application -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-paper-plane"></i>
                                </div>
                                <h4 class="highlight">IP Application</h4>
                                <p>
                                    End-to-end management of patent, trademark, and design applications across
                                    jurisdictions.
                                </p>
                            </div>

                            <!-- 2.3.7 Recordal and Maintenance Services -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-folder-open"></i>
                                </div>
                                <h4 class="highlight">Recordal and Maintenance Services</h4>
                                <p>
                                    Updating ownership, renewals, and maintenance of registered IP to ensure validity.
                                </p>
                            </div>

                            <!-- 2.3.8 IP Monitoring and Prosecution -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4 class="highlight">IP Monitoring and Prosecution</h4>
                                <p>
                                    Monitoring IP filings, handling office actions, and securing approval from IP
                                    offices.
                                </p>
                            </div>

                            <!-- 2.3.9 Management of Inventory of IP Assets -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-archive"></i>
                                </div>
                                <h4 class="highlight">Management of Inventory of IP Assets</h4>
                                <p>
                                    Organizing, tracking, and maintaining records of organizational IP assets.
                                </p>
                            </div>

                            <!-- 2.3.10 Patent Mining -->
                            <div class="service-card">
                                <div class="service-icon">
                                    <i class="fas fa-gem"></i>
                                </div>
                                <h4 class="highlight">Patent Mining</h4>
                                <p>
                                    Identifying patentable ideas from R&D output to strengthen your innovation pipeline.
                                </p>
                            </div>

                        </div>
                    </div>
                    <h5 class="text-center section-title my-3" data-aos="fade-up" data-aos-duration="1500">
                        We are glad to <span class="title-highlight">help!</span>
                    </h5>
                    <p class="text-muted text-center"><em>Contact the IP-TBM Unit for more assistance</em></p>
                    <p class="text-muted text-center mb-5"><em>iptbm@psau.edu.ph</em></p>
                </section>
            </div>
        </div>



    </section>

    {{-- Footer --}}
    @include('layouts.components.footer')
@endsection

@push('scripts')
    <script src="{{ asset('message.js') }}"></script>
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endpush
