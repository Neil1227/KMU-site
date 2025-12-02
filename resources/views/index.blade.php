<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Home</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/kmlogo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">

    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <style>

    </style>
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
        <video autoplay muted playsinline class="hero-video mt-5">
            <source src="./assets/videos/opener_14-37-44.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <img src="{{ asset('assets/img/KMULOGO.png') }}" alt="Hero Image" class="hero-fallback-img">
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <div class="me-md-3 mb-md-0">
                <!-- IMPORTANT: use data-action to avoid default anchor behavior -->
                <a href="#" data-action="open-demo" class="btn two-tone">Learn More ⇀</a>
            </div>
        </div>
    </div>

    <!-- Demographic Modal -->
    <div id="demoModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="demoTitle" tabindex="-1">
        <div class="modal-content" role="document">
            <button type="button" class="modal-close" aria-label="Close" data-action="close-demo">&times;</button>

            <!-- Form Section -->
            <section id="formSection">
                <h2 id="demoTitle" class="modal-title">Visitor Profile</h2>
                <p class="modal-desc">Please provide your visitor profile to continue.</p>

                <form id="demoForm" novalidate>
                    <div class="mb-2">
                        <input list="regions" name="region" id="region"class="region-search"
                            placeholder="Select your region" required style="width: 100%; font-size:0.85rem;">
                        <datalist id="regions">
                            <option value="NCR – National Capital Region">
                            <option value="CAR – Cordillera Administrative Region">
                            <option value="Region I – Ilocos Region">
                            <option value="Region II – Cagayan Valley">
                            <option value="Region III – Central Luzon">
                            <option value="Region IV-A – CALABARZON">
                            <option value="MIMAROPA Region">
                            <option value="Region V – Bicol Region">
                            <option value="Region VI – Western Visayas">
                            <option value="Region VII – Central Visayas">
                            <option value="Region VIII – Eastern Visayas">
                            <option value="Region IX – Zamboanga Peninsula">
                            <option value="Region X – Northern Mindanao">
                            <option value="Region XI – Davao Region">
                            <option value="Region XII – SOCCSKSARGEN">
                            <option value="Region XIII – Caraga Region">
                            <option value="BARMM – Bangsamoro Autonomous Region in Muslim Mindanao">
                        </datalist>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Sex</label>
                        <div class="radio-group" role="radiogroup" aria-required="true">
                            <label><input type="radio" name="sex" value="male"> Male</label>
                            <label><input type="radio" name="sex" value="female"> Female</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Employment Status</label>
                        <div class="radio-group" role="radiogroup" aria-required="true">
                            <label><input type="radio" name="status" value="government"> Government</label>
                            <label><input type="radio" name="status" value="private"> Private Sector</label>
                            <label><input type="radio" name="status" value="student"> Student</label>
                        </div>
                    </div>
                    <em class="form-note " style="font-size:0.85rem; color:#555; margin-top:8px;">
                        “Your information is safe with us. We only use it to improve your experience on our website and
                        never share it with third parties.”
                    </em>

                    <button type="submit" class="btn two-tone w-100">Submit Profile</button>
                </form>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5">
        <p>&copy; 2025 Pampanga State Agricultural University. All rights reserved.</p>
    </footer>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const demoModal = document.getElementById('demoModal');
            const form = document.getElementById('demoForm');
            const openBtns = document.querySelectorAll('[data-action="open-demo"]');
            const closeBtns = document.querySelectorAll('[data-action="close-demo"]');

            // Helpers
            function openModal() {
                demoModal.classList.add('show');
                document.body.classList.add('modal-open');
                // focus the first control for accessibility
                setTimeout(() => {
                    const first = demoModal.querySelector('select, input');
                    if (first) first.focus();
                }, 50);
            }

            function closeModal() {
                demoModal.classList.remove('show');
                document.body.classList.remove('modal-open');
                // return focus to a sensible element (first open button)
                const firstOpen = document.querySelector('[data-action="open-demo"]');
                if (firstOpen) firstOpen.focus();
            }

            // Open buttons
            openBtns.forEach(btn => {
                btn.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    openModal();
                });
            });

            // Close buttons (X)
            closeBtns.forEach(btn => {
                btn.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    closeModal();
                });
            });

            // Click outside to close
            demoModal.addEventListener('click', (ev) => {
                if (ev.target === demoModal) {
                    closeModal();
                }
            });

            // Keyboard: ESC to close
            document.addEventListener('keydown', (ev) => {
                if (ev.key === 'Escape' && demoModal.classList.contains('show')) {
                    closeModal();
                }
            });

            // FORM SUBMIT
            form.addEventListener('submit', async (ev) => {
                ev.preventDefault();

                const data = {
                    region: document.getElementById('region').value.trim(),
                    sex: document.querySelector('input[name="sex"]:checked')?.value,
                    status: document.querySelector('input[name="status"]:checked')?.value,
                };

                // Basic client validation
                if (!data.region || !data.sex || !data.status) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Incomplete',
                        text: 'Please complete all fields.',
                    });
                    return;
                }

                // Disable submit button while sending
                const submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.textContent = 'Submitting...';

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content');

                    const res = await fetch('/demographic/store', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        body: JSON.stringify(data),
                    });

                    if (!res.ok) {
                        // try to parse JSON error message
                        let errMsg = 'Something went wrong. Please try again.';
                        try {
                            const body = await res.json();
                            if (body?.message) errMsg = body.message;
                        } catch (e) {
                            /* ignore parse errors */
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errMsg
                        });
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit Profile';
                        return;
                    }

                    // Close modal BEFORE showing SweetAlert so alert isn't blocked
                    closeModal();

                    // Show success toast and then redirect
                    await Swal.fire({
                        icon: 'success',
                        title: 'Thank you!',
                        text: 'Your demographic profile has been submitted.',
                        timer: 1700,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });

                    // Small delay to ensure user saw toast
                    setTimeout(() => {
                        window.location.href = '/learn-more';
                    }, 300);

                } catch (error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Network error',
                        text: 'Unable to submit. Please try again.'
                    });
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Profile';
                }
            });
        });
    </script>
</body>

</html>
