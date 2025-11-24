@extends('layouts.app')

@section('title', 'KMU | Updates')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/updates.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
@endpush

@section('content')

    {{-- Header --}}
    @include('layouts.components.header')

    {{-- Navbar --}}
    @include('layouts.components.media-navbar', ['active' => 'updates'])

    @include('layouts.components.generic-background')

    <div class="container">


        <div class="main-grid">

            <!-- Main Content Area -->
            <div class="content-area">
                <div class="filter-buttons mb-3">
                    <button id="btn-all" onclick="setSelectedType('all')" class="filter-btn active">
                        Latest Updates
                    </button>

                    <button id="btn-image" onclick="setSelectedType('image')" class="filter-btn">
                        <i class="bi bi-image"></i> Images
                    </button>

                    <button id="btn-video" onclick="setSelectedType('video')" class="filter-btn">
                        <i class="bi bi-camera-video"></i> Videos
                    </button>

                    <button id="btn-file" onclick="setSelectedType('file')" class="filter-btn">
                        <i class="bi bi-file-earmark"></i> Files
                    </button>

                    <button id="btn-link" onclick="setSelectedType('link')" class="filter-btn">
                        <i class="bi bi-link-45deg"></i> Links
                    </button>
                    <!-- Admin Dropdown -->
                    <select class="form-select ms-auto" id="admin-select" onchange="setAdminFilter(this.value)"
                        style="width:auto;">
                        <option value="all">All Offices</option>
                        <option value="EXTENSION">Extension Office</option>
                        <option value="RESEARCH">Research Office</option>
                        <option value="KMU">KM Office</option>
                        <option value="IPTBM">IPTBM Office</option>
                        <option value="TBI">Sibul-TBI Office</option>
                    </select>
                </div>

                <!-- Posts Grid -->
                <div class="posts-grid" id="posts-grid">
                    @foreach ($posts as $index => $post)
                        <div class="post-card" data-type="{{ $post->type }}"
                            data-admin="{{ $post->admin->role ?? 'Unknown' }}" data-index="{{ $index }}"
                            @if ($index >= 4) style="display: none;" @endif>

                            {{-- MEDIA DISPLAY --}}
                            <div class="post-media-wrapper">
                                @php $firstMedia = $post->media->first(); @endphp

                                @if (($post->type === 'file' || $post->type === 'link') && $firstMedia)
                                    <!-- Single File -->
                                    <a href="{{ asset('storage/' . $firstMedia->url) }}" target="_blank" class="glightbox">
                                        <img src="{{ asset('storage/post/post_thumbnail/fileicon.png') }}" alt="file icon"
                                            class="post-media">
                                    </a>
                                @elseif($firstMedia)
                                    @if ($post->media->count() > 1)
                                        <!-- Multiple media with overlay -->
                                        @php $galleryId = 'post-' . $post->id; @endphp
                                        <div class="post-gallery-wrapper">
                                            <a href="{{ asset('storage/' . $firstMedia->url) }}" class="glightbox"
                                                data-gallery="{{ $galleryId }}">
                                                @if ($firstMedia->type === 'image')
                                                    <img src="{{ asset('storage/' . $firstMedia->url) }}"
                                                        class="post-media" alt="{{ $post->title }}">
                                                @elseif ($firstMedia->type === 'video')
                                                    <video class="post-media" muted loop playsinline>
                                                        <source src="{{ asset('storage/' . $firstMedia->url) }}"
                                                            type="video/mp4">
                                                    </video>
                                                @endif
                                                <div class="image-count-overlay">+{{ $post->media->count() - 1 }}</div>
                                            </a>

                                            @foreach ($post->media->slice(1) as $mediaItem)
                                                <a href="{{ asset('storage/' . $mediaItem->url) }}" class="glightbox"
                                                    data-gallery="{{ $galleryId }}"
                                                    @if ($mediaItem->type === 'video') data-type="video" @endif
                                                    title="{{ $post->title }}" style="display:none;">
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- Single Image or Video -->
                                        @if ($firstMedia->type === 'image')
                                            <a href="{{ asset('storage/' . $firstMedia->url) }}" class="glightbox"
                                                title="{{ $post->title }}">
                                                <img src="{{ asset('storage/' . $firstMedia->url) }}" class="post-media"
                                                    alt="{{ $post->title }}">
                                            </a>
                                        @elseif ($firstMedia->type === 'video')
                                            <a href="{{ asset('storage/' . $firstMedia->url) }}" class="glightbox"
                                                data-type="video" title="{{ $post->title }}">
                                                <video class="post-media" muted loop playsinline>
                                                    <source src="{{ asset('storage/' . $firstMedia->url) }}"
                                                        type="video/mp4">
                                                </video>
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <p class="text-muted">No media available</p>
                                @endif
                            </div>

                            {{-- POST CONTENT --}}
                            <div class="post-content">
                                <h3 class="highlight">{{ $post->title }}</h3>
                                <p>{{ $post->description }}</p>

                                <div class="post-footer">
                                    {{-- Posted By & Time --}}
                                    <div class="post-meta">
                                        {{-- SDG Target Indicators --}}
                                        @if (!empty($post->sdg_target_indicators))
                                            <div class="sdg-indicators mt-1">
                                                <span>SDGs Target Indicators:</span>
                                                @foreach ($post->sdg_target_indicators as $indicator)
                                                    <span>{{ $indicator }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span>
                                            Posted by {{ strtoupper($post->admin->role ?? 'UNKNOWN') }} |
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>

                                    {{-- SDG Tags --}}
                                    <div class="tags">
                                        @if (!empty($post->tags))
                                            @php
                                                $tagIds = is_array($post->tags)
                                                    ? $post->tags
                                                    : explode(',', $post->tags);
                                            @endphp
                                            @foreach ($tagIds as $tagId)
                                                <div class="tag">
                                                    <img src="{{ asset("assets/img/sdgs/{$tagId}.png") }}" class="tag-icon"
                                                        alt="SDG {{ $tagId }}">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div id="no-content-message" class="no-content-card" style="display:none;">
                    <div class="card-content m-auto">
                        <h4>No content available</h4>
                        <p>Please try selecting another office or content type.</p>
                    </div>
                </div>



                @if (count($posts) > 4)
                    <div class="text-center mt-4">
                        <button id="load-more-btn" class="btn btn-primary">Load More</button>
                    </div>
                @endif
            </div>
            <!-- Sidebar -->
            <aside class="sidebar">
                <div class="sidebar-box facebook-pages">
                    <h4 class="highlight">Facebook Pages</h4>
                    <div class="facebook-pages-list">
                        @foreach ($facebookPages as $page)
                            <div class="fb-page-item">
                                <img src="{{ $page['logo'] }}" alt="Page Logo" class="fb-page-logo">
                                <div class="fb-page-info">
                                    <a href="{{ $page['url'] }}" target="_blank" class="fb-page-title">
                                        {{ $page['title'] }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </aside>

        </div>
    </div>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

        <script>
            const filterButtons = document.querySelectorAll(".filter-btn");

            filterButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    // Remove active from all
                    filterButtons.forEach(b => b.classList.remove("active"));
                    // Add active to clicked
                    this.classList.add("active");
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const loadMoreBtn = document.getElementById("load-more-btn");
                const posts = document.querySelectorAll('.post-card');


                let visible = 4; // number of posts initially visible
                const increment = 4; // posts to show per click

                loadMoreBtn.addEventListener("click", function() {
                    let nextVisible = visible + increment;
                    for (let i = visible; i < nextVisible && i < posts.length; i++) {
                        posts[i].style.display = "block";
                    }
                    visible += increment;

                    // Hide button if all posts are visible
                    if (visible >= posts.length) {
                        loadMoreBtn.style.display = "none";
                    }
                });

            });
        </script>

        <script>
            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                autoplayVideos: true, // <-- makes video play automatically in lightbox
            });
        </script>

        <script>
            let selectedType = 'all';
            let selectedAdmin = 'all';

            function setSelectedType(type) {
                selectedType = type;
                applyFilters();
            }

            function setAdminFilter(admin) {
                selectedAdmin = admin;
                applyFilters();
            }

            function applyFilters() {
                const posts = document.querySelectorAll('.post-card');
                let visibleCount = 0;

                posts.forEach(post => {
                    const type = post.dataset.type;
                    const admin = post.dataset.admin;

                    const typeMatch = selectedType === 'all' || type === selectedType;
                    const adminMatch = selectedAdmin === 'all' || admin === selectedAdmin;

                    if (typeMatch && adminMatch) {
                        post.style.display = '';
                        visibleCount++;
                    } else {
                        post.style.display = 'none';
                    }
                });

                // Show / hide fallback message
                const noContentMessage = document.getElementById('no-content-message');
                const loadMoreBtn = document.getElementById('load-more-btn');

                if (visibleCount === 0) {
                    noContentMessage.style.display = 'flex'; // show fallback
                    if (loadMoreBtn) loadMoreBtn.style.display = 'none'; // hide load more
                } else {
                    noContentMessage.style.display = 'none'; // hide fallback
                    if (loadMoreBtn && visibleCount > 4) loadMoreBtn.style.display = 'block'; // show load more if needed
                }
            }
        </script>
    @endpush

    {{-- Footer --}}
    @include('layouts.components.sub-footer')

@endsection
