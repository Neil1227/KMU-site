@extends('layouts.app')

@section('title', 'KMU | Sibul TBI')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tbi.css') }}">
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
                    What is Sibul <span class="title-highlight">Technology Business Incubator</span>
                </h2>

                <div class="about-content d-flex flex-column flex-md-row align-items-center text-start gap-4 mb-5"
                    data-aos="fade-right">
                    <img src="assets/img/sibultbi-logo.png" alt="IPTBM Logo" class="about-logo"
                        style="max-width: 120px; height: auto;">
                    <p class="subtitle m-0" data-aos="fade-left" data-aos-delay="200">
                        <strong>Sibul Technology Business Incubator </strong> <em>(TBI)</em>
                        is an agri-aqua business incubator that aims to hellp farmers, firherfolks, agripreneurs, MSMEs, and
                        other client in starting
                        and scaling up their agri-business enterprises.
                    </p>
                </div>
                <section class="sibul-tbi-section py-5">
                    <div class="container text-center">

                        <h2 class="section-title mb-2">
                            Sibul TBI <br>
                            <span class="title-highlight">Incubation Phases & General Services</span>
                        </h2>

                        <p class="subtitle mb-4 mx-auto">
                            A structured incubation program supporting innovators from ideation to commercialization.
                        </p>

                        <div class="sibul-cards-grid">

                            <!-- Pre-Incubation -->
                            <div class="sibul-card pre">
                                <h4 class="sibul-title pre">Pre-Incubation: Application and Establishment Stage</h4>
                                <ul>
                                    <li>Awareness Seminars</li>
                                    <li>Technology Identification</li>
                                    <li>Application Assistance</li>
                                    <li>Printing Services</li>
                                </ul>
                            </div>

                            <!-- Incubation I -->
                            <div class="sibul-card ideation">
                                <h4 class="sibul-title ideation">Incubation I: Ideation and Establishment Stage</h4>
                                <ul>
                                    <li>Basic Skills Training</li>
                                    <li>Technology-Specific Skills Training</li>
                                    <li>Business Plan Advisory</li>
                                    <li>Brand Development Assistance</li>
                                    <li>Pilot Production</li>
                                    <li>Technical Assistance</li>
                                    <li>Business Registration Advisory</li>
                                    <li>Mentoring and Coaching</li>
                                    <li>Access to relevant Government Support</li>
                                </ul>
                            </div>

                            <!-- Incubation II -->
                            <div class="sibul-card strengthening">
                                <h4 class="sibul-title strengthening">Incubation II: Strengthening Stage</h4>
                                <ul>
                                    <li>Advance Skills Training</li>
                                    <li>Technology-Specific Skills Training</li>
                                    <li>Market Testing and Validation Assistance</li>
                                    <li>Pilot Production</li>
                                    <li>Technical Assistance</li>
                                    <li>Mentoring and Coaching</li>
                                    <li>Access to relevant Government Support</li>
                                </ul>
                            </div>

                            <!-- Post-Incubation -->
                            <div class="sibul-card post">
                                <h4 class="sibul-title post">Post-Incubation</h4>
                                <ul>
                                    <li>Government funding grant, angel, pre-seed, or seed funding</li>
                                    <li>At least 1 sales channel partnership closed</li>
                                    <li>At least 1 pitching competition, 1 exhibit, and 1 networking activity joined</li>
                                </ul>
                            </div>

                        </div>

                    </div>

                    <h2 class="section-title my-5">
                        Agri-Business Unit <br>
                        <span class="title-highlight">General Services</span>
                    </h2>

                    <div class="services-grid mb-5">

                        <div class="service-card pre">
                            <div class="service-row">
                                <div class="card-icon"><i class="fa-solid fa-file-lines"></i></div>
                                <h4 class="card-title">Business Plan & BMC Preparation</h4>
                            </div>
                        </div>

                        <div class="service-card ideation">
                            <div class="service-row">
                                <div class="card-icon"><i class="fa-solid fa-chart-line"></i></div>
                                <h4 class="card-title">Market Research & Analysis</h4>
                            </div>
                        </div>

                        <div class="service-card strengthening">
                            <div class="service-row">
                                <div class="card-icon"><i class="fa-solid fa-clipboard-check"></i></div>
                                <h4 class="card-title">Feasibility Assessment Opinion Report (FOR)</h4>
                            </div>
                        </div>

                        <div class="service-card post">
                            <div class="service-row">
                                <div class="card-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                                <h4 class="card-title">Technology Valuation</h4>
                            </div>
                        </div>

                    </div>

                    <h2 class="section-title my-5">
                        Technology Licensing Unit <br>
                        <span class="title-highlight">General Services</span>
                    </h2>

                    <div class="services-grid">

                        <div class="service-card pre">
                            <div class="service-row">
                                <div class="card-icon">
                                    <i class="fa-solid fa-scale-balanced"></i>
                                </div>
                                <h4 class="card-title">Drafting & Review of Legal Agreements</h4>
                            </div>
                        </div>

                        <div class="service-card ideation">
                            <div class="service-row">
                                <div class="card-icon">
                                    <i class="fa-solid fa-handshake-simple"></i>
                                </div>
                                <h4 class="card-title">Access to Negotiation Expertise</h4>
                            </div>
                        </div>

                        <div class="service-card strengthening ">
                            <div class="service-row">
                                <div class="card-icon">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <h4 class="card-title">Fairness Opinion Report (FOR) Assistance</h4>
                            </div>
                        </div>

                        <div class="service-card post">
                            <div class="service-row">
                                <div class="card-icon">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                                <h4 class="card-title">Technology Transfer Education</h4>
                            </div>
                        </div>

                        <div class="service-card pre">
                            <div class="service-row">
                                <div class="card-icon">
                                    <i class="fa-solid fa-coins"></i>
                                </div>
                                <h4 class="card-title">Royalty Management</h4>
                            </div>
                        </div>

                    </div>

                    <hr class="mt-5" style="width:70%; margin: 0 auto;">
                    <h5 class="text-center section-title mt-5 mb-3" data-aos="fade-up" data-aos-duration="1500">
                        We are glad to <span class="title-highlight">help!</span>
                    </h5>
                    <p class="text-muted text-center"><em>Contact the Sibul TBI for more assistance</em></p>
                    <p class="text-muted text-center mb-5"><em>sibul@psau.edu.ph</em></p>
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
