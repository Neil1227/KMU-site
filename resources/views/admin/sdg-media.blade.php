@extends('layouts.admin')

@section('title', 'SDG Media Upload')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">

<style>
    .preview-img {
        width: 90px;
        height: auto;
        border-radius: 6px;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">

    {{-- ===========================
         DATA TABLE
    ============================ --}}
    <div class="card shadow-sm">

        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-flask me-2"></i>SDG Activities</h5>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $media->count() }} total</span>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="bi bi-upload me-1"></i> Add Media
                </button>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table id="mediaTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>SDG #</th>
                        <th>Title</th>
                        <th>Target Indicator</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($media as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->image) }}" class="preview-img"></td>
                            <td>SDG {{ $item->sdg->sdg_number }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->sdg_targets }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary editBtn"
                                    data-id="{{ $item->id }}"
                                    data-title="{{ $item->title }}"
                                    data-target="{{ $item->sdg_targets }}"
                                    data-sdg="{{ $item->sdg_id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn"
                                    data-id="{{ $item->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- ===========================
     UPLOAD MODAL
=========================== --}}
<div class="modal fade" id="uploadModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Upload SDG Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">SDG Number</label>
                            <select name="sdg_id" class="form-select" required>
                                <option value="" hidden>Select...</option>
                                @foreach ($sdgs as $sdg)
                                    <option value="{{ $sdg->id }}">
                                        SDG {{ $sdg->sdg_number }} - {{ $sdg->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">SDG Targets (optional)</label>
                            <input type="text" name="sdg_targets" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Upload Image</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="uploadBtn">Upload</button>
            </div>

        </div>
    </div>
</div>

{{-- ===========================
     EDIT MODAL
=========================== --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit SDG Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="editId">

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">SDG Number</label>
                            <select name="sdg_id" id="editSdg" class="form-select" required>
                                @foreach ($sdgs as $sdg)
                                    <option value="{{ $sdg->id }}">SDG {{ $sdg->sdg_number }} - {{ $sdg->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="editTitle" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">SDG Targets</label>
                            <input type="text" name="sdg_targets" id="editTarget" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Upload New Image (optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" id="editBtn">Save Changes</button>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#mediaTable').DataTable({
        responsive: true,
        pageLength: 10,
        language: { search: "Search:", lengthMenu: "Show _MENU_ entries" }
    });
});

// ========================
//  AJAX UPLOAD
// ========================
$('#uploadBtn').click(function(e) {
    e.preventDefault();
    let formData = new FormData($('#uploadForm')[0]);

    $.ajax({
        url: "{{ route('admin.sdg.media.store') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(res) {
            Swal.fire({
                icon: "success",
                title: "Uploaded!",
                text: "SDG Media uploaded successfully.",
                timer: 1500,
                showConfirmButton: false
            });
            $('#uploadModal').modal('hide');
            $('#uploadForm')[0].reset();
            setTimeout(() => location.reload(), 1200);
        },
        error: function(xhr) {
            if(xhr.status === 422){
                let errors = xhr.responseJSON.errors;
                let msg = "";
                Object.keys(errors).forEach(key => { msg += errors[key][0] + "<br>"; });
                Swal.fire({ icon: "error", title: "Upload Failed", html: msg });
            }else{
                Swal.fire({ icon: "error", title: "Server Error", text: "Something went wrong." });
            }
        }
    });
});

// ========================
//  EDIT BUTTON
// ========================
$('.editBtn').click(function() {
    let row = $(this).closest('tr');
    $('#editId').val($(this).data('id'));
    $('#editTitle').val($(this).data('title'));
    $('#editTarget').val($(this).data('target'));
    $('#editSdg').val($(this).data('sdg'));
    $('#editModal').modal('show');
});

$('#editBtn').click(function(e){
    e.preventDefault();
    let id = $('#editId').val();
    let formData = new FormData($('#editForm')[0]);
    $.ajax({
        url: `/admin/sdg/media/${id}`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: { 'X-HTTP-Method-Override': 'PUT' },
        success: function(res){
            Swal.fire({ icon: "success", title: "Updated!", timer: 1200, showConfirmButton: false });
            $('#editModal').modal('hide');
            setTimeout(() => location.reload(), 1200);
        },
        error: function(xhr){
            Swal.fire({ icon: "error", title: "Update Failed", text: "Please try again." });
        }
    });
});

// ========================
//  DELETE BUTTON
// ========================
$('.deleteBtn').click(function(){
    let id = $(this).data('id');
    Swal.fire({
        icon: 'warning',
        title: 'Delete this media?',
        text: "This action cannot be undone!",
        showCancelButton: true,
        confirmButtonText: 'Yes, delete',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url: `/admin/sdg/media/${id}`,
                type: 'POST',
                data: { _method: 'DELETE', _token: "{{ csrf_token() }}" },
                success: function(res){
                    Swal.fire({ icon: "success", title: "Deleted!", timer: 1200, showConfirmButton: false });
                    setTimeout(() => location.reload(), 800);
                },
                error: function(){
                    Swal.fire({ icon: "error", title: "Delete Failed", text: "Please try again." });
                }
            });
        }
    });
});
</script>
@endpush
