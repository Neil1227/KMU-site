<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark " data-aos="fade-down" data-aos-duration="1000"style="position: sticky; top: 0; z-index: 999;">
  <div class="container-fluid justify-content-center">

    <!-- LOGO -->
    <div class="navbar-logo d-lg-none">
      <!-- <img src="./assets/img/kmlogo.png" alt="Logo" class="mobile-logo"> -->
    <h3 class="logo-text text-white">Knowledge Management Unit</h3>
    </div>

    <!-- TOGGLER BUTTON -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav ">
            <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}">Home</a></li>
            <li class="nav-item dropdown dropdown-hover">
                <a class="nav-link dropdown-toggle text-white" href="#" id="servicesDropdown" role="button">
                    Services
                </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-dark" href="PS.html">Plagiarism Scan</a></li>
                        <li><a class="dropdown-item text-dark" href="PA.html">Promotional Activities</a></li>
                        <li><a class="dropdown-item text-dark" href="KSA.html">Knowledge Sharing</a></li>
                    </ul>
            </li>
            <li class="nav-item"><a class="nav-link text-white" href="tech.html">Technologies</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#media-resources">Media Resources</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#research">Research</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#sdgs">SDGs</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>