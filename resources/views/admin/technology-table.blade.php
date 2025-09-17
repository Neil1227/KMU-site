@extends('layouts.admin')

@section('title', 'Manage Technologies')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Technologies</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $technologies->count() }} total</span>
                    <a href="{{ route('admin.technology') }}" class="btn btn-sm btn-primary" title="Add New Technology">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    <a href="{{ route('technologies.index') }}" class="btn btn-sm btn-dark" target="_blank" title="View Page">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="technologyTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Poster</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technologies as $technology)
                            <tr>
                                <td>{{ $technology->id }}</td>
                                <td>{{ $technology->product }}</td>
                                <td>{{ Str::limit($technology->desc, 50) }}</td>
                                <td>
                                    @if ($technology->poster)
                                        <img src="{{ asset('storage/technologies/' . $technology->poster) }}" width="80" alt="Technology Poster">
                                    @else
                                        <span class="text-muted">No Poster</span>
                                    @endif
                                </td>
                                <td>{{ $technology->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-success btn-sm edit-tech-btn"
                                        data-id="{{ $technology->id }}"
                                        data-product="{{ $technology->product }}"
                                        data-desc="{{ $technology->desc }}"
                                        data-net="{{ $technology->net }}"
                                        data-profit="{{ str_replace('%','',$technology->profit) }}"
                                        data-inventors="{{ implode(',', (array)$technology->inventors) }}"
                                        data-ip_status="{{ $technology->ip_status }}"
                                        data-proposition="{{ implode(',', (array)$technology->proposition) }}"
                                        data-benefits="{{ implode(',', (array)$technology->benefits) }}"
                                        data-image="{{ $technology->image ? asset('storage/technologies/' . $technology->image) : '' }}"
                                        data-poster="{{ $technology->poster ? asset('storage/technologies/' . $technology->poster) : '' }}"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm delete-tech" data-id="{{ $technology->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin.components.modal-technology')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- DataTable Config -->
<script>
    $(document).ready(function () {
        $('#technologyTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[4, 'desc']]
        });
    });
</script>
<!-- Drag and Drop Upload for Technology -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Initialize all drop areas inside the Technology modal
    document.querySelectorAll("#editTechnologyModal .drop-area").forEach(area => {
        const input = area.querySelector(".file-input");
        const text = area.querySelector(".upload-text");

        // Click to open file dialog
        area.addEventListener("click", () => input.click());

        // File input change
        input.addEventListener("change", () => {
            if (input.files.length > 0) {
                text.textContent = input.files[0].name;
            } else {
                text.textContent = "Drag & drop or click to upload";
            }
        });

        // Drag over effect
        area.addEventListener("dragover", e => {
            e.preventDefault();
            area.classList.add("drag-over");
        });

        // Remove effect
        ["dragleave", "drop"].forEach(evt => {
            area.addEventListener(evt, () => area.classList.remove("drag-over"));
        });

        // Handle file drop
        area.addEventListener("drop", e => {
            e.preventDefault();
            const file = e.dataTransfer.files[0];
            if (file) {
                input.files = e.dataTransfer.files;
                text.textContent = file.name;
            }
        });
    });
});
</script>



<!-- Edit Modal Population -->
<script>
    $(document).on('click', '.edit-tech-btn', function () {
        const id = $(this).data('id');
        $('#edit_tech_id').val(id);
        $('#edit_product').val($(this).data('product'));
        $('#edit_desc').val($(this).data('desc'));
        $('#edit_net').val($(this).data('net'));
        $('#edit_profit').val($(this).data('profit'));
        $('#edit_inventors').val($(this).data('inventors'));
        $('#edit_ip_status').val($(this).data('ip_status'));
        $('#edit_proposition').val($(this).data('proposition'));
        $('#edit_benefits').val($(this).data('benefits'));
        $('#editTechnologyForm').attr('action', `/admin/technology/${id}`);

        let images = '';
        if ($(this).data('image')) {
            images += `<div class="d-inline-block text-center me-3">
                          <small>Image</small><br>
                          <img src="${$(this).data('image')}" width="80" class="img-thumbnail">
                       </div>`;
        }
        if ($(this).data('poster')) {
            images += `<div class="d-inline-block text-center">
                          <small>Poster</small><br>
                          <img src="${$(this).data('poster')}" width="80" class="img-thumbnail">
                       </div>`;
        }
        $('#current_tech_images').html(images);
        $('#editTechnologyModal').modal('show');
    });
</script>

<!-- Delete Technology -->
<script>
    document.querySelectorAll('.delete-tech').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the technology.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/technologies/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: data.success || 'Technology deleted successfully.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    })
                    .catch(() => {
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    });
                }
            });
        });
    });
</script>

<!-- SweetAlert for Session Flash -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        showConfirmButton: true
    });
</script>
@endif
@endpush
