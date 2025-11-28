@extends('layouts.admin')

@section('title', 'Student Research | Thesis Papers')

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
        }

        .details-row {
            background: #f9f9f9;
        }

        .dropdown-menu .dropdown-item i {
            font-size: 1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thesis Papers</h5>
                <span class="badge bg-light text-dark">{{ $theses->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="thesisTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Full Name</th>
                            <th width="50">PSAU ID</th>
                            <th>Email</th>
                            <th>Program / College</th>
                            <th>Thesis Details</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($theses as $thesis)
                            @php
                                $graduation =
                                    $thesis->graduation_month && $thesis->graduation_year
                                        ? \Carbon\Carbon::create()->month($thesis->graduation_month)->format('F') .
                                            ' ' .
                                            $thesis->graduation_year
                                        : '—';
                            @endphp
                            <tr data-id="{{ $thesis->id }}">
                                <td>{{ $thesis->fullname }}</td>
                                <td>{{ $thesis->psau_id }}</td>
                                <td>{{ $thesis->email }}</td>
                                <td>{{ $thesis->program }} / {{ $thesis->college }}</td>

                                <td class="details-toggle" data-title="{{ $thesis->thesis_title ?? '—' }}"
                                    data-adviser="{{ $thesis->adviser ?? '—' }}"
                                    data-groupmates="{{ $thesis->groupmates ?? '—' }}"
                                    data-graduation="{{ $graduation }}"
                                    data-graduate="{{ $thesis->graduate_student ? 'Yes' : 'No' }}"
                                    data-file="{{ $thesis->file_path ? asset('storage/' . $thesis->file_path) : '' }}"
                                    data-drive="{{ $thesis->googledrive_link ?? '' }}">
                                    <span class="arrow-icon">▶</span>
                                    {{ Str::limit($thesis->thesis_title ?? '—', 50) }}
                                </td>

                                <td class="text-center">

                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown">
                                            Actions
                                        </button>

                                        <ul class="dropdown-menu">

                                            {{-- Download file if it exists --}}
                                            @if ($thesis->file_path)
                                                <li>
                                                    <a class="dropdown-item text-warning"
                                                        href="{{ asset('storage/' . $thesis->file_path) }}"
                                                        target="_blank">
                                                        <i class="bi bi-download me-2"></i>Download File
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- View in Google Drive if link exists --}}
                                            @if ($thesis->googledrive_link)
                                                <li>
                                                    <a class="dropdown-item text-primary"
                                                        href="{{ $thesis->googledrive_link }}" target="_blank">
                                                        <i class="bi bi-google me-2"></i>View Google Drive
                                                    </a>
                                                </li>
                                            @endif


                                            {{-- Edit --}}
                                            <li>
                                                <button class="dropdown-item text-success"
                                                    onclick="editThesis({{ $thesis->id }})">
                                                    <i class="bi bi-pencil me-2"></i>Edit
                                                </button>
                                            </li>

                                            {{-- Delete --}}
                                            <li>
                                                <button class="dropdown-item text-danger"
                                                    onclick="deleteThesis({{ $thesis->id }})">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </button>
                                            </li>

                                        </ul>
                                    </div>



                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No thesis records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editThesisModal" tabindex="-1" aria-labelledby="editThesisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="editThesisForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editThesisModalLabel">Edit Thesis</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editThesisId" name="id">

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fullname" id="editFullname" required>
                            </div>
                            <div class="col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" id="editEmail" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>PSAU ID</label>
                                <input type="text" class="form-control" name="psau_id" id="editPsauId" required>
                            </div>
                            <div class="col-md-6">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" id="editContactNumber"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Program</label>
                                <input type="text" class="form-control" name="program" id="editProgram">
                            </div>
                            <div class="col-md-6">
                                <label>College</label>
                                <input type="text" class="form-control" name="college" id="editCollege">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Thesis Title</label>
                            <input type="text" class="form-control" name="thesis_title" id="editTitle" required>
                        </div>

                        <div class="mb-2">
                            <label>Adviser</label>
                            <input type="text" class="form-control" name="adviser" id="editAdviser">
                        </div>

                        <div class="mb-2">
                            <label>Groupmates</label>
                            <input type="text" class="form-control" name="groupmates" id="editGroupmates">
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Graduation Month</label>
                                <input type="number" class="form-control" name="graduation_month" id="editMonth"
                                    min="1" max="12">
                            </div>
                            <div class="col-md-6">
                                <label>Graduation Year</label>
                                <input type="number" class="form-control" name="graduation_year" id="editYear"
                                    min="1900" max="2100">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label>Graduate Student</label>
                            <select name="graduate_student" id="editGraduate" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Google Drive Link</label>
                            <input type="url" class="form-control" name="googledrive_link" id="editDrive">
                        </div>

                        <div class="mb-2">
                            <label>Replace File (PDF)</label>
                            <input type="file" class="form-control" name="thesis_file" accept="application/pdf">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Thesis</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#thesisTable').DataTable({
                responsive: false,
                order: []
            });

            // Details toggle
            $('#thesisTable tbody').on('click', 'td.details-toggle', function() {
                let tr = $(this).closest('tr');
                let row = table.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    let title = $(this).data('title');
                    let adviser = $(this).data('adviser');
                    let groupmates = $(this).data('groupmates');
                    let graduation = $(this).data('graduation');
                    let graduate = $(this).data('graduate');
                    let file = $(this).data('file');
                    let drive = $(this).data('drive');

                    let fileLink = file ? `<a href="${file}" target="_blank">Download</a>` : '—';
                    let driveLink = drive ? `<a href="${drive}" target="_blank">View</a>` : '—';

                    row.child(`
                <div class="p-3 details-row">
                    <p><strong>Thesis Title:</strong> ${title}</p>
                    <p><strong>Adviser:</strong> ${adviser}</p>
                    <p><strong>Groupmates:</strong> ${groupmates}</p>
                    <p><strong>Graduation:</strong> ${graduation}</p>
                    <p><strong>Graduate Student:</strong> ${graduate}</p>
                    <p><strong>File:</strong> ${fileLink}</p>
                    <p><strong>Google Drive:</strong> ${driveLink}</p>
                </div>
            `).show();
                    tr.addClass('shown');
                }
            });

            // Delete thesis
            window.deleteThesis = function(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/admin/student-research/theses/delete/${id}`)
                            .then(response => {
                                if (response.data.success) {
                                    Swal.fire('Deleted!', 'Thesis has been deleted.', 'success')
                                        .then(() => location.reload());
                                }
                            })
                            .catch(() => Swal.fire('Error!', 'Something went wrong.', 'error'));
                    }
                });
            }

            // Edit thesis
            window.editThesis = function(id) {
                axios.get(`/admin/student-research/theses/${id}`)
                    .then(response => {
                        const t = response.data;
                        $('#editThesisId').val(t.id);
                        $('#editFullname').val(t.fullname);
                        $('#editEmail').val(t.email);
                        $('#editPsauId').val(t.psau_id);
                        $('#editContactNumber').val(t.contact_number);
                        $('#editProgram').val(t.program);
                        $('#editCollege').val(t.college);
                        $('#editTitle').val(t.thesis_title);
                        $('#editAdviser').val(t.adviser);
                        $('#editGroupmates').val(t.groupmates);
                        $('#editMonth').val(t.graduation_month);
                        $('#editYear').val(t.graduation_year);
                        $('#editGraduate').val(t.graduate_student ? 1 : 0);
                        $('#editDrive').val(t.googledrive_link);

                        new bootstrap.Modal(document.getElementById('editThesisModal')).show();
                    })
                    .catch(() => Swal.fire('Error!', 'Could not fetch thesis data.', 'error'));
            }

            // Submit edit form
            $('#editThesisForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#editThesisId').val();
                let formData = new FormData(this);

                axios.post(`/admin/student-research/theses/update/${id}`, formData)
                    .then(() => {
                        Swal.fire('Updated!', 'Thesis has been updated.', 'success')
                            .then(() => location.reload());
                    })
                    .catch(err => {
                        let errors = err.response?.data?.errors;
                        if (errors) {
                            let msg = Object.values(errors).map(v => v[0]).join('<br>');
                            Swal.fire('Validation Error', msg, 'error');
                        } else {
                            Swal.fire('Error!', 'Something went wrong.', 'error');
                        }
                    });
            });
        });
    </script>
@endpush
