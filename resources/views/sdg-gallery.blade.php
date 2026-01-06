@extends('layouts.app')

@section('title', "KMU | SDG {$sdgData->sdg_number} Activities")

@push('css')
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sdg.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
@endpush



@section('content')
    @include('layouts.components.header')
    @include('layouts.components.navbar')

    <h2 class="text-center my-4 section-title sdgs-{{ $sdgData->sdg_number }}" data-aos="fade-up">
        SDG {{ $sdgData->sdg_number }} – {{ $sdgData->title }} <br> Activities
    </h2>


    {{-- SDG Number Pagination --}}
    <div class="sdg-pagination">
        <a href="{{ url()->previous() }}" class="sdg-page-item back-btn">
            &laquo;
        </a>
        @for ($i = 1; $i <= 17; $i++)
            <a href="{{ route('sdg.show', $i) }}"
                class="sdg-page-item sdg-{{ $i }} {{ $i == $sdgData->sdg_number ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>


    <div class="gallery-grid" id="gallery-grid">

        {{-- Fallback if no gallery content --}}
        @if (count($galleryImages) === 0)
            <div class="no-content-card">
                <h4>No SDG Activities Uploaded Yet</h4>
                <p>Please check back soon for updates.</p>
            </div>
        @else
            @foreach ($galleryImages as $index => $item)
                <div class="gallery-card" @if ($index >= 6) style="display: none;" @endif>
                    <a href="{{ $item['image'] }}" class="glightbox" data-title="{{ $item['title'] }}"
                        data-description="{{ $item['sdg-targets'] }}">
                        <img src="{{ $item['image'] }}" alt="Gallery Image">
                    </a>

                    <div class="gallery-overlay">
                        <div class="overlay-text mb-2">
                            <span class="overlay-title">SDG {{ $sdgData->sdg_number }} – {{ $sdgData->title }}: <br>
                                {{ $item['title'] }}
                            </span>
                            <p class="overlay-target">{{ $item['sdg-targets'] }}</p>
                        </div>

                        <img class="overlay-icon" src="{{ asset('assets/img/sdgs/' . $sdgData->sdg_number . '.png') }}"
                            alt="SDG Icon">
                    </div>
                </div>
            @endforeach
        @endif

    </div>


    <div class="gallery-btn text-center mb-5">
        @if (count($galleryImages) > 6)
            @php
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

            <button id="loadMoreBtn" class="view-gallery-link"
                style="background: {{ $sdgColors[$sdgData->sdg_number] ?? '#000' }}; border:none">
                Load More
            </button>
        @endif
    </div>


    @include('layouts.components.footer')

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Load More functionality
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const galleryCards = document.querySelectorAll('#gallery-grid .gallery-card');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', () => {
                    const hiddenItems = Array.from(galleryCards).filter(card => card.style.display ===
                        'none');
                    for (let i = 0; i < 6 && i < hiddenItems.length; i++) {
                        hiddenItems[i].style.display = 'block';
                    }

                    if (hiddenItems.length <= 6) {
                        loadMoreBtn.style.display = 'none';
                    }
                });
            }

            // Initialize GLightbox
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const galleryCards = document.querySelectorAll('#gallery-grid .gallery-card');
            let itemsToShow = 6;

            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', () => {
                    const hiddenItems = Array.from(galleryCards).filter(card => card.style.display ===
                        'none');
                    for (let i = 0; i < 6 && i < hiddenItems.length; i++) {
                        hiddenItems[i].style.display = 'block';
                    }

                    // Hide button if no more hidden items
                    if (hiddenItems.length <= 6) {
                        loadMoreBtn.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endpush
