<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title', 'KMU Admin')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/kmlogo.png') }}">

    @stack('css') <!-- Page-specific styles -->
    <!-- Shared CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('css/admin/admin-content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">

    <style>
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex " id="admin-wrapper">

            {{-- Sidebar --}}
            @include('admin.components.sidebar')

            {{-- Main Content --}}
            <div class="col">
                <div class="content-wrapper col" id="main-content">
                    {{-- Header --}}
                    @include('admin.components.header')

                    {{-- Dynamic Content --}}
                    <!-- Loader for Large File Overlay -->
                    <div id="upload-loader">
                        <div style="
                                border:6px solid #f85e0a;
                                border-top:6px solid #1c366a;
                                border-radius:50%;
                                width:60px;
                                height:60px;
                                animation:spin 1s linear infinite;"></div>
                        <p style="margin-top:10px;font-size:16px;color:#333;">Uploading, please wait...</p>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Shared JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Responsive extension CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Responsive extension JS -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>


    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Large File js loader -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const forms = document.querySelectorAll('form[data-show-loader]');

            if (forms.length > 0) {
                forms.forEach(form => {
                    form.addEventListener("submit", function() {
                        const loader = document.getElementById("upload-loader");
                        if (!loader) return;

                        loader.style.display = "flex";

                        // Minimum display time (e.g., 800ms) to prevent flash
                        const startTime = Date.now();
                        form.addEventListener("ajaxComplete", function() {
                            const elapsed = Date.now() - startTime;
                            const remaining = 800 - elapsed;
                            setTimeout(() => {
                                loader.style.display = "none";
                            }, remaining > 0 ? remaining : 0);
                        });
                    });
                });
            }
        });
    </script>

    <script>
        AOS.init();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");

            toggleBtn?.addEventListener("click", function() {
                sidebar.classList.toggle("show");

                if (!document.getElementById("sidebar-backdrop")) {
                    const backdrop = document.createElement("div");
                    backdrop.className = "sidebar-backdrop";
                    backdrop.id = "sidebar-backdrop";
                    document.body.appendChild(backdrop);

                    backdrop.addEventListener("click", function() {
                        sidebar.classList.remove("show");
                        backdrop.remove();
                    });
                } else {
                    document.getElementById("sidebar-backdrop").remove();
                }
            });
        });
    </script>
    @stack('scripts') <!-- Page-specific scripts -->
</body>

</html>