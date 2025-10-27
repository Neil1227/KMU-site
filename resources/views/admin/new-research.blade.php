@extends('layouts.admin')

@section('title', 'New Research Papers')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">

<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Research Papers</h5>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $researches->count() }} total</span>
            </div>
        </div>

        <div class="card-body table-responsive-sm">
            <table id="sampleTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Thesis Title</th>
                        <th>Thesis Authors</th>
                        <th>Type of Technology</th>
                        <th>Link</th>
                        <th>Priority Area</th>
                        <th>Date Added</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($researches as $research)
                    <tr>
                        <td>{{ $research->title }}</td>
                        <td>{{ $research->authors }}</td>
                        <td>{{ $research->technology_type }}</td>
                        <td>
                            @if ($research->link)
                            <a href="{{ $research->link }}" target="_blank">View</a>
                            @else
                            —
                            @endif
                        </td>
                        <td>{{ $research->priority_area }}</td>
                        <td>{{ $research->created_at }}</td>
                        <td class="text-center">
                            <button
                                class="btn btn-sm btn-primary"
                                title="push"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No research data found.</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#sampleTable').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: "Search research...",
                search: "",
            }
        });
    });
</script>
@endpush