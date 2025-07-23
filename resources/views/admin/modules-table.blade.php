@extends('layouts.admin')

@section('title', 'Upload Module Content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card ictv-card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Learning Modules</h5>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $modules->count() }} total</span>
                <a href="{{ route('admin.modules') }}" class="btn btn-sm btn-primary" title="Add New Episode">
                    <i class="bi bi-plus-lg"></i>
                </a>
                <a href="{{ route('modules') }}" class="btn btn-sm btn-dark" target="_blank" title="View Page">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>

        <div class="card-body table-responsive-sm">
            <table id="moduleTable" class="display table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>PDF File</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->title }}</td>
                        <td>
                            @if ($module->file)
                                <a href="{{ asset('storage/modules/' . $module->file) }}" target="_blank" class="btn btn-primary btn-sm">View PDF</a>
                            @else
                                <span class="text-muted">No PDF</span>
                            @endif
                        </td>
                        <td>
                            @if ($module->png)
                                <img src="{{ asset('storage/modules_thumbnail/' . $module->png) }}" width="80" alt="Module Image">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $module->created_at->format('Y-m-d h:i A') }}</td>
                                                    <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-success edit-module-btn"
                                        data-id="{{ $module->id }}"
                                        data-title="{{ $module->title }}"
                                        data-file="{{ asset('storage/modules/' . $module->file) }}"
                                        data-thumbnail-png="{{ asset('storage/modules_thumbnail/' . $module->png) }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>


                                    <!-- Delete Button -->
                                    <button class="btn btn-danger btn-sm delete-module" data-id="{{ $module->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @include('admin.components.modal-module')
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- table config -->
<script>
    $(document).ready(function () {
        $('#moduleTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[4, 'desc']]
        });
    });
</script>
<!--edit  Drag & Drop Upload -->
<script>
    document.querySelectorAll('.drop-area').forEach(area => {
        const input = area.querySelector('.file-input');
        const text = area.querySelector('.upload-text');

        area.addEventListener('click', () => input.click());

        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                text.textContent = input.files[0].name;
            }
        });

        area.addEventListener('dragover', e => {
            e.preventDefault();
            area.classList.add('drag-over');
        });

        area.addEventListener('dragleave', () => {
            area.classList.remove('drag-over');
        });

        area.addEventListener('drop', e => {
            e.preventDefault();
            area.classList.remove('drag-over');

            const droppedFile = e.dataTransfer.files[0];
            if (droppedFile) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(droppedFile);
                input.files = dataTransfer.files;
                text.textContent = droppedFile.name;
            }
        });
    });
</script>
<!-- Edit Modal Population for Modules -->
<script>
    $('.edit-module-btn').on('click', function () {
        const moduleId = $(this).data('id');
        const title = $(this).data('title');
        const pdfFile = $(this).data('file');
        const pngFile = $(this).data('thumbnail-png');

        $('#edit-id').val(moduleId); // fixed id
        $('#edit_module_title').val(title);
        $('#editModuleForm').attr('action', `/admin/modules/${moduleId}`);

        let fileHTML = '';
        let thumbnailHTML = '';

        if (pdfFile) {
            fileHTML = `
                <div style="display:inline-block; text-align:center; margin-right:10px;">
                    <small>PDF</small><br>
                    <a href="${pdfFile}" target="_blank">View PDF</a>
                </div>`;
        }

        if (pngFile) {
            thumbnailHTML = `
                <div style="display:inline-block; text-align:center;">
                    <small>PNG</small><br>
                    <img src="${pngFile}" alt="Thumbnail Preview" width="80" class="img-thumbnail">
                </div>`;
        }

        $('#current_module_file').html(fileHTML);
        $('#current_module_thumbnail').html(thumbnailHTML);

        $('#editModuleModal').modal('show');
    });

</script>

<!-- edit success with timer for MODULE using axios -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const saveBtn = document.getElementById("saveEditBtn");

        saveBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const form = document.getElementById("editModuleForm");
            const formData = new FormData(form);
            const id = document.getElementById("edit-id").value;

            formData.append('_method', 'PUT');

            axios.post(`/admin/modules/${id}`, formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then(response => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.data.message,
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                console.error("Update error:", error.response || error);
                Swal.fire("Error", "Something went wrong while updating.", "error");
            });
        });
    });

</script>



<!-- sweet alert for delete and its function (Modules) -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-module').forEach(button => {
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
                        fetch(`/admin/modules/${id}`, {
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
                            console.error(error);
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        });
                    }
                });
            });
        });
    });
</script>


@endpush
