@extends('layouts.app')

@section('title', 'Plagiarsm Scan')

@push('css')

<link rel="stylesheet" href="{{ asset('css/plagscan.css') }}">
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
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
    <h2 class="text-center mb-3 section-title" data-aos="fade-up" data-aos-duration="1500">
        Plagiarism <span class="title-highlight"> Check Roadmap</span>
    </h2>
    <div class="roadmap" data-aos="fade-up" data-aos-duration="1500">
        <div class="step completed">
            <div class="step-circle">1</div>
            <div class="card">
                <h2>Submit via Form, QR, or Email</h2>
                <p>Fill out the Google form <strong><a class="text-decoration-none" style="color: #f85e0a" href="https://docs.google.com/forms/d/e/1FAIpQLSfMYKBGAQRT-RNDej52Xzu7qGVn94pcs9P-_CkxBTRyDYONaQ/viewform">(bit.ly/kmc-plagscan)</a></strong> to request a PlagScan, scan the QR code, or email your paper to <strong>kmc@psau.edu.ph</strong>.</p>
                <div class="qr">
                    <img src="{{ asset('assets/img/qr.png') }}" alt="QR Code" />
                </div>
            </div>
        </div>

        <div class="step completed">
            <div class="step-circle">2</div>
            <div class="card">
                <h2>Wait for KMC Feedback</h2>
                <p>Expect an email from the Knowledge Management Center regarding the similarity index, status of your paper, and your overall score.</p>
            </div>
        </div>

        <div class="step completed">
            <div class="step-circle">3</div>
            <div class="card">
                <h2>Final Check: Approval or Editing</h2>
                <p>If the paper passes the criteria, you’ll be asked to pick up your anti-plagiarism certificate. Otherwise, you’ll receive feedback via email for revisions.</p>
            </div>
        </div>

        <div class="step completed mb-5">
            <div class="step-circle">4</div>
            <div class="card">
                <h2>Final Step: Claim Your Certificate</h2>
                <p>Claim your certificate from the ICTRD office beside the College of Business, Economics and Entrepreneurship (CBEE) building. <br>
                Before we issue the Anti-Plagiarism Testing Certificate, please proceed to the Cashier's Office for your payment:
                <ul>
                    <li><strong>Undergraduate students:</strong> Free</li>
                    <li><strong>Masterate students:</strong> Php 700.00</li>
                    <li><strong>Doctorate students:</strong> Php 1,000.00</li>
                    <li><strong>Non-PSAU clients:</strong> Php 700.00</li>
                </ul>
                   
                <p>Present your student ID and reciept upon claiming for clients who needs to settle payment.</p>
            </div>
        </div>
    </div>


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