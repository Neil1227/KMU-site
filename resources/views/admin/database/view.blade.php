@extends('layouts.database')

@section('title', 'View Commodities')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/dark/1.13.6/css/dataTables.dark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
@endpush

@section('content')
<div class="container">
    @include('admin.database.navbar')

<div class="header pt-5 mb-5 d-flex align-items-center position-relative">
    @if(session('admin_logged_in'))
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back position-absolute start-0">← Back</a>
    @endif
    <h1 class="mx-auto text-center">View Commodities</h1>
</div>


    <div class="table-wrapper m-3">
        <table id="viewCommoditiesTable" class="table table-sm table-striped table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Commodity</th>
                    <th>Thesis Title</th>
                    <th>Technologies</th>
                    <th>Technology Generator</th>
                    <th>Type of Technology</th>
                    <th>IP Status</th>
                    <th>SDGs</th>
                    <th>Priority Area</th>

                </tr>
            </thead>
            <tbody>
                @foreach($commodities as $commodity)
                <tr data-id="{{ $commodity->id }}">
                    <td>{{ $commodity->commodity }}</td>
                    <td>{{ $commodity->thesis_title }}</td>
                    <td>{{ $commodity->technologies }}</td>
                    <td>{!! $commodity->technology_generator !!}</td>
                    @php
                        $techClasses = [
                            'Food' => 'badge-tech-food',
                            'Non-Food' => 'badge-tech-nonfood',
                            'N/A' => 'badge-tech-na',
                            'Non-Food (Chemical)' => 'badge-tech-nonfood-chemical',
                            'Non-Food (Software)' => 'badge-tech-nonfood-software',
                            'Non-Food (Equipment)' => 'badge-tech-nonfood-equipment',
                        ];
                    @endphp

                    <td>
                        @if(!empty($commodity->type_of_technology))
                            <span class="badge {{ $techClasses[$commodity->type_of_technology] ?? 'badge-tech-na' }}">
                                {{ $commodity->type_of_technology }}
                            </span>
                        @endif
                    </td>

                    <td>
                        @if($commodity->ip_status === 'IP Applied')
                            <span class="badge badge-ip-applied">{{ $commodity->ip_status }}</span>
                        @endif
                    </td>
                    <td>{{ $commodity->sdgs }}</td>
                    <td>{{ $commodity->priority_area }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/dark/1.13.6/js/dataTables.dark.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#viewCommoditiesTable').DataTable({
        responsive: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        autoWidth: false,
        columnDefs: [
            { orderable: false, targets: -1 } // Actions column not orderable
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search commodities..."
        }
    });
});
</script>
@endpush
