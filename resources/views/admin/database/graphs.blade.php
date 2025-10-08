@extends('layouts.database')

@section('title', 'Graphs & Analytics')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<style>
    /* Chart card styling */
    .chart-card {
        max-width: 450px;
        width: 100%;
        margin: 0 auto;
        padding: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
    }

    /* All other charts */
    .chart-card canvas {
        width: 90% !important;
        height: 350px !important;
        display: block;
        /* make canvas a block element */
        margin: 0 auto;
        /* center it horizontally */
    }

    /* Only Commodity chart */
    .commodity-chart-card {
        max-width: 100%;
        /* occupy full width */
    }

    .commodity-chart-card canvas {
        height: 500px !important;
        /* taller */
    }
</style>

@endpush

@section('content')
@include('admin.database.navbar')
<div class="container">


    <div class="header pt-5 mb-5 d-flex align-items-center position-relative">
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back position-absolute start-0">← Back</a>
        <h1 class="mx-auto text-center">Graphs & Analytics</h1>
    </div>

    <div class="row chart-row">
        <!-- Records by Commodity -->
        <div class="col-12 mb-4 d-flex justify-content-center mb-5">
            <div class="chart-card commodity-chart-card">
                <h5 class="card-title text-center">Records by Commodity</h5>
                <canvas id="commodityChart"></canvas>
            </div>
        </div>
    </div>


    <div class="row chart-row">
        <!-- Type of Technology -->
        <div class="col-md-6 mb-4 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="card-title text-center mb-2">Records by Type of Technology</h5>
                <canvas id="techTypeChart"></canvas>
            </div>
        </div>

        <!-- IP Status -->
        <div class="col-md-6 mb-4 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="card-title text-center mb-2">Records by IP Status</h5>
                <canvas id="ipStatusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="row chart-row">
        <!-- TRL Level -->
        <div class="col-md-6 mb-4 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="card-title text-center mb-2">Records by TRL Level</h5>
                <canvas id="trlLevelChart"></canvas>
            </div>
        </div>

        <!-- Priority Area -->
        <div class="col-md-6 mb-4 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="card-title text-center mb-2">Records by Priority Area</h5>
                <canvas id="priorityChart"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    window.chartData = {
        commodities: {
            labels: @json($data->keys()),
            values: @json($data->values())
        },
        techTypes: {
            labels: @json($techTypes->keys()),
            values: @json($techTypes->values())
        },
        ipStatuses: {
            labels: @json($ipStatuses->keys()),
            values: @json($ipStatuses->values())
        },
        trlLevels: {
            labels: @json($trlLevels->keys()),
            values: @json($trlLevels->values())
        },
        priorities: {
            labels: @json($priorities->keys()),
            values: @json($priorities->values())
        }
    };
</script>



<script src="{{ asset('js/graphs.js') }}"></script>
@endpush