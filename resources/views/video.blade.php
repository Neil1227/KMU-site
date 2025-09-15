@extends('layouts.app')

@section('title', $title ?? 'Videos')

@push('css')
<link rel="stylesheet" href="{{ asset('css/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/research.css') }}">
<link rel="stylesheet" href="{{ asset('css/video.css') }}">


@endpush

@section('content')
@include('layouts.components.header')
@include('layouts.components.navbar')
@include('layouts.components.generic-background')

<div class="container py-5 video-page flex-grow-1">
    <div class="row">
        {{-- Featured Video --}}
        <div class="col-lg-8">
            @if($featured)
            <h3 class="mb-3 fw-bold text-white">{{ $title }}</h3> <!-- Added section title -->
            <div class="card video-featured shadow-lg mb-4 border-0">
                <div class="ratio ratio-16x9">
                    {!! $featured->link !!}
                </div>

                <div class="card-body">
                    <h4 class="card-title fw-bold">{{ $featured->title }}</h4>
                    <p class="card-text text-muted">{{ $featured->description }}</p>
                </div>
            </div>
            @endif
        </div>

        {{-- Sidebar Playlist --}}
        <div class="col-lg-4 playlist-scrollable" >
            <h5 class="fw-bold mb-3 text-white">Up Next</h5>
            <div class="list-group">
                @foreach($playlist as $item)
                    <a href="{{ route('video.show', ['type' => $type, 'id' => $item->id]) }}"
                    class="list-group-item list-group-item-action d-flex gap-2 align-items-start p-2"
                    style="background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius:8px; border:1px solid rgba(255,255,255,0.3); margin-bottom:0.5rem;">
                    
                        <div class="ratio ratio-16x9" style="width: 160px; background:#000;">
                            @if($type === 'ictv')
                                <img src="{{ asset('storage/ictv_thumbnail/' . $item->png) }}" 
                                    alt="{{ $item->title }}" 
                                    class="img-fluid" 
                                    style="object-fit: cover; width:100%; height:100%;">
                            @elseif($type === 'promo')
                                <img src="{{ asset('storage/promotional_thumbnail/' . $item->png) }}" 
                                    alt="{{ $item->title }}" 
                                    class="img-fluid" 
                                    style="object-fit: cover; width:100%; height:100%;">
                            @endif
                        </div>

                    <div class="flex-grow-1">
                        <h6 class="mb-1 fw-semibold item-title">{{ $item->title }}</h6>
                        <small class="item-date">
                            {{ $item->created_at->diffForHumans() }}
                        </small>
                    </div>

                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

@include('layouts.components.sub-footer')
@endsection
