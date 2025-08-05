<!-- Footer -->
<footer class="custom-footer-section">
  <div class="container-fluid  py-5">
    <div class="row gy-4">
      <!-- Column 1: Logos -->
      <div class="col-12 col-md-3 text-center justify-content-center ">
        <div class="custom-footer-logos d-flex flex-wrap justify-content-center justify-content-md-evenly gap-2 mb-3">
          <img src="assets/img/iptbm.png" alt="Logo 1" class="custom-footer-logo">
          <img src="assets/img/logo.png" alt="Logo 2" class="custom-footer-logo">
          <img src="assets/img/sibultbi-logo.png" alt="Logo 3" class="custom-footer-logo">
          <img src="assets/img/officeofinnovation.png" alt="Logo 4" class="custom-footer-logo">
        </div>
        {{-- Real-time Viewer Section --}}
        <div class="total-site-views text-center py-3">
            <i class="fa fa-eye sm"></i> {{ number_format($totalPageViews) }} total site views
        </div>
      </div>

      <!-- Column 2: Quick Links -->
      <div class="col-6 col-md-3">
        <h5 class="custom-footer-title">Quick Links</h5>
        <ul class="list-unstyled custom-footer-links">
          <li><a href="#Homepage">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>

      <!-- Column 3: Resources -->
      <div class="col-6 col-md-3">
        <h5 class="custom-footer-title">Resources</h5>
        <ul class="list-unstyled custom-footer-links">
          <li><a href="#media-resources">Media</a></li>
          <li><a href="{{ route('newsletter') }}">Newsletters</a></li>
          <li><a href="{{ route('modules') }}">Modules</a></li>
        </ul>
      </div>

      <!-- Column 4: Contact Info -->
      <div class="col-12 col-md-3">
        <h5 class="custom-footer-title">Contact Us</h5>
        <p class="custom-footer-text">
        Pampanga State Agricultural University
        </p>
        <p class="custom-footer-text">
          PAC, San Agustin, Magalang, Pampanga, Philippines
        </p>
        <p class="custom-footer-text">Email: kmc@psau.edu.ph</a></p>
        <p class="custom-footer-text">Phone: (045) 123-4567</p>
      </div>
    </div>

    <!-- Bottom -->
    <div class="text-center mt-4 pt-3 custom-footer-bottom">
      <p class="mb-0">&copy; 2025 Pampanga State Agricultural University. All rights reserved.</p>
    </div>
  </div>
</footer>