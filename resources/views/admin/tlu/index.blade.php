@extends('layouts.admin')

@section('title', 'Manage Technology Licensing Unit Records')

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
                <h5 class="mb-0">Technology Licensing Unit Records</h5>
                <span class="badge bg-light text-dark">{{ $tluRecords->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="tluTable" class="table table-bordered table-striped table-sm align-middle nowrap">
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
                        @forelse ($tluRecords as $tlu)
                            <tr data-id="{{ $tlu->id }}">
                                <td>{{ Str::limit($tlu->thesis_title ?? '—', 50) }}</td>
                                <td>{{ Str::limit($tlu->technologies ?? '—', 50) }}</td>
                                <td>{{ $tlu->technology_generator ?? '—' }}</td>
                                <td>{{ $tlu->type_of_technology ?? '—' }}</td>
                                <td>{{ Str::limit($tlu->contact_info ?? '—', 50) }}</td>
                                <td>{{ Str::limit($tlu->remarks ?? '—', 50) }}</td>
                                <td>
                                    @if ($tlu->link)
                                        <a href="{{ $tlu->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="actionDropdown{{ $tlu->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $tlu->id }}">
                                            <li>
                                                <button class="dropdown-item text-warning edit-record"
                                                    data-id="{{ $tlu->id }}"
                                                    data-thesis_title="{{ $tlu->thesis_title }}"
                                                    data-technologies="{{ $tlu->technologies }}"
                                                    data-technology_generator="{{ $tlu->technology_generator }}"
                                                    data-type_of_technology="{{ $tlu->type_of_technology }}"
                                                    data-contact_info="{{ $tlu->contact_info }}"
                                                    data-remarks="{{ $tlu->remarks }}" data-link="{{ $tlu->link }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-success push-to-tbi"
                                                    data-id="{{ $tlu->id }}">
                                                    <i class="bi bi-arrow-right-circle me-2"></i>Push to TBI
                                                </button>
                                            </li>

                                            <li>
                                                <button class="dropdown-item text-danger delete-notif"
                                                    data-url="{{ route('admin.tlu.destroy', $tlu->id) }}">
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
                <!-- Push to TBI Modal -->
                <div class="modal fade" id="pushToTbiModal" tabindex="-1" aria-labelledby="pushToTbiModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <form id="pushToTbiForm" method="POST" action="{{ route('admin.tbi.store') }}">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title">Push Record to TBI</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">

                                    <input type="hidden" id="pushTbi_source_id" name="source_id">

                                    <div class="alert alert-info">
                                        This will copy the selected TLU record into the TBI section.
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Thesis Title</label>
                                            <input type="text" class="form-control" id="pushTbi_thesis_title"
                                                name="thesis_title" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Technologies</label>
                                            <input type="text" class="form-control" id="pushTbi_technologies"
                                                name="technologies" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Technology Generator</label>
                                            <input type="text" class="form-control" id="pushTbi_technology_generator"
                                                name="technology_generator" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Type of Technology</label>
                                            <input type="text" class="form-control" id="pushTbi_type_of_technology"
                                                name="type_of_technology" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Contact Info</label>
                                            <input type="text" class="form-control" id="pushTbi_contact_info"
                                                name="contact_info" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Remarks</label>
                                            <input type="text" class="form-control" id="pushTbi_remarks"
                                                name="remarks" readonly>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Link</label>
                                            <input type="text" class="form-control" id="pushTbi_link" name="link">
                                        </div>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Push to TBI</button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- Edit TLU Modal -->
                <div class="modal fade" id="editTluModal" tabindex="-1" aria-labelledby="editTluModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <form id="editTluForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTluModalLabel">Edit TLU Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="editTluId" name="id">

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
                </div> <!-- Modal end -->

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#198754',
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {

            const table = $('#tluTable').DataTable({
                responsive: true
            });

            // ================================
            // ⚡ HELPER: SWEETALERT
            // ================================
            const showAlert = (type, title, text, timer = 1500) => Swal.fire({
                icon: type,
                title: title,
                text: text,
                timer: timer,
                showConfirmButton: false
            });

            // ================================
            // ⚡ OPEN EDIT MODAL + PREFILL
            // ================================
            $(document).on('click', '.edit-record', function() {
                const id = $(this).data('id');
                const modal = $('#editTluModal');
                const form = $('#editTluForm')[0];

                form.reset(); // Clear previous data

                $('#editTluId').val(id);
                $('#thesis_title').val($(this).data('thesis_title'));
                $('#technologies').val($(this).data('technologies'));
                $('#technology_generator').val($(this).data('technology_generator'));
                $('#type_of_technology').val($(this).data('type_of_technology'));
                $('#contact_info').val($(this).data('contact_info'));
                $('#remarks').val($(this).data('remarks'));
                $('#link').val($(this).data('link'));

                form.setAttribute('action', `/admin/tlu/${id}`);
                modal.modal('show');
            });

            // ================================
            // ⚡ SHOW PUSH TO TBI MODAL
            // ================================
            $(document).on('click', '.push-to-tbi', function() {
                const row = $(this).closest('tr');

                $('#pushTbi_source_id').val($(this).data('id'));
                $('#pushTbi_thesis_title').val(row.find('td:eq(0)').text().trim());
                $('#pushTbi_technologies').val(row.find('td:eq(1)').text().trim());
                $('#pushTbi_technology_generator').val(row.find('td:eq(2)').text().trim());
                $('#pushTbi_type_of_technology').val(row.find('td:eq(3)').text().trim());
                $('#pushTbi_contact_info').val(row.find('td:eq(4)').text().trim());
                $('#pushTbi_remarks').val(row.find('td:eq(5)').text().trim());
                $('#pushTbi_link').val("");

                $('#pushToTbiModal').modal('show');
            });

            // ================================
            // ⚡ HANDLE UPDATE (AJAX PUT)
            // ================================
            $('#editTluForm').on('submit', function(e) {
                e.preventDefault();
                const id = $('#editTluId').val();
                const formData = new FormData(this);

                fetch(`/admin/tlu/${id}`, {
                        method: 'POST', // method spoofing
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            showAlert('success', 'Updated', data.message);
                            $('#editTluModal').modal('hide');

                            // Update row in DataTable
                            const row = $(`tr[data-id="${id}"]`);
                            row.find('td:eq(0)').text($('#thesis_title').val());
                            row.find('td:eq(1)').text($('#technologies').val());
                            row.find('td:eq(2)').text($('#technology_generator').val());
                            row.find('td:eq(3)').text($('#type_of_technology').val());
                            row.find('td:eq(4)').text($('#contact_info').val());
                            row.find('td:eq(5)').text($('#remarks').val());

                        } else Swal.fire("Error", "Something went wrong.", "error");
                    })
                    .catch(err => {
                        Swal.fire("Error", "Failed to update record.", "error");
                        console.error(err);
                    });
            });

            // ================================
            // ⚡ DELETE RECORD (REMOVE WITHOUT RELOAD)
            // ================================
            $(document).on('click', '.delete-notif', function() {
                const btn = $(this);
                const tr = btn.closest('tr');
                const url = btn.data('url');

                Swal.fire({
                    title: "Are you sure?",
                    text: "This record will be deleted permanently.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it"
                }).then(async (result) => {
                    if (!result.isConfirmed) return;

                    try {
                        const res = await fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if (data.success) {
                            showAlert('success', 'Deleted!', data.message);
                            table.row(tr).remove().draw(); // Remove row instantly
                        } else Swal.fire("Error", data.message || "Could not delete record.",
                            "error");
                    } catch (err) {
                        Swal.fire("Error", "Something went wrong.", "error");
                        console.error(err);
                    }
                });
            });

            // ================================
            // ⚡ PUSH TO TBI (REMOVE ROW AFTER PUSH)
            // ================================
            $('#pushToTbiForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const id = $('#pushTbi_source_id').val();
                const tr = $(`tr[data-id="${id}"]`);
                const submitBtn = form.find('button[type=submit]');

                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        showAlert('success', 'Success', response.message);
                        table.row(tr).remove().draw(); // Remove from DataTable
                        $('#pushToTbiModal').modal('hide');
                    },
                    error: function(xhr) {
                        Swal.fire("Error", xhr.responseJSON?.message ||
                            "Failed to push record.", "error");
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text('Save');
                    }
                });
            });

        });
    </script>
@endpush
