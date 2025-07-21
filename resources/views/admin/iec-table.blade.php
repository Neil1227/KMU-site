@extends('layouts.admin')

@section('title', 'Upload IEC Content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">IEC Materials</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $iecMaterials->count() }} total</span>
                    <a href="{{ route('admin.iec') }}" class="btn btn-sm btn-primary" title="Add New Episode">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    <a href="{{ route('iec') }}" class="btn btn-sm btn-dark" target="_blank" title="View Page">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="iecTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>PDF File</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($iecMaterials as $material)
                        <tr>
                            <td>{{ $material->id }}</td>
                            <td>{{ $material->title }}</td>
                            <td>{{ $material->description }}</td>
                            
                            <td>
                                @if ($material->file)
                                    <a href="{{ asset('storage/iec_brochure/' . $material->file) }}" target="_blank" class="btn btn-primary btn-sm">
                                        View PDF
                                    </a>
                                @else
                                    <span class="text-muted">No PDF</span>
                                @endif
                            </td>

                            <td>
                                @if ($material->png)
                                    <img src="{{ asset('storage/iec_thumbnail/' . $material->png) }}" width="80" alt="IEC Image">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>

                            <td>{{ $material->created_at->format('Y-m-d h:i A') }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-success edit-iec-btn"
                                        data-id="{{ $material->id }}"
                                        data-title="{{ $material->title }}"
                                        data-description="{{ $material->description }}"
                                        data-file="{{ asset('storage/iec_brochure/' . $material->file) }}"
                                        data-thumbnail-png="{{ asset('storage/iec_thumbnail/' . $material->png) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm delete-iec" data-id="{{ $material->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @include('admin.components.modal-iec')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- DataTable Config -->
<script>
    $(document).ready(function () {
        $('#iecTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[5, 'asc']]
        });
    });
</script>

<!-- drag an drop -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropAreas = document.querySelectorAll(".drop-area");

        dropAreas.forEach(area => {
            const input = area.querySelector(".file-input");

            // Prevent default behavior for drag events
            ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
                area.addEventListener(eventName, e => e.preventDefault());
            });

            // Highlight on dragover
            area.addEventListener("dragover", () => {
                area.classList.add("drag-over");
            });

            area.addEventListener("dragleave", () => {
                area.classList.remove("drag-over");
            });

            area.addEventListener("drop", e => {
                area.classList.remove("drag-over");
                const files = e.dataTransfer.files;
                if (files.length) {
                    input.files = files;

                    // Show selected file name
                    const fileName = files[0].name;
                    area.querySelector(".upload-text").textContent = fileName;
                }
            });

            // Open file dialog on click
            area.addEventListener("click", () => input.click());

            // Update text when file is selected from dialog
            input.addEventListener("change", () => {
                if (input.files.length) {
                    area.querySelector(".upload-text").textContent = input.files[0].name;
                }
            });
        });
    });
</script>

<!-- sweet alert for delete and its function -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-iec').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/iec-materials/${id}`, {
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

                            // Reload after 1.5s (to match Swal timer)
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        })
                        .catch(error => {
                            console.error(error);
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        });
                    }
                });
            });
        });
    });
</script>

<!-- Edit Modal Population for IEC -->
<script>
    $('.edit-iec-btn').on('click', function () {
        const iecId = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        const pdfFile = $(this).data('file');
        const pngFile = $(this).data('thumbnail-png');

        $('#edit_iec_id').val(iecId);
        $('#edit_iec_title').val(title);
        $('#edit_iec_description').val(description);
        $('#editIECForm').attr('action', `/admin/iec/${iecId}`);
        $('#saveEditBtn').attr('data-id', iecId);

        let thumbnailHTML = '';
        let fileHTML = '';

        if (pdfFile) {
            fileHTML += `
                <div style="display:inline-block; text-align:center; margin-right:10px;">
                    <small>PDF</small><br>
                    <a href="${pdfFile}" target="_blank">View PDF</a>
                </div>`;
        }

        if (pngFile) {
            thumbnailHTML += `
                <div style="display:inline-block; text-align:center;">
                    <small>PNG</small><br>
                    <img src="${pngFile}" alt="Thumbnail Preview" width="80" class="img-thumbnail">
                </div>`;
        }

        $('#current_thumbnail').html(thumbnailHTML);
        $('#current_files').html(fileHTML); // Optional, if you keep this section

            $('#editIECModal').modal('show');
    });


</script>

<!-- edit success with timer -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const saveBtn = document.getElementById("saveEditBtn");

        saveBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const form = document.getElementById("editIECForm");
            const formData = new FormData(form);

            formData.append("_method", "PUT");
            const id = saveBtn.getAttribute("data-id");
            const url = `/iec-materials/${id}`;

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
                console.log(data);
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
                console.error("Update error:", error);
                Swal.fire("Error", "Something went wrong while updating.", "error");
            });
        });
    });
</script>



</script>


@endpush

