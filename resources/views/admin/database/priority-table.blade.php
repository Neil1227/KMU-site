@extends('layouts.admin')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
@endpush

@section('content')
@include('admin.database.navbar')

<div class="container">
    <h2 class="mt-4 d-flex justify-content-center">
        {{ $priorityArea }} — Commodities Overview
    </h2>

    <div class="commodity-overview">
        <div class="commodity-grid">
            @foreach($commodities as $c)
            @php
                $commodityName = trim($c->commodity);
                $isEmpty = empty($commodityName);
                $isKMU = session('admin_role') === 'KMU';
            @endphp

            <div class="commodity-card">
                <h3>{{ $isEmpty ? 'For Checking' : $commodityName }}</h3>
                <p>{{ $c->total }} research record(s) from {{$priorityArea}} </p>

                @if(!$isEmpty)
                    <a href="{{ route('admin.database.commodities.show', ['commodity' => strtolower($commodityName)]) }}"
                        class="btn btn-outline">
                        View Records
                    </a>
                @else
                    @if($isKMU)
                        <a href="{{ route('admin.database.commodities.show', ['commodity' => 'for-checking']) }}"
                            class="btn btn-outline">
                            View Records
                        </a>
                    @else
                        <span class="btn btn-outline disabled" style="opacity: 0.6; cursor: not-allowed;">
                            View Records
                        </span>
                    @endif
                @endif
            </div>
            @endforeach
        </div>
    </div>

    @include('admin.database.modal.add-modal')
</div>
@endsection

@push('script')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
