@extends('layouts.admin')

@section('title', 'Add Research')

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
            <h5 class="mb-0"><i class="bi bi-flask me-2"></i>Add New Research Papers</h5>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $researches->count() }} total</span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addResearchModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Add Research Modal -->
            <div class="modal fade" id="addResearchModal" tabindex="-1" aria-labelledby="addResearchModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title text-white" id="addResearchModalLabel"><i class="bi bi-flask me-2"></i>Add New Research</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.add-thesis.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label fw-bold">Thesis Title</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter thesis title" required>
                                </div>

                                <div class="mb-3">
                                    <label for="authors" class="form-label fw-bold">Thesis Authors</label>
                                    <input type="text" name="authors" id="authors" class="form-control" placeholder="Enter author(s)" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type of Technology</label>
                                    <select name="technology_type" id="technology_type" class="form-select" required>
                                        <option value="" disabled selected>-- Select Type --</option>
                                        <option value="Food">Food</option>
                                        <option value="Non-Food">Non-Food</option>
                                        <option value="N/A">N/A</option>
                                        <optgroup label="Non-Food">
                                            <option value="Non-Food (Chemical)">Non-Food (Chemical)</option>
                                            <option value="Non-Food (Software)">Non-Food (Software)</option>
                                            <option value="Non-Food (Equipment)">Non-Food (Equipment)</option>
                                        </optgroup>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Priority Area</label>
                                    <select name="priority_area" id="priority_area" class="form-select" required>
                                        <option value="" disabled selected>-- Select Type --</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Aquaculture">Aquaculture</option>
                                        <option value="LiveStock">LiveStock</option>
                                        <option value="Livelihood">Livelihood</option>
                                        <option value="Biotechnology">Biotechnology</option>
                                        <option value="Root Crops">Root Crops</option>
                                        <option value="Internet Of Things">Internet Of Things</option>
                                        <option value="Others">Others</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="link" class="form-label fw-bold">Link</label>
                                    <input type="url" name="link" id="link" class="form-control" placeholder="Optional: enter research link (e.g., Google Drive)">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-1"></i> Save Research
                                </button>
                            </div>
                        </form>
                    </div>
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
                                <button class="btn btn-sm btn-danger delete-research" data-id="{{ $research->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No research data found.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#sampleTable').DataTable({
        responsive: true,
        order: [[5, 'desc']], 
        autoWidth: false,
        pageLength: 10,
        order: [[5, 'desc']], // Sort by Date Added (6th column, index 5)
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search research...",
            lengthMenu: "Show _MENU_ entries",
            zeroRecords: "No matching research found",
            info: "Showing _START_ to _END_ of _TOTAL_ research entries",
            infoEmpty: "No entries available",
            infoFiltered: "(filtered from _MAX_ total entries)"
        },
        columnDefs: [
            { orderable: false, targets: [6] } // Disable sorting for "Actions"
        ]
    });
});
</script>

<!-- deleting  -->
 <script>
document.addEventListener('DOMContentLoaded', function () {
    $(document).on('click', '.delete-research', function () {
        const id = $(this).data('id');
        const row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "This research record will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/add-thesis') }}/" + id, // ✅ fixed
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
                                confirmButtonColor: '#198754',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Remove row smoothly
                            row.fadeOut(400, function() {
                                $(this).remove();
                            });
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
});
</script>

<script>
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
</script>

@endpush

@endsection