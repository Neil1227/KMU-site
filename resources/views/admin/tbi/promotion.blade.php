@extends('layouts.admin')

@section('title', 'Manage Promotion & Development Records')

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
        <div class="card ictv-card mt-4">

            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Promotion & Development Records</h5>
                <span class="badge bg-light text-dark">{{ $promotionRecords->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="promotionTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Thesis Title</th>
                            <th>Technologies</th>
                            <th>Technology Generator</th>
                            <th>Type of Technology</th>
                            <th>Contact Info</th>
                            <th>Remarks</th>
                            <th>Link</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($promotionRecords as $promo)
                            <tr data-id="{{ $promo->id }}">
                                <td>{{ $promo->thesis_title ?? '—' }}</td>
                                <td>{{ $promo->technologies ?? '—' }}</td>
                                <td>{{ $promo->technology_generator ?? '—' }}</td>
                                <td>{{ $promo->type_of_technology ?? '—' }}</td>
                                <td>{{ Str::limit($promo->contact_info ?? '—', 50) }}</td>
                                <td>{{ Str::limit($promo->remarks ?? '—', 50) }}</td>

                                <td>
                                    @if ($promo->link)
                                        <a href="{{ $promo->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Actions
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item text-warning edit-record"
                                                    data-id="{{ $promo->id }}"
                                                    data-thesis_title="{{ $promo->thesis_title }}"
                                                    data-technologies="{{ $promo->technologies }}"
                                                    data-technology_generator="{{ $promo->technology_generator }}"
                                                    data-type_of_technology="{{ $promo->type_of_technology }}"
                                                    data-contact_info="{{ $promo->contact_info }}"
                                                    data-remarks="{{ $promo->remarks }}" data-link="{{ $promo->link }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>

                                            <li>
                                                <button class="dropdown-item text-danger delete-notif"
                                                    data-url="{{ route('admin.promotion.destroy', $promo->id) }}">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <!-- Edit Promotion Modal -->
                <div class="modal fade" id="editPromotionModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <form id="editPromotionForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Promotion / Development Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">

                                    <!-- Hidden ID -->
                                    <input type="hidden" id="editPromotionId" name="id">

                                    <div class="row g-3">

                                        <!-- Thesis Title -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Thesis Title</label>
                                            <input type="text" class="form-control" id="edit_thesis_title"
                                                name="thesis_title">
                                        </div>

                                        <!-- Technologies -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Technologies</label>
                                            <textarea class="form-control" id="edit_technologies" name="technologies" rows="2"></textarea>
                                        </div>

                                        <!-- Technology Generator -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Technology Generator</label>
                                            <input type="text" class="form-control" id="edit_technology_generator"
                                                name="technology_generator">
                                        </div>

                                        <!-- Type of Technology -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Type of Technology</label>
                                            <input type="text" class="form-control" id="edit_type_of_technology"
                                                name="type_of_technology">
                                        </div>

                                        <!-- Contact Info -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Contact Info</label>
                                            <input type="text" class="form-control" id="edit_contact_info"
                                                name="contact_info">
                                        </div>

                                        <!-- Remarks -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold">Remarks</label>
                                            <input type="text" class="form-control" id="edit_remarks" name="remarks">
                                        </div>

                                        <!-- Link -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold">Link</label>
                                            <input type="text" class="form-control" id="edit_link" name="link">
                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary">Update Record</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // ==========================
            // INITIALIZE DATATABLE
            // ==========================
            $('#promotionTable').DataTable({
                responsive: true
            });


            // ==========================
            // EDIT RECORD
            // ==========================
            $(document).on('click', '.edit-record', function() {

                // Reset form
                $('#editPromotionForm')[0].reset();

                const id = $(this).data('id');
                $('#editPromotionId').val(id);

                // Populate modal fields matching your Promotion model
                $('#edit_thesis_title').val($(this).data('thesis_title'));
                $('#edit_technologies').val($(this).data('technologies'));
                $('#edit_technology_generator').val($(this).data('technology_generator'));
                $('#edit_type_of_technology').val($(this).data('type_of_technology'));
                $('#edit_contact_info').val($(this).data('contact_info'));
                $('#edit_remarks').val($(this).data('remarks'));
                $('#edit_link').val($(this).data('link'));

                // Set form action
                $('#editPromotionForm').attr('action', `/admin/promotion/${id}`);

                // Show modal
                $('#editPromotionModal').modal('show');
            });

            // ==========================
            // DELETE RECORD (SweetAlert)
            // ==========================
            $(document).on('click', '.delete-notif', function() {
                const url = $(this).data('url');

                Swal.fire({
                    title: "Delete Record?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(url)
                            .then(() => {
                                Swal.fire("Deleted!", "Record has been deleted.", "success")
                                    .then(() => location.reload());
                            })
                            .catch(() => {
                                Swal.fire("Error", "Unable to delete record.", "error");
                            });
                    }
                });
            });

        });
    </script>
@endpush
