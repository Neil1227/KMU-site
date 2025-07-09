<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Research</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/research.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="./styles/media-resource-navbar.css">
    <link rel="stylesheet" href="./styles/global.css">

</head>

<body>
<!-- Background Image Container -->
<div class="background-container">
  <picture>
    <!-- Optional fallback for browsers that don't support WebP -->
    <source srcset="./assets/img/logos-bg.webp" type="image/webp">
    <img src="./assets/img/logos-bg.png" alt="Abstract Background" loading="lazy" class="background-img">
  </picture>
    <div class="background-overlay"></div>
</div>
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
    <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <div class="navbar-logo d-lg-none">
      <h3 class="logo-text">Others</h3>        
    </div>
        <!-- Navbar Toggler (right-aligned) -->
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto text-center">
            <li class="nav-item"><a class="nav-link text-white" href="Homepage.html#research">Home</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="agriculture.html">Agriculture</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="aquaculture.html">Aquaculture</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="livestock.html">Livestock</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="livelihood.html">Livelihood</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="biotechnology.html">Biotechnology</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="root-crops.html">Root Crops</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="iot.html">Internet of Things</a></li>
            <li class="nav-item"><a class="nav-link text-white active" href="others.html">Others</a></li>
        </ul>
        </div>
    </div>
    </nav>

    <div class="container-page py-5">
    <!-- Top Row -->
    <div class="row g-4 mb-4">
        <div class="col-12">
        <div class="bento-card h-100">

        <div class="research-card">
          <div class="research-image">
              <!-- Actual image element with lazy loading -->
              <img 
                src="./assets/img/research_thumbnails/reseach-icon-others.png" 
                alt="Modern agriculture" 
                loading="lazy"
                width="100%"
                height="auto"
                style="display: block; object-fit: cover; border-radius: 10px;"
              >


          </div>
          <div class="research-text">
            <h3>Helping Local Communities Recover and Thrive <hr> </h3>
            <p>
                Commercially available stoves for briquettes are often not suitable for the biomass briquettes produced at PSAU. Additionally, the COVID-19 pandemic had a significant impact on the ecotourism sector in the SPCW, leading to a decline in visitor numbers, disruption of local livelihoods, and a negative effect on environmental sustainability.
           </p>
          </div>
        </div>
            <h3>Initiatives 
                <hr>
            </h3>
            <p>
                The stove designed for biomass briquettes highlights the need for public-private partnerships and emphasizes the importance of continuous monitoring and evaluation to ensure the long-term sustainability of the SPCW's ecotourism sector. This collaborative approach is essential for maintaining the balance between economic development, environmental protection, and local community benefits.            
            </p>

            <h3>R4D Thrusts and Priorities 
                <hr>
            </h3>
            <ul>
                <li>Proposed Fabrication and Performance Evaluation of PSAU Briquette Stove.</li>
                <li>Drawing Lessons from the COVID-19 Pandemic and Charting a Way Forward for Ecotourism Policy.</li>
           </ul>

            <h3>Recommendations 
                <hr>
            </h3>
            <ul>
                <li>There are other studies that need to be explored and developed. With this, other researchable areas are highly recommended.</li>
            </ul>
        </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 KAMP MAALAM | All Rights Reserved</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
