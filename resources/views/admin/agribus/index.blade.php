@extends('layouts.admin')

@section('title', 'Manage Agri-Business Applications')

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
                <h5 class="mb-0">Agri-Business Records</h5>
                <span class="badge bg-light text-dark">{{ $agriBusinesses->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="agriBusinessTable" class="table table-bordered table-striped table-sm align-middle nowrap">
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
                        @forelse ($agriBusinesses as $agri)
                            <tr data-id="{{ $agri->id }}">
                                <td>{{ Str::limit($agri->thesis_title ?? '—', 50) }}</td>
                                <td>{{ Str::limit($agri->technologies ?? '—', 50) }}</td>
                                <td>{{ $agri->technology_generator ?? '—' }}</td>
                                <td>{{ $agri->type_of_technology ?? '—' }}</td>
                                <td>{{ Str::limit($agri->contact_info ?? '—', 50) }}</td>
                                <td>{{ Str::limit($agri->remarks ?? '—', 50) }}</td>
                                <td>
                                    @if ($agri->link)
                                        <a href="{{ $agri->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="actionDropdown{{ $agri->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $agri->id }}">
                                            <li>
                                                <button class="dropdown-item text-warning edit-record"
                                                    data-id="{{ $agri->id }}"
                                                    data-thesis_title="{{ $agri->thesis_title }}"
                                                    data-technologies="{{ $agri->technologies }}"
                                                    data-technology_generator="{{ $agri->technology_generator }}"
                                                    data-type_of_technology="{{ $agri->type_of_technology }}"
                                                    data-contact_info="{{ $agri->contact_info }}"
                                                    data-remarks="{{ $agri->remarks }}" data-link="{{ $agri->link }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-success push-to-tlu"
                                                    data-id="{{ $agri->id }}">
                                                    <i class="bi bi-send me-2"></i>Push to TLU
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger delete-notif"
                                                    data-url="{{ route('admin.agri-business.destroy', $agri->id) }}">
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
                <!-- Edit Agri-Business Modal -->
                <div class="modal fade" id="editAgriModal" tabindex="-1" aria-labelledby="editAgriModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="editAgriForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAgriModalLabel">Edit Agri-Business Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="editAgriId" name="id">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="thesis_title" class="form-label">Thesis Title</label>
                                            <input type="text" class="form-control" id="thesis_title"
                                                name="thesis_title">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="technologies" class="form-label">Technologies</label>
                                            <input type="text" class="form-control" id="technologies"
                                                name="technologies">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="technology_generator" class="form-label">Technology
                                                Generator</label>
                                            <input type="text" class="form-control" id="technology_generator"
                                                name="technology_generator">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="type_of_technology" class="form-label">Type of Technology</label>
                                            <input type="text" class="form-control" id="type_of_technology"
                                                name="type_of_technology">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="contact_info" class="form-label">Contact Info</label>
                                            <input type="text" class="form-control" id="contact_info"
                                                name="contact_info">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <input type="text" class="form-control" id="remarks" name="remarks">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="link" class="form-label">Link</label>
                                            <input type="text" class="form-control" id="link" name="link">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Update Record</button>
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
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#agriBusinessTable').DataTable();

            /*** Helper: Show SweetAlert ***/
            const showAlert = (type, title, text, timer = 1500) => {
                return Swal.fire({
                    icon: type,
                    title: title,
                    text: text,
                    timer: timer,
                    showConfirmButton: false
                });
            };

            /*** Delete Record ***/
            const deleteRecord = async (url, tr) => {
                try {
                    const res = await fetch(url, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    });
                    const data = await res.json();
                    if (data.success) {
                        await showAlert('success', 'Deleted!', data.message);
                        table.row(tr).remove().draw();
                    } else {
                        Swal.fire("Error", data.message, "error");
                    }
                } catch (err) {
                    Swal.fire("Error", "Something went wrong.", "error");
                }
            };

            $(document).on('click', '.delete-notif', function() {
                const url = $(this).data('url');
                const tr = $(this).closest('tr');

                Swal.fire({
                    title: "Are you sure?",
                    text: "This will permanently delete the record.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) deleteRecord(url, tr);
                });
            });

            /*** Open Edit Modal ***/
            $(document).on('click', '.edit-record', function() {
                const button = $(this);

                const fields = ['thesis_title', 'technologies', 'technology_generator',
                    'type_of_technology', 'contact_info', 'remarks', 'link'
                ];
                fields.forEach(field => {
                    $(`#${field}`).val(button.data(field));
                });

                $('#editAgriId').val(button.data('id'));
                $('#editAgriForm').attr('action', '/admin/agri-business/' + button.data('id'));
                $('#editAgriModal').modal('show');
            });

            /*** Submit Edit Form via AJAX ***/
            $('#editAgriForm').submit(async function(e) {
                e.preventDefault();
                const form = $(this);
                const id = $('#editAgriId').val();
                const url = form.attr('action');

                try {
                    const res = await fetch(url, {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json",
                            "X-HTTP-Method-Override": "PUT"
                        },
                        body: new FormData(form[0])
                    });

                    let data;
                    try {
                        data = await res.json(); // parse once
                    } catch {
                        return Swal.fire('Error', 'Invalid server response.', 'error');
                    }

                    if (!res.ok) {
                        // HTTP error (422, 500, etc.)
                        return Swal.fire('Error', data.message || 'Something went wrong.', 'error');
                    }

                    if (data.success) {
                        await Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#editAgriModal').modal('hide');

                        // Update table row
                        const row = table.row(`tr[data-id="${id}"]`);
                        row.data([
                            data.data.thesis_title,
                            data.data.technologies,
                            data.data.technology_generator,
                            data.data.type_of_technology,
                            data.data.contact_info,
                            data.data.remarks,
                            data.data.link ?
                            `<a href="${data.data.link}" target="_blank" class="text-decoration-underline">View</a>` :
                            '—',
                            row.data()[7] // keep Actions column
                        ]).draw(false);

                    } else {
                        Swal.fire('Error', data.message || 'Something went wrong.', 'error');
                    }

                } catch (err) {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });



            /*** Push to TLU ***/
            const pushToTLU = async (id) => {
                try {
                    const res = await fetch(`/admin/agri-business/push-to-tlu/${id}`, {
                        method: 'POST',
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    });
                    const data = await res.json();
                    if (data.message) {
                        Swal.fire('Success', data.message, 'success');
                    } else if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                    }
                } catch {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            };

            $(document).on('click', '.push-to-tlu', function() {
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Push to TLU?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, push!'
                }).then((result) => {
                    if (result.isConfirmed) pushToTLU(id);
                });
            });

        });
    </script>
@endpush
