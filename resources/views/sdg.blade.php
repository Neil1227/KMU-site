@extends('layouts.app')

@section('title', 'KMU | SDGs')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/sdg.css') }}">
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
    <div class="container mt-5">
        <h2 class="text-center mb-4 section-title" data-aos="fade-up">
            Sustainable Development Goals
            <hr class="hr">
        </h2>

        @php
            // Define SDG colors
            $sdgColors = [
                1 => '#E5243B',
                2 => '#DDA63A',
                3 => '#4C9F38',
                4 => '#C5192D',
                5 => '#FF3A21',
                6 => '#26BDE2',
                7 => '#FCC30B',
                8 => '#A21942',
                9 => '#FD6925',
                10 => '#DD1367',
                11 => '#FD9D24',
                12 => '#BF8B2E',
                13 => '#3F7E44',
                14 => '#0A97D9',
                15 => '#56C02B',
                16 => '#00689D',
                17 => '#19486A',
            ];
        @endphp

        @foreach ($sdgs as $sdg)
            <section class="content-section mb-3" id="sdg{{ $sdg->sdg_number }}">
                @if ($loop->iteration % 2 !== 0)
                    <div class="image-column">
                        <img src="{{ asset("assets/img/sdgs/{$sdg->sdg_number}.png") }}" alt="SDG {{ $sdg->sdg_number }}"
                            class="sdg-icon" />

                        <div class="gallery-btn">
                            <a href="{{ route('sdg.gallery', $sdg->sdg_number) }}" class="view-gallery-link"
                                style="background: {{ $sdgColors[$sdg->sdg_number] ?? '#000' }};">
                                View Activities
                            </a>
                        </div>
                    </div>

                    <div class="text-column">
                        <p>{{ $sdg->description }}</p>
                    </div>
                @else
                    <div class="text-column">
                        <p>{{ $sdg->description }}</p>
                    </div>
                    <div class="image-column">
                        <img src="{{ asset("assets/img/sdgs/{$sdg->sdg_number}.png") }}" alt="SDG {{ $sdg->sdg_number }}"
                            class="sdg-icon" />
                        <div class="gallery-btn">
                            <a href="{{ route('sdg.gallery', $sdg->sdg_number) }}" class="view-gallery-link"
                                style="background: {{ $sdgColors[$sdg->sdg_number] ?? '#000' }};">
                                View Activities
                            </a>
                        </div>
                    </div>
                @endif
            </section>
        @endforeach
    </div>

    @include('layouts.components.footer')
    @push('scripts')
        <script>
            const sections = document.querySelectorAll(".content-section");

            const options = {
                root: null,
                threshold: 0.5, // Trigger when 50% visible
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    const el = entry.target;
                    if (entry.isIntersecting) {
                        el.classList.add("fade-up-in");
                        el.classList.remove("fade-up-out");
                    } else {
                        el.classList.remove("fade-up-in");
                        el.classList.add("fade-up-out");
                    }
                });
            }, options);

            sections.forEach((section) => {
                observer.observe(section);
            });
        </script>

        <script src="{{ asset('js/navbar.js') }}"></script>
    @endpush

@endsection
