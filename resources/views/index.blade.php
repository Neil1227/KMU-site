<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/kmlogo.png') }}">
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">

</head>

<body>
    <!-- Transparent Navbar -->
    <nav class="navbar">
        <div class="carousel-text">
            <div class="fade-text">ACQUIRE</div>
            <div class="fade-text">PROMOTE</div>
            <div class="fade-text">SHARE</div>
        </div>
    </nav>

    <!-- Hero Section with Image Fallback -->
    <div class="hero-section">
        <!-- Video for non-iOS -->
        <video autoplay muted playsinline class="hero-video mt-5">
            <source src="./assets/videos/opener_14-37-44.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Fallback image for iOS -->
        <img src="{{ asset('assets/img/KMULOGO.png') }}" alt="Hero Image" class="hero-fallback-img">

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="me-md-3 mb-md-0">
                <a href="{{ url('/learn-more') }}" class="btn two-tone">Learn More ⇀</a>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="text-center">
        <p>&copy; 2025 Pampanga State Agricultural University. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
