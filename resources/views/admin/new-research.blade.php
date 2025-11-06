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

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $researches->count() }} total</span>

                    <button class="btn btn-sm btn-primary"
                        @if(session('admin_role') !=='KMU' ) disabled @endif
                        title="Add Research"
                        data-bs-toggle="modal"
                        data-bs-target="#addResearchModal">
                        <i class="fa fa-plus"></i>
                    </button>


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
                        <th>Source</th>
                        <th>Date Added</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($researches as $research)
                    <tr>
                        <td>
                            {{ $research->title }}
                        </td>
                        <td>{{ $research->authors }}</td>
                        <td>{{ $research->technology_type }}</td>
                        <td>
                            @if (session('admin_role') === 'KMU')
                            @if ($research->link)
                            <a href="{{ $research->link }}" target="_blank">View</a>
                            @else
                            <em>Restricted Access</em>
                            @endif
                            @else
                            <em>Restricted Access</em>
                            @endif
                        </td>

                        <td>{{ $research->priority_area }}</td>
                        <td>
                            @if($research->source === 'Research')
                            <span class="badge bg-primary">From Research</span>
                            @elseif($research->source === 'KMU Thesis')
                            <span class="badge bg-success">From KMU Thesis</span>
                            @endif
                        </td>
                        <td>{{ $research->created_at }}</td>
                        <td class="text-center">
                            {{-- ✅ Show Acknowledge button if pending --}}
                            @if($research->status === 'pending')
                            <form action="{{ route('admin.new-research.acknowledge', ['id' => $research->id]) }}" method="POST" class="d-inline acknowledge-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" title="Acknowledge this research" data-id="{{ $research->id }}">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            </form>
                            @endif



                            <button
                                class="btn btn-sm btn-primary"
                                title="Push to IPTBM"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>
                            <button
                                class="btn btn-sm btn-success push-to-extension"
                                data-id="{{ $research->id }}"
                                title="Push to Extension"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-box"></i>
                            </button>
                            <button
                                class="btn btn-sm btn-danger delete-research"
                                data-id="{{ $research->id }}"
                                title="Delete Research"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-trash"></i>
                            </button>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No research data found.</td>
                    </tr>
                    @endforelse
                </tbody>


            </table>
        </div>

        <!-- Add Research Modal -->
        <div class="modal fade" id="addResearchModal" tabindex="-1" aria-labelledby="addResearchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title text-white" id="addResearchModalLabel"><i class="bi bi-flask me-2"></i>Add New Research</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.add-thesis.storetokmu') }}" method="POST">
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
                                <label for="technology_type" class="form-label fw-bold">Type of Technology</label>
                                <input type="text" name="technology_type" id="technology_type" class="form-control" placeholder="Enter type of technology" required>
                            </div>

                            <div class="mb-3">
                                <label for="priority_area" class="form-label fw-bold">Priority Area</label>
                                <input type="text" name="priority_area" id="priority_area" class="form-control" placeholder="Enter priority area" required>
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
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


<script>
$(document).ready(function () {
    // Handle Acknowledge form submission
    $(document).on('submit', '.acknowledge-form', function (e) {
        e.preventDefault(); // stop normal form submission

        const form = $(this);
        const id = form.find('button').data('id');

        $.ajax({
            url: `/admin/new-research/${id}/acknowledge`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Acknowledged!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });

                    // ✅ Smooth auto-update of row (no reload)
                    const table = $('#sampleTable').DataTable();
                    const row = form.closest('tr');
                    const rowData = table.row(row).data();

                    // Update the "status" visually — for example, remove button & show "Active"
                    rowData[7] = `<span class="badge bg-success">Acknowledged</span>`;
                    table.row(row).data(rowData).invalidate().draw(false);

                    // Optionally disable the acknowledge button to prevent re-click
                    form.remove();

                } else {
                    Swal.fire('Notice', response.message, 'warning');
                }
            },
            error: function () {
                Swal.fire('Error', 'Something went wrong.', 'error');
            }
        });
    });
});
</script>





<script>
$(document).ready(function() {
    // ✅ Prevent multiple DataTable initializations
    if (!$.fn.DataTable.isDataTable('#sampleTable')) {
        $('#sampleTable').DataTable({
            responsive: true,
            order: [[6, 'desc']],
            language: {
                searchPlaceholder: "Search research...",
                search: "",
            }
        });
    }

    // ✅ Push to Extension logic
    $(document).on('click', '.push-to-extension', function() {
        const button = $(this);
        const researchId = button.data('id');

        Swal.fire({
            title: 'Push to Extension?',
            text: "This will move the research to the Extension list.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, push it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/extensions/push/${researchId}`,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            const table = $('#sampleTable').DataTable();
                            const row = button.closest('tr');
                            const rowData = table.row(row).data();

                            // ✅ Replace actions column with a badge
                            rowData[7] = `
                                <span class="badge bg-success">
                                    <i class="bi bi-box-seam me-1"></i> Pushed to Extension
                                </span>
                            `;

                            // ✅ Update the table instantly
                            table.row(row).data(rowData).invalidate().draw(false);

                        } else {
                            Swal.fire('Notice', response.message, 'warning');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                    }
                });
            }
        });
    });
});
</script>


<!-- Deletion -->
<script>
    $(document).on('click', '.delete-research', function() {
        const button = $(this);
        const id = button.data('id');

        Swal.fire({
            title: 'Delete this record?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/new-research/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');

                            // Remove deleted row
                            const table = $('#sampleTable').DataTable();
                            const row = button.closest('tr');
                            table.row(row).remove().draw(false);
                        } else {
                            Swal.fire('Notice', response.message, 'warning');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete record.', 'error');
                    }
                });
            }
        });
    });
</script>


<script>
    // ✅ SweetAlert for success or error messages after adding research
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('
        success ') }}',
        confirmButtonColor: '#198754'
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('
        error ') }}',
        confirmButtonColor: '#dc3545'
    });
    @endif
</script>


@endpush