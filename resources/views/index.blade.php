<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">


</head>

<body>
    <!-- Transparent Navbar -->
    <nav class="navbar">
        <div class="carousel-text">
        <div class="fade-text">Acquire</div>
        <div class="fade-text">Promote</div>
        <div class="fade-text">Share</div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <video autoplay muted playsinline>
        <source src="./assets/videos/opener_14-37-44.mp4" type="video/mp4">
        Your browser does not support the video tag.
        </video>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="me-md-3 mb-2 mb-md-0">
                <a href="Homepage.html" class="btn two-tone">Learn More</a>
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
