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
                        @foreach ($technologies as $technology)
                        <tr>
                            <td>{{ $technology->id }}</td>
                            <td>{{ $technology->product }}</td>
                            <td>{{ Str::limit($technology->desc, 50) }}</td>

                            <td>
                                @if ($technology->image)
                                    <img src="{{ asset('storage/technologies/' . $technology->poster) }}" width="80" alt="Technology Image">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $technology->created_at->format('Y-m-d h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-success edit-tech-btn"
                                        data-id="{{ $technology->id }}"
                                        data-title="{{ $technology->title }}"
                                        data-description="{{ $technology->description }}"
                                        data-image="{{ asset('storage/technologies/' . $technology->poster) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm delete-tech" data-id="{{ $technology->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Technology Edit Modal --}}

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

<!-- Edit Modal Population for Technology -->
<script>
    $('.edit-tech-btn').on('click', function () {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        const imageFile = $(this).data('image');

        $('#edit_tech_id').val(id);
        $('#edit_tech_title').val(title);
        $('#edit_tech_description').val(description);
        $('#editTechForm').attr('action', `/admin/technology/${id}`);
        $('#saveEditTechBtn').attr('data-id', id);

        let imageHTML = '';

        if (imageFile) {
            imageHTML += `
                <div style="display:inline-block; text-align:center;">
                    <small>Image</small><br>
                    <img src="${imageFile}" alt="Technology Preview" width="80" class="img-thumbnail">
                </div>`;
        }

        $('#current_tech_image').html(imageHTML);

        $('#editTechModal').modal('show');
    });
</script>

<!-- Save Edit with AJAX -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const saveBtn = document.getElementById("saveEditTechBtn");

        saveBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const form = document.getElementById("editTechForm");
            const formData = new FormData(form);

            formData.append("_method", "PUT");
            const id = saveBtn.getAttribute("data-id");
            const url = `/technologies/${id}`;

            fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
            })
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    console.error("Server Error (HTML):", text);
                    throw new Error("Update failed");
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire("Error", "Something went wrong while updating.", "error");
            });
        });
    });
</script>

<!-- Delete Technology -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-tech').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');

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
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.success,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        });
                    }
                });
            });
        });
    });
</script>
@endpush
