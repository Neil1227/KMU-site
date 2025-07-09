<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTACT US</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="./styles/contact.css">
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/homepage.css">
    <link rel="stylesheet" href="./styles/navbar.css">

    <!-- Add AOS Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
<div class="floating-socials d-none" id="floatingSocials" >
  <a href="https://www.facebook.com/psau.kmc" class="social-icon" target="_blank"><i class="fa-brands fa-facebook"></i></a>
  <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
  <a href="#" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
  <a href="#" class="social-icon"><i class="fas fa-envelope"></i></a>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark " data-aos="fade-down" data-aos-duration="1000"style="position: sticky; top: 0; z-index: 999;">
  <div class="container-fluid justify-content-center">
      <!-- LOGO -->
    <div class="navbar-logo d-lg-none">
      <!-- <img src="./assets/img/kmlogo.png" alt="Logo" class="mobile-logo"> -->
    <h3 class="logo-text text-white">Knowledge Management Unit</h3>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
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
            <li class="nav-item"><a class="nav-link text-white active" href="Homepage.html#about">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Google Map Embed -->
<div class="map-container d-flex justify-content-center py-5">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2476.777044480476!2d120.69328491244967!3d15.217683326258085!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396ef00529fdd05%3A0x7c6e3080efd62457!2sInformation%20Communication%20Technology%20Research%20and%20Development%20-%20PSAU!5e0!3m2!1sen!2sph!4v1750837917550!5m2!1sen!2sph"
    width="80%" 
    height="300" 
    style="border:0;" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>  
</div>
  <section class="contact text-center">
    <h2 class="text-center mb-4 section-title" data-aos="fade-up">
        Contact us
    <hr class="hr">
    </h2>
      <!-- Comment Section -->
  <div class="comment-section">
    <h3 class="mb-4">Leave a Comment</h3>
    <form class="comment-form" id="commentForm">
      <input type="text" id="name" placeholder="Your Name" required />
      <textarea id="comment" placeholder="Your Comment" rows="4" required></textarea>
      <button type="submit">Submit</button>
    </form>
    <div id="commentList" class="comment-list"></div>
  </div>
  </section>

<!-- Footer -->
<footer class="custom-footer-section">
  <div class="container-fluid py-5">
    <div class="row gy-4">
      <!-- Column 1: Logos -->
      <div class="col-12 col-md-3 text-center text-md-start">
        <div class="custom-footer-logos d-flex flex-wrap justify-content-center justify-content-md-start gap-2">
          <img src="assets/img/iptbm.png" alt="Logo 1" class="custom-footer-logo">
          <img src="assets/img/kmlogo.png" alt="Logo 2" class="custom-footer-logo">
          <img src="assets/img/sibultbi-logo.png" alt="Logo 3" class="custom-footer-logo">
          <img src="assets/img/officeofinnovation.png" alt="Logo 4" class="custom-footer-logo">
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
          <li><a href="#">Media</a></li>
          <li><a href="#">Publications</a></li>
          <li><a href="#">Newsletters</a></li>
          <li><a href="#">Modules</a></li>
        </ul>
      </div>

      <!-- Column 4: Contact Info -->
      <div class="col-12 col-md-3">
        <h5 class="custom-footer-title">Contact Us</h5>
        <p class="custom-footer-text">
          Pampanga State Agricultural University<br>
          PAC, San Agustin, Magalang, Pampanga, Philippines
        </p>
        <p class="custom-footer-text">Email: <a href="mailto:kmc@psau.edu.ph" class="text-decoration-none text-dark">kmc@psau.edu.ph</a></p>
        <p class="custom-footer-text">Phone: (045) 123-4567</p>
      </div>
    </div>

    <!-- Bottom -->
    <div class="text-center mt-4 pt-3 custom-footer-bottom">
      <p class="mb-0">&copy; 2025 Pampanga State Agricultural University. All rights reserved.</p>
    </div>
  </div>
</footer>


  </body>



    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="./message.js"></script>
    <script src="./assets/js/navbar.js"></script>
    <script>
        AOS.init();
    </script>
 

</body>

</html>


