@extends('layouts.app')

@section('title', 'KMU | About Us')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />
@endpush

@section('content')
    {{-- Header --}}
    @include('layouts.components.header')

    {{-- Navbar --}}
    @include('layouts.components.navbar')

    {{-- Contact Section --}}
    <!-- (Empty in your original code) -->

    <!-- About Section -->
    <section id="about" class="py-5 about-section">

        <div class="about-section py-5" data-aos="fade-up">
            <div class="container text-center">
                <h2 class="section-title text-center mb-3" data-aos="fade-down">
                    What is <span class="title-highlight">Research, Innovation, Extension, and Training Office?</span>
                </h2>

                <div class="about-content d-flex flex-column flex-md-row align-items-center text-start gap-4 mb-5"
                    data-aos="fade-right">
                    <img src="{{ asset('assets/img/about/Logo (1).png') }}" alt="Riet Logo" class="about-logo"
                        style="max-width: 120px; height: auto;">
                    <p class="subtitle m-0" data-aos="fade-left" data-aos-delay="200">
                        The <strong> Research, Innovation, Extension, and Training</strong> <em>(RIET)</em> office committed
                        in delivering impact-driven research, innovation, extension, and training
                        services that are relevant to the needs of present and future generations. accessible to all.
                    </p>
                </div>

                <div class="mission-box p-4 rounded" data-aos="zoom-in">
                    <h4 class="text-white mb-3">RIET's Mission</h4>
                    <p class="text-white mb-0">
                        We aim to attain our mission in creating empowered communities through relevant and impact-driven
                        research, extension, and training services for Food security, Climate Resiliency, and Poverty
                        Alleviation.
                        This year, we have set institutional reforms to attract external funding, accelerate the development
                        of research facilities, increase production of impact-driven data, innovative methods and
                        technologies, publications and patents, leverage by establishing
                        permanent items who will perform full-time research or extension and training.
                    </p>
                </div>
            </div>
        </div>

        <div class="team-section">
            <div class="team-container">
                <!-- Top card -->
                <h2 class="section-title text-center mb-5" data-aos="fade-up">
                    Research, Innovation, Extension and Training <span class="title-highlight">CLUSTER</span>
                    <em> <small class="text-muted">(RIET)</small></em>
                </h2>

                <div class="team-card active special-layout" data-aos="fade-right">
                    <img src="{{ asset('assets/img/about/president.png') }}" alt="Dr. Anita G. David">
                    <div class="team-info">
                        <h4 class="highlight">Dr. Anita G. David</h4>
                        <p class="role">SUC President IV — PSAU President</p>
                        <p class="desc">
                            Leads PSAU with a vision of excellence, innovation, and compassion. She is committed <br> to
                            advancing quality education, research, and community engagement, <br>fostering a
                            university that grows with a heart for humanity, agriculture, nature, and entrepreneurship.
                        </p>
                    </div>
                </div>

                <div class="team-card special-layout" data-aos="fade-left">
                    <img src="{{ asset('assets/img/about/Sanchez, Geraldine C.png') }}" alt="Dr. Geraldine">
                    <div class="team-info">
                        <h4 class="highlight">Dr. Geraldine C. Sanchez</h4>
                        <p class="role">Vice President for Research, Innovation, Extension & Training (RIET)</p>
                        <p class="desc">
                            The Vice President for Research, Innovation, Extension, and Training (VP-RIET) leads
                            <br> PSAU’s initiatives in research, technology development, and community engagement,
                            <br>ensuring programs align with the university’s mission of innovation and sustainable growth.
                        </p>
                    </div>
                </div>

                <div class="card-row">
                    <!-- Column 1 -->
                    <div class="card-section" data-aos="fade-up">
                        <div class="card-title">
                            <h4 class="highlight mb-5">Office of the Research and Development</h4>
                        </div>

                        <div class="card-pair">
                            <div class="team-card active" data-aos="fade-right">
                                <img src="{{ asset('assets/img/about/docgelcarandang.png') }}" alt="">
                                <h4 class="highlight">Dr. Rogelio D. Carandang, Jr.</h4>
                                <p class="role">Director — Office of the Research and Development</p>
                            </div>

                            <div class="team-card" data-aos="fade-left">
                                <img src="{{ asset('assets/img/about/Barrientos, Ariane Padura.png') }}" alt="">
                                <h4 class="highlight">Ariane P. Barrientos</h4>
                                <p class="role">Asst. Director — Office of the Research and Development</p>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="card-section" data-aos="fade-up">
                        <div class="card-title">
                            <h4 class="highlight mb-5">Office of Innovation</h4>
                        </div>

                        <div class="card-pair">
                            <div class="team-card active" data-aos="fade-right">
                                <img src="{{ asset('assets/img/about/21.png') }}" alt="">
                                <h4 class="highlight">Dir. Walter L Pacunana M.Sc.</h4>
                                <p class="role">Director — Office of Innovation</p>
                            </div>

                            <div class="team-card" data-aos="fade-left">
                                <img src="{{ asset('assets/img/about/dra.png') }}" alt="">
                                <h4 class="highlight">Divine Reine S. Aquino</h4>
                                <p class="role">Asst. Director — Office of Innovation</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="single-column-center" data-aos="fade-up">
                    <h4 class="highlight">Office of Extension and Training</h4>
                </div>

                <div class="bottom-row">
                    <div class="team-card active" data-aos="fade-right">
                        <img src="{{ asset('assets/img/about/dr.briones.jpg') }}" alt="DR. AMALIA C. BRIONES">
                        <h4 class="highlight">Dr. Amalia C. Briones Ed.D.</h4>
                        <p class="role">Director — Office of Extension and Training</p>
                    </div>

                    <div class="team-card" data-aos="fade-left">
                        <img src="{{ asset('assets/img/about/mr.cabral.png') }}" alt="MR. EMMANUEL A. CABRAL">
                        <h4 class="highlight">Emmanuel A. Cabral</h4>
                        <p class="role">Asst. Director — Office of Extension and Training</p>
                    </div>
                </div>

                <h2 class="section-title text-center m-5" data-aos="fade-up">
                    Meet Our <span class="title-highlight">Team</span>
                </h2>

                <div class="team-card active special-layout" data-aos="fade-right">
                    <img src="{{ asset('assets/img/about/21.png') }}" alt="Walter Pacunana">
                    <div class="team-info">
                        <h4 class="highlight">Dir. Walter L. Pacunana M.Sc.</h4>
                        <p class="role">Director — Office of Innovation</p>
                        <p class="desc">
                            Leads the Office of Innovation and manages the Knowledge Management Unit,
                            driving research utilization, technology transfer, and collaborative innovation
                            across PSAU and its partners.
                        </p>
                    </div>
                </div>

                <!-- Bottom row -->
                <div class="bottom-row">
                    <div class="team-card active" data-aos="fade-right">
                        <img src="{{ asset('assets/img/about/26.png') }}" alt="Allen Mark Demapanag">
                        <h4 class="highlight">Allen Mark Demapanag</h4>
                        <p class="role">Project Technical Assistant I</p>
                    </div>

                    <div class="team-card" data-aos="fade-up">
                        <img src="{{ asset('assets/img/about/2.png') }}" alt="Alexandra Gumba">
                        <h4 class="highlight">Alexandra Gumba</h4>
                        <p class="role">Technical staff</p>
                    </div>

                    <div class="team-card" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{ asset('assets/img/about/4.png') }}" alt="Neil Patrick Acierto">
                        <h4 class="highlight">Neil Patrick Acierto</h4>
                        <p class="role">Technical staff</p>
                    </div>

                    <div class="team-card" data-aos="fade-left">
                        <img src="{{ asset('assets/img/about/mariejay.jpg') }}" alt="Marie Jay Dayrit">
                        <h4 class="highlight">Marie Jay Dayrit</h4>
                        <p class="role">Technical staff</p>
                    </div>
                </div>
            </div>
        </div>

        <hr style="width:70%; margin: 0 auto;">

        <div class="about-section py-5" data-aos="fade-up">
            <div class="container text-center">
                <h2 class="section-title text-center mb-3" data-aos="fade-down">
                    What is <span class="title-highlight">Knowledge Management Unit?</span>
                </h2>

                <div class="about-content d-flex flex-column flex-md-row align-items-center text-start gap-4 mb-5"
                    data-aos="fade-right">
                    <img src="assets/img/kmlogo.png" alt="Kamp Maalam Logo" class="about-logo"
                        style="max-width: 120px; height: auto;">
                    <p class="subtitle m-0" data-aos="fade-left" data-aos-delay="200">
                        The <strong>Knowledge Management</strong> <em>(KM)</em> unit operates to foster an environment where
                        knowledge resources
                        are acquired, promoted, and shared in alignment with quality assurance standards, supporting the
                        continuous
                        improvement and accessibility of the information it handles. By establishing a centralized
                        framework,
                        it creates space and best practices for knowledge sharing activities, making knowledge-based assets
                        accessible to all.
                    </p>
                </div>

                <div class="mission-box p-4 rounded" data-aos="zoom-in">
                    <h4 class="text-white mb-3">Our Mission</h4>
                    <p class="text-white mb-0">
                        <strong><em>Kamp Maalam</em> </strong>is an initiative of KM's knowledge-sharing activities. It
                        seeks to modernize practices by
                        leveraging available resources and expanding its reach to a broader audience. The ultimate goal is
                        to
                        foster a community where knowledge is shared, nurtured, and grows.
                    </p>
                </div>
            </div>
        </div>

        <div class="values-section" data-aos="fade-up">
            <h2 class="section-title text-center mb-5">KMU <span class="title-highlight">Objectives</span></h2>
            <div class="values-container">
                <div class="value-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="value-icon"><i class="fas fa-circle-down fs-4"></i></div>
                    <div class="value-title highlight">Aquire</div>
                    <div class="value-desc">Aquire and organize Knowledge resources created by university stakeholders to
                        be come purposeful assets of PSAU.</div>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="value-icon"><i class="fas fa-check-circle fs-4"></i></div>
                    <div class="value-title highlight">Promote</div>
                    <div class="value-desc">Create space and best practice for knowledge sharing activities, making
                        knowledge-based assets accessible to all.</div>
                </div>
                <div class="value-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="value-icon"><i class="fas fa-users fs-4"></i></div>
                    <div class="value-title highlight">Share</div>
                    <div class="value-desc">Ensure knowledge resources are acquiescent to existing quality assurance rules
                        and regulations.</div>
                </div>
            </div>
        </div>

    </section>

    {{-- Footer --}}
    @include('layouts.components.footer')
@endsection

@push('scripts')
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/email.js') }}"></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('js/map.js') }}"></script>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
@endpush
