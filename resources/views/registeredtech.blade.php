@extends('layouts.app')

@section('title', 'KMU | Registered Technology')

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

        /* ---- Table Styling (same as IP-TBM) ---- */
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
            background: forestgreen !important;
            color: #fff !important;
            text-align: center;
        }

        .ip-table td {
            vertical-align: middle;
        }
    </style>
@endpush

@section('content')

    @include('layouts.components.header')
    @include('layouts.components.navbar')

    <section class="container-page-services">
        <div class="iptbm-section py-5" data-aos="fade-up">
            <div class="container text-center">

                <section class="ip-services-section pb-5">
                    <h2 class="section-title mb-5">
                        Technology Business Incubation <br>
                        <span class="title-highlight">Registered Technology</span>
                    </h2>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover ip-table">
                            <thead>
                                <tr>
                                    <th>Technology</th>
                                    <th>Inventor/s</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($technologies as $tech)
                                    <tr>
                                        <td data-label="Technology">
                                            {{ $tech->technology }}
                                        </td>

                                        <td data-label="Inventor/s">
                                            {{ $tech->technology_generator ?? '—' }}
                                        </td>

                                        <td data-label="Description">
                                            {{ $tech->description ?? '—' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">
                                            No registered technologies found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $technologies->links() }}
                        </div>
                    </div>

                    <!-- Footer -->
                    <hr class="mt-5" style="width:70%; margin:0 auto;">
                    <h5 class="text-center section-title my-3">
                        We are glad to <span class="title-highlight">help!</span>
                    </h5>
                    <p class="text-muted text-center">
                        <em>Contact the Sibul TBI Unit for more assistance</em>
                    </p>
                    <p class="text-muted text-center mb-5">
                        <em>tbi@psau.edu.ph</em>
                    </p>
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
