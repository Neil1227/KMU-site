<nav class="navbar navbar-expand-lg navbar-dark" data-aos="fade-down" data-aos-duration="1000">
    <div class="container-fluid">
        <div class="navbar-logo d-lg-none" data-aos="fade-right" data-aos-delay="100">
            <h3 class="logo-text">{{ strtoupper($active ?? '') }}</h3>
        </div>

        <!-- Navbar Toggler (right-aligned) -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav" data-aos="fade-down" data-aos-delay="100">
            <ul class="navbar-nav mx-auto text-center">
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'home' ? 'active' : '' }}" href="{{ url('/homepage') }}#media-resources">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'ictv' ? 'active' : '' }}" href="{{ route('ictv') }}">ICTV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'iec' ? 'active' : '' }}" href="{{ route('iec') }}">IEC Materials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'newsletter' ? 'active' : '' }}" href="{{ route('newsletter') }}">Newsletter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'modules' ? 'active' : '' }}" href="{{ route('modules') }}">Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ $active == 'tech-portfolio' ? 'active' : '' }}" href="{{ route('tech-portfolio') }}">Tech Portfolio</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
