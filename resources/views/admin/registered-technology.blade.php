@extends('layouts.admin')

@section('title', 'Manage Applied Records')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    <style>
        td.details-toggle {
            cursor: pointer;
        }

        .arrow-icon {
            margin-right: 6px;
            transition: transform 0.2s ease;
        }

        tr.shown .arrow-icon {
            transform: rotate(90deg);
            /* ▶ turns ▼ */
        }

        .details-row {
            background: #f9f9f9;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <!-- Header -->
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Registered Technology</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $commodities->count() }} total</span>
                    <a href="{{ route('registered.technology.public') }}" class="btn btn-sm btn-dark" target="_blank"
                        title="View Page">
                        <i class="fa fa-eye"></i>
                    </a>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addTechModal">
                        <i class="bi bi-plus-circle"></i> Add Technology
                    </button>

                </div>
            </div>

            <!-- Table -->
            <div class="card-body table-responsive-sm">
                <table id="appliedTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Technology</th>
                            <th>Inventor/s</th>
                            <th>Description of the Product</th>
                            <th>Link</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commodities as $commodity)
                            <tr data-id="{{ $commodity->id }}">
                                <td class="details-toggle" data-full="{{ $commodity->technology ?? '—' }}">
                                    <span class="arrow-icon">▶</span>
                                    {{ Str::limit($commodity->technology ?? '—', 50) }}
                                </td>
                                <td data-full="{{ $commodity->technology_generator ?? '—' }}">
                                    {{ Str::limit($commodity->technology_generator ?? '—', 50) }}
                                </td>
                                <td data-full="{{ $commodity->description ?? '—' }}">
                                    {{ Str::limit($commodity->description ?? '—', 50) }}
                                </td>
                                <td>
                                    @if (!empty($commodity->link))
                                        <a href="{{ $commodity->link }}" target="_blank">View</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm edit-tech" data-id="{{ $commodity->id }}"
                                        data-technology="{{ $commodity->technology }}"
                                        data-generator="{{ $commodity->technology_generator }}"
                                        data-description="{{ $commodity->description }}"
                                        data-link="{{ $commodity->link }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm delete-notif" data-id="{{ $commodity->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No registered records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Add Technology Modal -->
            <div class="modal fade" id="addTechModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="addTechForm">
                            @csrf

                            <div class="modal-header">
                                <h5 class="modal-title">Add Registered Technology</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Technology <span class="text-danger">*</span></label>
                                    <input type="text" name="technology" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Inventor/s</label>
                                    <input type="text" name="technology_generator" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Reference Link</label>
                                    <input type="url" name="link" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Save
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Technology Modal -->
            <div class="modal fade" id="editTechModal" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editTechForm">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="edit_id">

                            <div class="modal-header">
                                <h5 class="modal-title">Edit Registered Technology</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Technology <span class="text-danger">*</span></label>
                                    <input type="text" id="edit_technology" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Inventor/s</label>
                                    <input type="text" id="edit_generator" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea id="edit_description" class="form-control" rows="4"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Reference Link</label>
                                    <input type="url" id="edit_link" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-save"></i> Update
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Cancel
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
        // ADD TECHNOLOGY
        $('#addTechForm').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);

            $.ajax({
                url: "{{ route('admin.registered-technology.store') }}",
                method: "POST",
                data: form.serialize(),
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#addTechModal').modal('hide');
                            form[0].reset();
                            location.reload();
                        });

                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire(
                        'Validation Error',
                        Object.values(xhr.responseJSON.errors).join('<br>'),
                        'error'
                    );
                }
            });
        });
    </script>
    <script>
        // OPEN EDIT MODAL
        $(document).on('click', '.edit-tech', function() {
            $('#edit_id').val($(this).data('id'));
            $('#edit_technology').val($(this).data('technology'));
            $('#edit_generator').val($(this).data('generator'));
            $('#edit_description').val($(this).data('description'));
            $('#edit_link').val($(this).data('link'));

            $('#editTechModal').modal('show');
        });


        // UPDATE TECHNOLOGY
        $('#editTechForm').on('submit', function(e) {
            e.preventDefault();

            let id = $('#edit_id').val();

            $.ajax({
                url: `/admin/registered-technology/${id}`,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    technology: $('#edit_technology').val(),
                    technology_generator: $('#edit_generator').val(),
                    description: $('#edit_description').val(),
                    link: $('#edit_link').val()
                },
                success: function(res) {
                    if (res.success) {
                        Swal.fire({
                            title: 'Updated!',
                            text: res.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#editTechModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire(
                        'Validation Error',
                        Object.values(xhr.responseJSON.errors).join('<br>'),
                        'error'
                    );
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let table = $('#appliedTable').DataTable({
                responsive: false,
                order: [] // disables default ordering, keeps server-side ordering (latest first)
            });

            // Toggle details when clicking on Technology cell
            $('#appliedTable tbody').on('click', 'td.details-toggle', function() {
                let tr = $(this).closest('tr');
                let row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    let tech = tr.find('td:eq(0)').data('full');
                    let inventors = tr.find('td:eq(1)').data('full');
                    let desc = tr.find('td:eq(2)').data('full');

                    row.child(`
                <div class="p-3 details-row">
                    <p><strong>Technology:</strong> ${tech}</p>
                    <p><strong>Inventor/s:</strong> ${inventors}</p>
                    <p><strong>Description:</strong> ${desc}</p>
                </div>
            `).show();
                    tr.addClass('shown');
                }
            });
        });



        // destroy script
        $(document).on('click', '.delete-notif', function() {
            let id = $(this).data('id');
            let row = $(this).closest('tr');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the technology permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/admin/registered-technology/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                row.fadeOut(300, function() {
                                    $(this).remove();
                                });
                                Swal.fire('Deleted!', res.message, 'success');
                            } else {
                                Swal.fire('Error!', res.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
