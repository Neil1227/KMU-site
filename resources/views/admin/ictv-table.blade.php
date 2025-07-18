@extends('layouts.app')

@section('title', ' ICTV Table Content')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.components.sidebar')

        <!-- Main Content -->
        <div class="col-md-10">
            @include('admin.components.header')

            <div class="container mt-4">
                <div class="card ictv-card mt-4">
                    <div class="card-header text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">ICTV Episodes</h5>
                        
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-light text-dark">{{ $episodes->count() }} total</span>
                            <a href="{{ route('admin.ictv') }}" class="btn btn-sm btn-primary" title="Add New Episode">
                                <i class="bi bi-plus-lg"></i> <!-- Bootstrap Icons -->
                            </a>
                        </div>
                    </div>


                    <div class="card-body table-responsive-sm">
                        <table id="ictvTable" class="display table table-bordered table-striped table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($episodes as $episode)
                                    <tr>
                                        <td>{{ $episode->id }}</td>
                                        <td>{{ $episode->title }}</td>
                                        <td>{{ $episode->description }}</td>
                                        <td>
                                            <a href="{{ $episode->link }}" target="_blank" class="btn btn-sm btn-primary">
                                                View Episode
                                            </a>
                                        </td>

                                        <td>
                                            @if ($episode->png)
                                                <img src="{{ asset('storage/ictv_thumbnail/' . $episode->png) }}" width="60" alt="png">
                                            @else N/A
                                            @endif
                                        </td>
                                        <td>{{ $episode->created_at->format('Y-m-d h:i A') }}</td>
                                        <td>
                                            <!-- Edit Icon Button -->
                                            <a href="#" class="btn btn-sm btn-success" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                                <!-- Delete Icon Button -->
                                                <button type="button"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-id="{{ $episode->id }}"
                                                        title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                        </td>

                                    </tr>
                                @empty
                                    <tr><td colspan="7" class="text-center">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ictvTable').DataTable({
                responsive: true,
                pageLength: 8,
                lengthChange: true, // Allows dropdown
                lengthMenu: [8],    // Only show '8' as the selectable option
                lengthMenu: [5, 8, 10, 15, 20], // Dropdown options
                autoWidth: false,
                order: [[5, 'desc']] // Sort by "Created At"
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the episode.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                    axios.delete(`/admin/ictv/${id}`)
                        .then(response => {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The episode has been deleted.',
                                icon: 'success',
                                timer: 1500, // milliseconds (1.5 seconds)
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // Reload after the timer
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error', 'There was a problem deleting the episode.', 'error');
                            console.error(error);
                        });
                }

            });
        });
    });
    </script>
@endpush

@endsection
