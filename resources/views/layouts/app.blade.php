<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KMU')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/kmlogo.png') }}">


    @stack('css') <!-- Page-specific styles -->
    <!-- Shared CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}"> -->

</head>

<body>

    <main class="page-wrapper">
        @yield('content')
            <div class="loader-wrapper " id="preloader">
                <div class="loader"></div>       
            </div>
        <!-- include('layouts.components.chatbox') pay to use only for chatbot -->
    </main>

    <!-- Shared JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        AOS.init({
            offset: 0,
            once: true,
            });
    </script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    @stack('scripts') <!-- Page-specific scripts -->
</body>
</html>
