@extends('layouts.database')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
@endpush

@section('content')

@include('admin.database.navbar')

<div class="container">
    <!-- Overview -->
    <div class="card commodity-overview">
        <h2>Technology Summary</h2>
        <!-- Top Action Cards -->
        <div class="commodity-grid" id="actionCards" style="margin-bottom: 1.5rem;">
            <div class="commodity-card">
                <h3>Graphs</h3>
                <p>View graphical summaries</p>
                <a href="" class="btn btn-outline">
                    View Graphs
                </a>
            </div>

            <div class="commodity-card">
                <h3>All Records</h3>
                <p>See all commodity records</p>
                <a href="" class="btn btn-outline">
                    View Records
                </a>
            </div>

            <div class="commodity-card">
                <h3>View Site</h3>
                <p>Go to the public site</p>
                <a href="{{ url('/') }}" target="_blank" class="btn btn-outline">
                    Visit Site
                </a>
            </div>
        </div>

        <!-- Commodity Cards -->
                 <h2>Commodities Overview</h2>
        <div class="commodity-grid" id="commodityGrid">
            @foreach($commodities as $commodity)
            <div class="commodity-card">
                <h3>{{ $commodity->commodity }}</h3>
                <p>{{ $commodity->total }} research record(s)</p>
                <a href="{{ route('admin.database.commodities.show', ['commodity' => strtolower($commodity->commodity)]) }}" class="btn btn-outline">
                    View Records
                </a>
            </div>
            @endforeach
        </div>

        <!-- Include Modal Here -->
        @include('admin.database.modal.add-modal')
    </div>
</div>


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



@endpush

@endsection
