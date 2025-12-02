@extends('layouts.admin')

@section('title', 'Visitor Profiles')

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
    <div class="card shadow-sm mt-4">
<div class="card-header text-white d-flex justify-content-between align-items-center">
    <h5 class="mb-0"><i class="fa fa-users me-2"></i>Visitor Profiles</h5>
    <div class="d-flex gap-2 align-items-center">

        <!-- Total Count -->
        <span class="badge bg-light text-dark">{{ $demographics->count() }} total</span>

        <!-- Regions Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="regionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Regions
            </button>
            <ul class="dropdown-menu" aria-labelledby="regionsDropdown">
                @foreach($demographics->groupBy('region')->map->count() as $region => $count)
                    <li><span class="dropdown-item">{{ $region }} ({{ $count }})</span></li>
                @endforeach
            </ul>
        </div>

        <!-- Sex Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="sexDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Sex
            </button>
            <ul class="dropdown-menu" aria-labelledby="sexDropdown">
                @foreach($demographics->groupBy('sex')->map->count() as $sex => $count)
                    <li><span class="dropdown-item">{{ ucfirst($sex) }} ({{ $count }})</span></li>
                @endforeach
            </ul>
        </div>

        <!-- Status Dropdown -->
        <div class="dropdown">
            <button class="btn btn-sm btn-warning dropdown-toggle" type="button" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Status
            </button>
            <ul class="dropdown-menu" aria-labelledby="statusDropdown">
                @foreach($demographics->groupBy('status')->map->count() as $status => $count)
                    <li><span class="dropdown-item">{{ ucfirst($status) }} ({{ $count }})</span></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>



        <div class="card-body table-responsive-sm">
            <table id="visitorTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Region</th>
                        <th>Sex</th>
                        <th>Employment Status</th>
                        <th>Date visited</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($demographics as $profile)
                    <tr>
                        <td>{{ $profile->region }}</td>
                        <td>{{ ucfirst($profile->sex) }}</td>
                        <td>{{ ucfirst($profile->status) }}</td>
                        <td>{{ $profile->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger delete-profile" data-id="{{ $profile->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No visitor profiles found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#visitorTable').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        order: [[3, 'desc']], // Sort by Date Submitted
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search visitor profiles...",
            lengthMenu: "Show _MENU_ entries",
            zeroRecords: "No matching visitor profiles found",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries available",
            infoFiltered: "(filtered from _MAX_ total entries)"
        },
        columnDefs: [
            { orderable: false, targets: [4] } // Disable sorting for Actions
        ]
    });

    // Delete functionality
    $(document).on('click', '.delete-profile', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "This visitor profile will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/demographics') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            row.fadeOut(400, function() { $(this).remove(); });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message
                            });
                        }
                    },
                    error: function () {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong while deleting.'
                        });
                    }
                });
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#198754'
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#dc3545'
    });
    @endif
});
</script>
@endpush

@endsection
