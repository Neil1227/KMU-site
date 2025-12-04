@extends('layouts.admin')

@section('title', 'Manage Application')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        /* Folding row arrow */
        .expand-toggle {
            cursor: pointer;
            display: inline-block;
            transition: transform 0.3s ease;
            margin-right: 5px;
        }

        .expanded .expand-toggle {
            transform: rotate(90deg);
        }

        /* Hide certain columns in main table */
        .hide-column {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Commercialization Records</h5>
                <span class="badge bg-light text-dark">{{ $commercializations->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="commercializationTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Commodity</th>
                            <th width="200">Thesis Title</th>
                            <th>Technologies</th>
                            <th class="hide-column">Technology Generator</th>
                            <th class="hide-column">Contact Info</th>
                            <th>College</th> <!-- Added college -->
                            <th class="hide-column">Type of Technology</th>
                            <th>Link</th>
                            <th class="hide-column">Priority Area</th>
                            <th style="display:none">Date Received</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($commercializations as $commertial)
                            @php $commodity = $commertial->commodity; @endphp
                            <tr data-id="{{ $commertial->id }}">
                                <td>
                                    <span class="expand-toggle">▶</span>
                                    <span
                                        data-full="{{ $commodity->commodity ?? '—' }}">{{ $commodity->commodity ?? '—' }}</span>
                                </td>
                                <td data-full="{{ $commertial->thesis_title ?? '—' }}">
                                    {{ $commertial->thesis_title ?? '—' }}
                                </td>

                                <td data-full="{{ $commertial->technologies ?? '—' }}">
                                    {{ Str::limit($commertial->technologies ?? '—', 50) }}</td>
                                <td class="hide-column" data-full="{{ $commertial->technology_generator ?? '—' }}">
                                    {{ $commertial->technology_generator ?? '—' }}</td>
                                <td class="hide-column" data-full="{{ $commertial->contact_info ?? '—' }}">
                                    {{ Str::limit($commertial->contact_info ?? '—', 50) }}</td>
                                <td data-full="{{ $commertial->college ?? '—' }}">
                                    {{ $commertial->college ?? '—' }}</td>
                                <td class="hide-column" data-full="{{ $commertial->type_of_technology ?? '—' }}">
                                    {{ $commertial->type_of_technology ?? '—' }}</td>
                                <td data-full="{{ $commertial->link ?? '—' }}">
                                    @if ($commertial->link)
                                        <a href="{{ $commertial->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="hide-column" data-full="{{ $commertial->priority_area ?? '—' }}">
                                    {{ $commertial->priority_area ?? '—' }}</td>
                                <td style="display:none">{{ $commertial->created_at }}</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="actionDropdown{{ $commertial->id }}" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $commertial->id }}">
                                            <li>
                                                <button class="dropdown-item text-success push-to-registered">
                                                    <i class="bi bi-send me-2"></i>Promotional/Development
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-success push-to-agri"
                                                    data-id="{{ $commertial->id }}">
                                                    <i class="bi bi-send me-2"></i>For Agri-Business
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-danger delete-notif"
                                                    data-url="{{ route('admin.iptbm.destroy', $commertial->id) }}">
                                                    <i class="bi bi-trash me-2"></i>Delete
                                                </button>
                                            </li>

                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Agri-Business Modal -->
            <!-- Agri-Business Modal -->
            <div class="modal fade" id="agriModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form id="agriForm" action="{{ route('admin.agri-business.store') }}" method="POST">

                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Add to Agri-Business</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">

                                <input type="hidden" name="commertial_id" id="agri_comm_id">

                                <!-- Thesis Title -->
                                <div class="mb-3">
                                    <label class="form-label">Thesis Title</label>
                                    <input type="text" class="form-control" name="thesis_title" id="agri_thesis">
                                </div>

                                <!-- Technologies -->
                                <div class="mb-3">
                                    <label class="form-label">Technologies</label>
                                    <textarea class="form-control" name="technologies" id="agri_technologies" rows="2"></textarea>
                                </div>

                                <!-- Technology Generator -->
                                <div class="mb-3">
                                    <label class="form-label">Technology Generator</label>
                                    <input type="text" class="form-control" name="technology_generator"
                                        id="agri_generator">
                                </div>

                                <!-- Type of Technology -->
                                <div class="mb-3">
                                    <label class="form-label">Type of Technology</label>
                                    <input type="text" class="form-control" name="type_of_technology" id="agri_type">
                                </div>

                                <!-- Contact Info -->
                                <div class="mb-3">
                                    <label class="form-label">Contact Info</label>
                                    <input type="text" class="form-control" name="contact_info" id="agri_contact">
                                </div>

                                <!-- Remarks -->
                                <div class="mb-3">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="remarks" id="agri_remarks" rows="2"></textarea>
                                </div>

                                <!-- Link (INTENTIONALLY EMPTY — user fills manually) -->
                                <div class="mb-3">
                                    <label class="form-label">Link</label>
                                    <input type="text" class="form-control" name="link"
                                        placeholder="Enter link manually (optional)">
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-success" type="submit">Save</button>
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
        $(document).ready(function() {

            /* ============================================================
             *  INITIALIZE DATATABLE
             * ============================================================ */
            const table = $('#commercializationTable').DataTable({
                responsive: true,
                columnDefs: [{
                    orderable: true,
                    targets: 4
                }],
                order: [
                    [9, 'desc']
                ],
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                autoWidth: false,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records..."
                }
            });

            /* ============================================================
             *  SWEETALERT HELPERS
             * ============================================================ */
            const swalSuccess = msg => Swal.fire({
                icon: "success",
                title: "Success",
                text: msg,
                timer: 1500,
                showConfirmButton: false
            });
            const swalError = msg => Swal.fire({
                icon: "error",
                title: "Error",
                text: msg
            });
            const swalConfirm = text => Swal.fire({
                title: "Confirm",
                text: text || "Are you sure?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel"
            });

            /* ============================================================
             *  HELPER: REMOVE ROW FROM DATATABLE
             * ============================================================ */
            function removeRow(id) {
                const row = $(`tr[data-id="${id}"]`);
                table.row(row).remove().draw();
            }

            /* ============================================================
             *  AGRI-BUSINESS MODAL
             * ============================================================ */
            function populateAgriModal(tr) {
                $('#agri_comm_id').val(tr.data('id'));
                $('#agri_thesis').val(tr.find('td:eq(1)').data('full'));
                $('#agri_technologies').val(tr.find('td:eq(2)').data('full'));
                $('#agri_generator').val(tr.find('td:eq(3)').data('full'));
                $('#agri_contact').val(tr.find('td:eq(4)').data('full'));
                $('#agri_type').val(tr.find('td:eq(6)').data('full'));
                $('#agri_remarks').val('');
                $('#agriForm input[name="link"]').val('');
                $('#agriModal').modal('show');
            }

            $(document).on("click", ".push-to-agri", function() {
                populateAgriModal($(this).closest("tr"));
            });

            $('#agriModal').on('hidden.bs.modal', () => $('#agriForm')[0].reset());

            /* ============================================================
             *  SUBMIT AGRI FORM
             * ============================================================ */
            $('#agriForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const id = $('#agri_comm_id').val();
                const submitBtn = form.find('button[type=submit]');
                submitBtn.prop('disabled', true).text('Saving...');

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        swalSuccess(response.message || "Record saved and pushed.");
                        removeRow(id);
                        $('#agriModal').modal('hide');
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || "Unable to save.";
                        swalError(msg);
                    },
                    complete: () => submitBtn.prop('disabled', false).text('Save')
                });
            });

            /* ============================================================
             *  DELETE RECORD
             * ============================================================ */
            $(document).on("click", ".delete-notif", async function() {
                const tr = $(this).closest("tr");
                const id = tr.data("id");
                const url = $(this).data("url");

                const result = await swalConfirm("This will permanently delete the record.");
                if (!result.isConfirmed) return;

                try {
                    const res = await fetch(url, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    });
                    const data = await res.json();
                    data.success ? (swalSuccess(data.message), removeRow(id)) : swalError(data.message);
                } catch {
                    swalError("Something went wrong.");
                }
            });

            /* ============================================================
             *  REGISTERED TECHNOLOGY MODAL
             * ============================================================ */
            $(document).on("click", ".push-to-registered", function() {
                $('#technology').val($(this).data('technology'));
                $('#techGenerator').val($(this).data('generator'));
                $('#description').val('');
                $('#link').val('');
                $('#notificationId').val($(this).data('id'));
                $('#pushTechnologyModal').modal('show');
            });

            $('#pushTechnologyForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const id = $('#notificationId').val();
                const btn = form.find("button[type=submit]");

                btn.prop("disabled", true).text("Saving...");

                $.ajax({
                    url: "{{ route('admin.registered-technology.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        swalSuccess(response.message);
                        removeRow(id);
                        $('#pushTechnologyModal').modal('hide');
                    },
                    error: function(xhr) {
                        swalError(xhr.responseJSON?.message || "Something went wrong.");
                    },
                    complete: () => btn.prop("disabled", false).text("Save")
                });
            });

            /* ============================================================
             *  FOLDING ROW LOGIC
             * ============================================================ */
            $('#commercializationTable tbody').on('click', 'td:first-child', function() {
                const tr = $(this).closest('tr');
                const row = table.row(tr);

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('expanded');
                    return;
                }

                const detailsHtml = tr.find('td').map(function(i) {
                    const header = $('#commercializationTable thead th').eq(i).text();
                    if ($(this).hasClass('hide-column')) {
                        return `<div><strong>${header}:</strong> ${$(this).data('full') || $(this).text()}</div>`;
                    }
                }).get().join('');

                row.child(`<div class="folding-row p-2 bg-light">${detailsHtml}</div>`).show();
                tr.addClass('expanded');
            });

        });
    </script>
@endpush
