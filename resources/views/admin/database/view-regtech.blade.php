@extends('layouts.database')

@section('title', 'Registered Technologies')

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
        <h1 class="mx-auto text-center">Registered Technologies</h1>
    </div>

    <div class="table-wrapper m-3">
        <table id="registeredTechTable" class="table table-sm table-striped table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Technology</th>
                    <th>Technology Generator</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($regTechs as $tech)
                <tr data-id="{{ $tech->id }}">
                    <td>{{ $tech->technology }}</td>
                    <td>{{ $tech->technology_generator ?? 'N/A' }}</td>
                    <td>{{ $tech->description ?? 'N/A' }}</td>
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

<script>
$(document).ready(function () {
    let table = $('#registeredTechTable').DataTable({
        responsive: false,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        autoWidth: false,
        columnDefs: [
            { orderable: false, targets: -1 } // Actions column not orderable
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search registered technologies..."
        }
    });

});
</script>
@endpush
