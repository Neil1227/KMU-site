@extends('layouts.database')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
@endpush

@section('content')
@include('admin.database.navbar')
<!-- Navigation Tabs Section -->


<div class="container">
    <!-- Overview -->
    <h2 class="mt-5 d-flex justify-content-center">Commodities Overview</h2>
    <div class="commodity-overview">

        <!-- Commodities Overview -->
        <div class="commodity-grid">
            @php
            $sortedCommodities = $commodities->sort(function($a, $b) {
            // Always put "For Checking" first
            if ($a->commodity === 'For Checking') return -1;
            if ($b->commodity === 'For Checking') return 1;

            // Otherwise, sort by updated_at descending
            return strtotime($b->updated_at) <=> strtotime($a->updated_at);
                });
                @endphp

                @foreach($sortedCommodities as $commodity)
                <div class="commodity-card">
                    <h3>{{ $commodity->commodity }}</h3>
                    <p>{{ $commodity->total }} research record(s)</p>
                    <a href="{{ route('admin.database.commodities.show', ['commodity' => strtolower($commodity->commodity)]) }}" class="btn btn-outline mt-3">{{ $commodity->commodity }} Records</a>
                </div>
                @endforeach
        </div>



        <!-- Include Add Modal -->
        @include('admin.database.modal.add-modal')
    </div>
</div>

@push('script')
<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@endsection