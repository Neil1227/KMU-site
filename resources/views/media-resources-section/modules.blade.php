@extends('layouts.app')

@section('title', 'Modules')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/modules.css') }}">
    <link rel="stylesheet" href="{{ asset('css/research.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media-resource-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@endpush

@section('content')

{{-- Header --}}
@include('layouts.components.header')

{{-- Navbar --}}
@include('layouts.components.media-navbar', ['active' => 'modules'])

@include('layouts.components.generic-background')

{{-- Module Viewer Section --}}
<section>
    <div class="container my-5" style="padding-top: 80px;">
        @foreach ($modules as $module)
            <div class="pdf-viewer mb-5">
                <h4><strong>{{ $module['title'] }}</strong></h4>
                <iframe src="{{ asset('assets/files/modules/' . $module['file']) }}" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        @endforeach
    </div>
</section>

{{-- Footer --}}
@include('layouts.components.sub-footer')

@endsection
