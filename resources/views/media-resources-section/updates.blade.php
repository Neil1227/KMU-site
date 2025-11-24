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
            {{-- Content Area --}}
            <div class="content-area">
                <div class="filter-buttons mb-3">
                    <button class="filter-btn active" data-type="all">Latest Updates</button>
                    <button class="filter-btn" data-type="image"><i class="bi bi-image"></i> Images</button>
                    <button class="filter-btn" data-type="video"><i class="bi bi-camera-video"></i> Videos</button>
                    <button class="filter-btn" data-type="file"><i class="bi bi-file-earmark"></i> Files</button>
                    <button class="filter-btn" data-type="text"><i class="bi bi-link-45deg"></i> Links</button>

                    <select class="form-select ms-auto" id="admin-select" style="width:auto;">
                        <option value="all">All Offices</option>
                        <option value="EXTENSION">Extension Office</option>
                        <option value="RESEARCH">Research Office</option>
                        <option value="KMU">KM Office</option>
                        <option value="IPTBM">IPTBM Office</option>
                        <option value="TBI">Sibul-TBI Office</option>
                    </select>
                </div>

                {{-- Posts Grid --}}
                <div class="posts-grid" id="posts-grid">
                    @foreach ($posts as $index => $post)
                        @php
                            $postType = strtolower(trim($post->type ?? 'unknown'));
                            $firstMedia = $post->media->first();
                            $adminRole = strtolower(trim($post->admin->role ?? 'unknown'));
                        @endphp

                        <div class="post-card" 
                             data-type="{{ $postType }}" 
                             data-admin="{{ $adminRole }}" 
                             data-index="{{ $index }}" 
                             @if ($index >= 4) style="display: none;" @endif>

                            {{-- MEDIA DISPLAY --}}
                            <div class="post-media-wrapper">
                                @if(in_array($postType, ['image','video']))
                                    @if($firstMedia)
                                        @if($post->media->count() > 1)
                                            @php $galleryId = 'post-'.$post->id; @endphp
                                            <div class="post-gallery-wrapper">
                                                <a href="{{ asset('storage/'.$firstMedia->url) }}" class="glightbox" data-gallery="{{ $galleryId }}">
                                                    @if($firstMedia->type === 'image')
                                                        <img src="{{ asset('storage/'.$firstMedia->url) }}" class="post-media" alt="{{ $post->title }}">
                                                    @else
                                                        <video class="post-media" muted loop playsinline>
                                                            <source src="{{ asset('storage/'.$firstMedia->url) }}" type="video/mp4">
                                                        </video>
                                                    @endif
                                                    <div class="image-count-overlay">+{{ $post->media->count() - 1 }}</div>
                                                </a>
                                                @foreach($post->media->slice(1) as $mediaItem)
                                                    <a href="{{ asset('storage/'.$mediaItem->url) }}" class="glightbox" 
                                                       data-gallery="{{ $galleryId }}" 
                                                       @if($mediaItem->type==='video') data-type="video" @endif 
                                                       title="{{ $post->title }}" style="display:none;"></a>
                                                @endforeach
                                            </div>
                                        @else
                                            @if($firstMedia->type === 'image')
                                                <a href="{{ asset('storage/'.$firstMedia->url) }}" class="glightbox" title="{{ $post->title }}">
                                                    <img src="{{ asset('storage/'.$firstMedia->url) }}" class="post-media" alt="{{ $post->title }}">
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/'.$firstMedia->url) }}" class="glightbox" data-type="video" title="{{ $post->title }}">
                                                    <video class="post-media" muted loop playsinline>
                                                        <source src="{{ asset('storage/'.$firstMedia->url) }}" type="video/mp4">
                                                    </video>
                                                </a>
                                            @endif
                                        @endif
                                    @else
                                        <p class="text-muted">No media available</p>
                                    @endif
                                @elseif($postType==='file')
                                    <a href="{{ $firstMedia ? asset('storage/'.$firstMedia->url) : '#' }}" target="_blank" class="glightbox">
                                        <img src="{{ asset('assets/img/media_thumbnail/fileicon.png') }}" alt="file icon" class="post-media">
                                    </a>
                                @elseif($postType==='text')
                                    @if(!empty($post->link))
                                        <a href="{{ $post->link }}" target="_blank">
                                            <img src="{{ asset('assets/img/media_thumbnail/linkicon.png') }}" alt="link icon" class="post-media">
                                        </a>
                                    @else
                                        <p class="text-muted">No link available</p>
                                    @endif
                                @else
                                    <p class="text-muted">No media available</p>
                                @endif
                            </div>

                            {{-- POST CONTENT --}}
                            <div class="post-content mt-2">
                                <h3 class="highlight">{{ $post->title }}</h3>
                                <p>{{ $post->description }}</p>
                                <div class="post-footer">
                                    <div class="post-meta">
                                        @if(!empty($post->sdg_target_indicators))
                                            <div class="sdg-indicators mt-1">
                                                <span>SDGs Target Indicators:</span>
                                                @foreach($post->sdg_target_indicators as $indicator)
                                                    <span>{{ $indicator }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                        <span>Posted by {{ strtoupper($post->admin->role ?? 'UNKNOWN') }} | {{ $post->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="tags">
                                        @if(!empty($post->tags))
                                            @php
                                                $tagIds = is_array($post->tags) ? $post->tags : explode(',',$post->tags);
                                            @endphp
                                            @foreach($tagIds as $tagId)
                                                <div class="tag">
                                                    <img src="{{ asset("assets/img/sdgs/{$tagId}.png") }}" class="tag-icon" alt="SDG {{ $tagId }}">
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

                @if(count($posts) > 4)
                    <div class="text-center mt-4">
                        <button id="load-more-btn" class="btn btn-primary">Load More</button>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="sidebar">
                <div class="sidebar-box facebook-pages">
                    <h4 class="highlight">Facebook Pages</h4>
                    <div class="facebook-pages-list">
                        @foreach($facebookPages as $page)
                            <div class="fb-page-item">
                                <img src="{{ $page['logo'] }}" alt="Page Logo" class="fb-page-logo">
                                <div class="fb-page-info">
                                    <a href="{{ $page['url'] }}" target="_blank" class="fb-page-title">{{ $page['title'] }}</a>
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
        document.addEventListener("DOMContentLoaded", function() {
            const posts = document.querySelectorAll('.post-card');
            const filterButtons = document.querySelectorAll(".filter-btn");
            const adminSelect = document.getElementById("admin-select");
            const loadMoreBtn = document.getElementById("load-more-btn");
            const noContentMessage = document.getElementById('no-content-message');

            let selectedType = 'all';
            let selectedAdmin = 'all';
            let visible = 4;
            const increment = 4;

            // Initialize Lightbox
            GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true, autoplayVideos: true });

            // Filter buttons
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedType = this.dataset.type || 'all';
                    applyFilters();
                });
            });

            // Admin dropdown
            adminSelect.addEventListener('change', function() {
                selectedAdmin = this.value.toLowerCase().trim();
                applyFilters();
            });

            // Load More
            if(loadMoreBtn){
                loadMoreBtn.addEventListener('click', function() {
                    let nextVisible = visible + increment;
                    posts.forEach((post,index)=>{
                        if(index>=visible && index<nextVisible){
                            post.style.display='block';
                        }
                    });
                    visible += increment;
                    if(visible >= posts.length) loadMoreBtn.style.display='none';
                });
            }

            function applyFilters(){
                let visibleCount=0;
                posts.forEach(post=>{
                    const type = (post.dataset.type || 'unknown').toLowerCase().trim();
                    const admin = (post.dataset.admin || 'unknown').toLowerCase().trim();
                    const typeMatch = selectedType==='all' || type===selectedType;
                    const adminMatch = selectedAdmin==='all' || admin===selectedAdmin;

                    if(typeMatch && adminMatch){
                        post.style.display='block';
                        visibleCount++;
                    } else {
                        post.style.display='none';
                    }
                });

                // Show/hide fallback
                if(visibleCount===0){
                    noContentMessage.style.display='flex';
                    if(loadMoreBtn) loadMoreBtn.style.display='none';
                } else {
                    noContentMessage.style.display='none';
                    if(loadMoreBtn && visibleCount>4) loadMoreBtn.style.display='block';
                }
            }

            applyFilters(); // initial
        });
        </script>
    @endpush

    {{-- Footer --}}
    @include('layouts.components.sub-footer')

@endsection
