<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark " data-aos="fade-in" data-aos-duration="1000" style="position: sticky; top: 0; z-index: 999;">
  <div class="container-fluid d-flex justify-content-evenly ">

    <!-- LOGO -->
    <div class="navbar-logo d-lg-none d-flex align-items-center">
      <img src="{{ asset('assets/img/kmlogo.png') }}" alt="Logo" class="mobile-logo me-2" style="height: 30px;">
      <h3 class="logo-text text-white mb-0">Knowledge Management Unit</h3>
    </div>


    <!-- TOGGLER BUTTON -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
        <span class="toggler-icon"></span>
      </button>

    </button>

    <div class="collapse navbar-collapse justify-content-evenly" id="navbarNav">

      <ul class="navbar-nav ">
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}#media-resources">Media Resources</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}#research">Research</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}#sdgs">SDGs</a></li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('technologies.index') }}">Technologies</a>
        </li>
        <li class="nav-item dropdown dropdown-hover">
          <a class="nav-link dropdown-toggle text-white" href="#" id="servicesDropdown" role="button">
            Services
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item text-dark" href="{{ route('plagscan') }}">Plagiarism Scan</a></li>
            <li><a class="dropdown-item text-dark" href="{{ route('promotional') }}">Promotional Activities</a></li>
            <li><a class="dropdown-item text-dark" href="{{ route('podcast') }}">Knowledge Sharing</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link text-white" href="{{ route('about') }}">About</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="{{ route('contact') }}">Contact</a></li>
      </ul>
      <form role="search" class="modern-search" action="{{ route('search') }}" method="GET">
        <input type="text" id="search" name="query" placeholder="Search..." value="{{ request('query') }}" autocomplete="off" />
        <button type="submit" id="go"><i class="fas fa-search"></i></button>
      </form>



    </div>
  </div>
</nav>
<script>
  document.getElementById('go').addEventListener('click', function() {
    const value = document.getElementById('search').value.trim();
    if (value === '143123') {
      window.open('/143123', '_blank'); // Open in new tab
    }
  });
</script>