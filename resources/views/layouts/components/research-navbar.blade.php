<nav class="navbar navbar-expand-lg navbar-dark" data-aos="fade-down" data-aos-duration="1000">
  <div class="container-fluid">
    
    <!-- LOGO (for mobile view) -->
    <div class="navbar-logo d-lg-none">
      <h3 class="logo-text">{{ strtoupper($active ?? 'Research') }}</h3>        
    </div>

    <!-- Toggler -->
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto text-center">
        <li class="nav-item">
          <a class="nav-link text-white {{ ($active ?? '') === 'home' ? 'active' : '' }}" href="{{ url('/homepage#research') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'agriculture' ? 'active' : '' }}" href="{{ route('agriculture') }}">Agriculture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'aquaculture' ? 'active' : '' }}" href="{{ route('aquaculture') }}">Aquaculture</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'livestock' ? 'active' : '' }}" href="{{ route('livestock') }}">Livestock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'livelihood' ? 'active' : '' }}" href="{{ route('livelihood') }}">Livelihood</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'biotechnology' ? 'active' : '' }}" href="{{ route('biotechnology') }}">Biotechnology</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'root-crops' ? 'active' : '' }}" href="{{ route('root-crops') }}">Root Crops</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'iot' ? 'active' : '' }}" href="{{ route('iot') }}">Internet of Things</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white {{ $active === 'others' ? 'active' : '' }}" href="{{ route('others') }}">Others</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
