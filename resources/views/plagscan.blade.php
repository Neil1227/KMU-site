@extends('layouts.app')

@section('title', 'Plagiarsm Scan')

@push('css')

<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/plagscan.css') }}">
<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">

@endpush

@section('content')
{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.navbar')

<section class="container-page mt-3">
    <h2 class="text-center section-title" data-aos="fade-up" data-aos-duration="1500">
        Plagiarism <span class="title-highlight"> Check Roadmap</span>
    </h2>
    <p class="text-muted text-center  mb-3"><em>Follow these 4 simple steps to get your anti-plagiarism certificate.</em></p>

    <div class="steps-container mb-5">
        <!-- Step 1 -->
        <div class="step-card">
            <div class="step-icon-wrap">
                <div class="step-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="step-number">1</span>
            </div>
            <h4 class="highlight">Submit Your Paper</h4>
            <p class="desc">
            Fill out the Google form, scan the QR code, or email your paper to
            kmc@psau.edu.ph
            </p>
            <div class="qr-box mt-3 p-3">
                <div class="qr-grid">
                <!-- Left: QR Code -->
                <div class="qr-img">
                    <img src="{{ asset('assets/img/qr.png') }}" alt="QR Code">
                </div>
                <!-- Right: Text + Button -->
                <div class="qr-content">
                    <p class="small mb-2">Quick Access</p>
                    <a href="https://docs.google.com/forms/d/e/1FAIpQLSfMYKBGAQRT-RNDej52Xzu7qGVn94pcs9P-_CkxBTRyDYONaQ/viewform?pli=1" target="_blank" class="btn-qr btn-sm text-decoration-none">Open Form</a>
                </div>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        <div class="step-card">
            <div class="step-icon-wrap">
            <div class="step-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <span class="step-number">2</span>
            </div>
            <h4 class="highlight">Receive KMC Feedback</h4>
            <p class="desc">
            Expect an email from the Knowledge Management Center regarding the similarity index, status of your paper, and your overall score.
            </p>
        </div>

        <!-- Step 3 -->
        <div class="step-card">
            <div class="step-icon-wrap">
            <div class="step-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <span class="step-number">3</span>
            </div>
            <h4 class="highlight">Final Review</h4>
            <p class="desc">
            If the paper passes the criteria, you’ll be asked to pick up your anti-plagiarism certificate. Otherwise, you’ll receive feedback via email for revisions.
            </p>
        </div>

        <!-- Step 4 -->
        <div class="step-card">
            <div class="step-icon-wrap">
            <div class="step-icon">
                <i class="fas fa-certificate"></i>
            </div>
            <span class="step-number">4</span>
            </div>
            <h4 class="highlight">Claim Certificate</h4>
            <p class="desc">
            Visit ICTRD office beside CBEE building. <strong> Before we issue the Anti-Plagiarism Testing Certificate, please pay fees at Cashier’s Office if applicable.</strong>
            </p>

            <div class="fees small">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Undergraduate students</span>
                    <span class="badge free small">Free</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Masterate students</span>
                    <span class="badge paid small">₱700.00</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">Doctorate students</span>
                    <span class="badge paid small">₱1,000.00</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted small">Non-PSAU clients</span>
                    <span class="badge paid small">₱700.00</span>
                </div>
                <p class="text-muted small text-center mt-3"><em>Present student ID and receipt upon claiming</em></p>
            </div>
        </div>
    </div>

    <h5 class="text-center section-title" data-aos="fade-up" data-aos-duration="1500">
        Need <span class="title-highlight">help?</span>
    </h5>
    <p class="text-muted text-center"><em>Contact the Knowledge Management Center for assistance</em></p>
    <p class="text-muted text-center mb-5"><em>kmc@psau.edu.ph</em></p>

</section>

{{-- Footer --}}
@include('layouts.components.footer')
@endsection

@push('scripts')
<script src="{{ asset('message.js') }}"></script>
<script src="{{ asset('assets/js/navbar.js') }}"></script>
<script>
    AOS.init();
</script>
@endpush