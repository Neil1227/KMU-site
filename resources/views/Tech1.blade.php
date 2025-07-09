  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TECHNOLOGIES</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./styles/tech1.css">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/homepage.css">
    <link rel="stylesheet" href="./styles/navbar.css">
  <!-- Add AOS Library -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <!-- Google Fonts -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- EmailJS SDK -->
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
  <script type="text/javascript">
    (function(){
      emailjs.init("YOUR_PUBLIC_KEY"); // Replace with your EmailJS public key
    })();
  </script>

</head>

<body>
  <!-- Header -->
<header>
  <div class="heading" data-aos="fade-down" data-aos-duration="1000">
    <ul class="heading-list mt-1">
      <li class="heading-content-email"><i class="fas fa-envelope"></i> kmc@psau.edu.ph</li>
      <li class="heading-content-phone"><i class="fas fa-phone"></i> +63 900 000 0000</li>
      <li class="heading-content-location"><i class="fas fa-map-marker-alt"></i> PAC, San Agustin, Magalang, Pampanga, Philippines </li>
      <li class="heading-content-social">
        <a href="https://www.facebook.com/psau.kmc" class="social-icon" target="_blank"><i class="fa-brands fa-facebook"></i></a>
        <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
        <a href="#" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=kmc@psau.edu.ph" target="_blank" class="social-icon"><i class="fas fa-envelope"></i></a>
      </li>
    </ul>
  </div>
</header>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark " data-aos="fade-down" data-aos-duration="1000"style="position: sticky; top: 0; z-index: 999;">
  <div class="container-fluid ">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav text-center">
        <li class="nav-item">
          <a class="nav-link text-white active" href="Homepage.html">Home</a>
        </li>
            <li class="nav-item dropdown dropdown-hover">
            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button">
                Services
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item text-dark" href="PS.html">Plagiarism Scan</a></li>
                <li><a class="dropdown-item text-dark" href="PA.html">Promotional Activities</a></li>
                <li><a class="dropdown-item text-dark" href="KSA.html">Knowledge Sharing</a></li>
            </ul>
            </li>
            <li class="nav-item"><a class="nav-link text-white" href="tech.html">Technologies</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="Homepage.html#media-resources">Media Resources</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="Homepage.html#research">Research</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="Homepage.html#sdgs">SDGs</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="Homepage.html#about">About</a></li>
            <li class="nav-item"><a class="nav-link text-white active" href="contact.html">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

  <!-- Cards -->
  <div class="cards-container">
    <div class="card">
      <img src="./assets/img/11.png" alt="Tech 1" onclick="openModal(this)">
    </div>
    <div class="card">
      <img src="22.png" alt="Tech 2" onclick="openModal(this)">
    </div>
    <div class="card">
      <img src="33.png" alt="Tech 3" onclick="openModal(this)">
    </div>
  </div>

    <!-- Footer -->
<footer class="footer-section ">
  <div class="container">
    <div class="row">
      <!-- Column 1: Logos -->
      <div class="col-md-3 mb-4">
        <div class="footer-logos d-flex flex-wrap gap-2">
          <img src="assets/img/iptbm.png" alt="Logo 1" class="footer-logo">
          <img src="assets/img/kmlogo.png" alt="Logo 2" class="footer-logo">
          <img src="assets/img/sibultbi-logo.png" alt="Logo 3" class="footer-logo">
          <img src="assets/img/officeofinnovation.png" alt="Logo 4" class="footer-logo">
        </div>
      </div>

      <!-- Column 2 -->
      <div class="col-md-3 mb-4">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#Homepage" class="text-decoration-none">Home</a></li>
          <li><a href="#about" class="text-decoration-none">About</a></li>
          <li><a href="contact.html" class="text-decoration-none">Contact</a></li>
        </ul>
      </div>

      <!-- Column 3 -->
      <div class="col-md-3 mb-4">
        <h5>Resources</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Media</a></li>
          <li><a href="#" class="text-decoration-none">Publications</a></li>
          <li><a href="#" class="text-decoration-none">Newsletters</a></li>
          <li><a href="#" class="text-decoration-none">Modules</a></li>
        </ul>
      </div>

      <!-- Column 4 -->
      <div class="col-md-3 mb-4">
        <h5>Contact Us</h5>
        <p>Pampanga State Agricultural University<br>PAC, San Agustin, Magalang, Pampanga, Philippines</p>
        <p>Email: kmc@psau.edu.ph</p>
        <p>Phone: (045) 123-4567</p>
      </div>

    </div>
    <div class="row text-center mt-4 pt-3   footer-bottom">
    <p class="mb-0">&copy; Philippine Copyright 2025 by Pampanga State Agricultural University</p>
    </div>
  </div>
</footer>

  <!-- Modal -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-transparent border-0 position-relative">
        <div class="modal-body text-center">
          <button id="prevBtn" class="modal-btn">&#8592;</button>
          <img src="" id="modalImage" class="modal-img" alt="Zoomed Image">
          <button id="nextBtn" class="modal-btn">&#8594;</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>


  <script>
  AOS.init();
</script>

</body>
</html>
