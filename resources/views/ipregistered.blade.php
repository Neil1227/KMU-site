@extends('layouts.app')

@section('title', 'KMU | IP-TBM Unit')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/iptbm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer-homepage.css') }}">

    <style>
        @media (max-width: 768px) {

            .ip-table thead {
                display: none;
            }

            .ip-table,
            .ip-table tbody,
            .ip-table tr,
            .ip-table td {
                display: block;
                width: 100%;
            }

            .ip-table tr {
                background: #fff;
                margin-bottom: 15px;
                border-radius: 12px;
                padding: 15px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                border: 1px solid #eee;
            }

            .ip-table td {
                padding: 10px 0;
                border: none !important;
            }

            /* Label above each value */
            .ip-table td::before {
                content: attr(data-label);
                display: block;
                font-weight: 600;
                color: #444;
                margin-bottom: 3px;
                font-size: 0.85rem;
            }
        }


        /* ---- Table Styling ---- */
        .ip-table {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: visible !important;
            font-size: .8rem;
        }

        .ip-table th {
            background: var(--secondary-color) !important;
            color: #fff !important;
            text-align: center;
        }

        .ip-table td {
            vertical-align: middle;
        }

        /* ---- Stats Grid ---- */
        .ip-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .ip-stat-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            border: 1px solid #e8e8e8;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            transition: .25s ease-in-out;
        }

        .ip-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
        }

        .ip-stat-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: var(--secondary-color);
            color: #fff;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ip-stat-value {
            font-size: 1.25rem;
            font-weight: bold;
            margin: 0;
        }
    </style>
@endpush

@section('content')

    @include('layouts.components.header')
    @include('layouts.components.navbar')

    <section class="container-page-services">
        <div class="iptbm-section py-5" data-aos="fade-up">
            <div class="container text-center">

                <!-- Section Header -->
                <section class="ip-services-section pb-5">
                    <h2 class="section-title mb-2">
                        Intellectual Property <br>
                        <span class="title-highlight">IP Registration</span>
                    </h2>

                    <!-- Stats Grid -->
                    <div class="ip-stats-grid">
                        <div class="ip-stat-card">
                            <div class="ip-stat-icon"><i class="fas fa-layer-group"></i></div>
                            <h4 class="highlight">Total IP Records</h4>
                            <p class="ip-stat-value">{{ $totalCount }}</p>
                        </div>

                        <div class="ip-stat-card">
                            <div class="ip-stat-icon"><i class="fas fa-copyright"></i></div>
                            <h4 class="highlight">Patent</h4>
                            <p class="ip-stat-value">{{ $patentCount }}</p>
                        </div>

                        <div class="ip-stat-card">
                            <div class="ip-stat-icon"><i class="fas fa-lightbulb"></i></div>
                            <h4 class="highlight">Utility Model</h4>
                            <p class="ip-stat-value">{{ $utilityModelCount }}</p>
                        </div>

                        <div class="ip-stat-card">
                            <div class="ip-stat-icon"><i class="fas fa-ellipsis-h"></i></div>
                            <h4 class="highlight">Others</h4>
                            <p class="ip-stat-value">{{ $othersCount }}</p>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover ip-table">
                            <thead class="text-white">
                                <tr>
                                    <th>Registration No</th>
                                    <th width="300">Title</th>
                                    <th>Inventor</th>
                                    <th width="100">IP Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($registrations as $reg)
                                    <tr>
                                        <td data-label="Registration No">{{ $reg->registration_number }}</td>
                                        <td data-label="Title">{{ $reg->title }}</td>
                                        <td data-label="Inventor">{{ $reg->inventor_owner }}</td>
                                        <td data-label="IP Type">
                                            @if ($reg->ip_type === 'UM')
                                                Utility Model
                                            @else
                                                {{ $reg->ip_type }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No IP records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $registrations->links() }}
                        </div>
                    </div>

                    <!-- Footer Message -->
                    <hr class="mt-5" style="width:70%; margin:0 auto;">
                    <h5 class="text-center section-title my-3" data-aos="fade-up" data-aos-duration="1500">
                        We are glad to <span class="title-highlight">help!</span>
                    </h5>
                    <p class="text-muted text-center"><em>Contact the IP-TBM Unit for more assistance</em></p>
                    <p class="text-muted text-center mb-5"><em>iptbm@psau.edu.ph</em></p>
                </section>

            </div>
        </div>
    </section>

    @include('layouts.components.footer')

@endsection

@push('scripts')
    <script src="{{ asset('assets/js/navbar.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endpush
