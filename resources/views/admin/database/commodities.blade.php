@extends('layouts.database')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">

@endpush

@section('content')
@include('admin.database.navbar')

<div class="container py-4">
    <!-- Overview -->
    <div class="commodity-overview">

        <!-- Top Action Cards -->
        <h2>Quick Actions</h2>
        <div class="commodity-grid">
            <div class="commodity-card">
                <h3>Graphs</h3>
                <p>View graphical summaries of all commodities.</p>
                <a href="{{ route('admin.database.graphs') }}" class="btn btn-outline mt-3">View Graphs</a>
            </div>

            <div class="commodity-card">
                <h3>All Records</h3>
                <p>Access all commodity research records.</p>
                <a href="{{ route('admin.database.records') }}" class="btn btn-outline mt-3">All Records</a>
            </div>

            <div class="commodity-card">
                <h3>Activities</h3>
                <p>Track all recent database activities.</p>
                <a href="{{ route('admin.database.activity') }}" class="btn btn-outline mt-3">Recent Activities</a>
            </div>

            <div class="commodity-card">
                <h3>IP Applied</h3>
                <p>See all IP-Applied commodity records.</p>
                <a href="{{ route('admin.database.view') }}" target="_blank" class="btn btn-outline mt-3">Visit IP Records</a>
            </div>
        </div>

        <!-- Commodities Overview -->
        <h2 class="mt-5">Commodities Overview</h2>
        <div class="commodity-grid">
            @foreach($commodities as $commodity)
            <div class="commodity-card">
                <h3>{{ $commodity->commodity }}</h3>
                <p>{{ $commodity->total }} research record(s)</p>
                <a href="{{ route('admin.database.commodities.show', ['commodity' => strtolower($commodity->commodity)]) }}" class="btn btn-outline mt-3">View Records</a>
            </div>
            @endforeach
        </div>

        <!-- Include Add Modal -->
        @include('admin.database.modal.add-modal')
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@endsection
