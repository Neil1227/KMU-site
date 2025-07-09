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
      <h3 class="logo-text">Internet of Things</h3>        
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
            <li class="nav-item"><a class="nav-link text-white active" href="iot.html">Internet of Things</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="others.html">Others</a></li>
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
                src="./assets/img/research_thumbnails/reseach-icon-iot.png" 
                alt="Modern agriculture" 
                loading="lazy"
                width="100%"
                height="auto"
                style="display: block; object-fit: cover; border-radius: 10px;"
              >

          </div>
          <div class="research-text">
            <h3>Water management and irrigation <hr> </h3>
                <p>
An automated irrigation system using a soil moisture sensor and Raspberry Pi was developed for real-time water monitoring. Faults are detected via an Arduino-based serial monitor to reduce downtime. A thematic map catalogs PSAU’s existing and potential water resources for better planning.

Other systems enhance communication, safety, and resource management. A centralized app allows faculty to post announcements to students. A fire safety system displays sensor data and sends SMS alerts in emergencies. A Raspberry Pi-based system controls electrical switches manually or by schedule. An IoT door lock with intrusion detection was also created. Lastly, topographic and infrastructure maps of campus zones were generated.                </p>

          </div>
        </div>

            <h3>Initiatives 
                <hr>
            </h3>
<p>To address water management, an automated water irrigation system application was designed, utilizing a soil moisture sensor and Raspberry Pi to monitor irrigation levels in real-time. Fault detection in the irrigation system is managed through an Arduino-based serial monitor, ensuring quick identification of issues and minimizing system downtime. Additionally, a water resources thematic map was developed to catalog both existing and potential water resources within the PSAU property, facilitating the identification of various water sources and receivers across the campus. Together, these systems aim to enhance operational efficiency, ensure safety, and promote sustainability within the institution. It presents a series of interconnected systems aimed at improving communication, safety, and resource management within an academic institution. One system allows faculty members to post announcements, facilitating communication with students through a centralized application. Another system is designed to enhance safety by recording and displaying data from smoke, temperature, and fire sensors on an LCD monitor, while also sending SMS alerts to authorized fire department personnel in case of emergencies. Additionally, a web-based system embedded in a Raspberry Pi was developed to monitor and control electrical switches manually or via a scheduling system, enabling faculty to set operational schedules. For enhanced security, an IoT-based electronic door lock with an intrusion detection system was also created. Another key system generates topographic maps for various areas within the university, including academic, commercial, and science and technology zones, while also mapping infrastructure facilities across the PSAU campus.</p>
            <h3>R4D Thrusts and Priorities 
                <hr>
            </h3>
            <ul>
                <li>A Design and Development of an Internet of Things (Iot) Based Secured office Automation, Monitoring, and Control with GSM Notification.</li>
                <li>Internet of Things Based Controlled Environment.</li>
                <li>Internet of Things Based Automated Irrigation System.</li>
            </ul>

            <h3>Recommendations 
                <hr>
            </h3>
            <ul>
                <li>IoT-based technologies are fundamentally transforming various industries, and as the world increasingly moves toward technology-driven sectors, it’s essential to integrate these technologies into areas like education, agriculture, and aquaculture.</li>
                <li>The Internet of Things should have a continuous monitoring and evaluation system when it comes to its data and on what they have been developed. Additionally, the security of the device should be focused to update and have strong encryption, securing data storage practices, and access controls.</li>
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
