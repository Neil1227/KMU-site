@extends('layouts.admin')

@section('title', 'Extension')

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
            <h5 class="mb-0">For Extension</h5>

            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $extensions->count() }} total</span>

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
                    @forelse ($extensions as $extension)
                    <tr>
                        <td>{{ $extension->title }}</td>
                        <td>{{ $extension->authors }}</td>
                        <td>{{ $extension->technology_type }}</td>
                        <td>
                            @if ($extension->link)
                            <a href="{{ $extension->link }}" target="_blank">View</a>
                            @else
                            —
                            @endif
                        </td>
                        <td>{{ $extension->priority_area }}</td>
                        <td>
                            <span class="badge {{ $extension->source === 'KMU Thesis' ? 'bg-success' : 'bg-primary' }}">
                                {{ $extension->source }}
                            </span>
                        </td>
                        <td>{{ $extension->created_at }}</td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-danger delete-extension"
                                data-id="{{ $extension->id }}"
                                title="Delete Extension">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No Extension data found.</td>
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
        // Initialize DataTable
        $('#sampleTable').DataTable({
            responsive: true,
            order: [[6, 'desc']], 
            language: {
                searchPlaceholder: "Search research...",
                search: "",
            }
        });

        // Handle Delete Extension
        $(document).on('click', '.delete-extension', function() {
            const button = $(this);
            const extensionId = button.data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the extension record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/extensions/delete/${extensionId}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Deleted!', response.message, 'success');

                                // Remove row from DataTable
                                const table = $('#sampleTable').DataTable();
                                table.row(button.closest('tr')).remove().draw(false);
                            } else {
                                Swal.fire('Error', response.message, 'error');
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

@endpush