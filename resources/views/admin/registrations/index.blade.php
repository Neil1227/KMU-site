@extends('layouts.admin')

@section('title', 'Registered IPs')

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
        <div class="card shadow-sm mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa fa-users me-2"></i>Registered IPs</h5>
                <div>
                    <span class="badge bg-light text-dark">{{ $registrations->count() }} total</span>
                    <button type="button" class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal"
                        data-bs-target="#registeredIpModal">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="IPTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th>Registration Number</th>
                            <th>Title</th>
                            <th>Remarks</th>
                            <th>Date Received</th>
                            <th>Inventor/Owner</th>
                            <th>IP Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registrations as $ip)
                            <tr data-id="{{ $ip->id }}">
                                <td class="details-toggle" data-iptype="{{ $ip->ip_type ?? '—' }}"
                                    data-notice="{{ $ip->notice ?? '—' }}" data-comment="{{ $ip->comment ?? '—' }}">
                                    <span class="arrow-icon">▶</span> {{ $ip->registration_number }}
                                </td>
                                <td>{{ $ip->title }}</td>
                                <td>{{ $ip->remarks }}</td>
                                <td>{{ $ip->date_received }}</td>
                                <td>{{ $ip->inventor_owner }}</td>
                                <td>{{ $ip->ip_type }}</td> <!-- still visible in table -->
                                <td class="text-center">
                                    <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal"
                                        data-bs-target="#editIpModal-{{ $ip->id }}"><i
                                            class="bi bi-pencil"></i></button>
                                    <button class="btn btn-sm btn-danger" onclick="deleteIp({{ $ip->id }})"><i
                                            class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>


                </table>
            </div>
        </div>
    </div>
    <!-- Registered IP Modal -->
    <div class="modal fade" id="registeredIpModal" tabindex="-1" aria-labelledby="registeredIpModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.registrations.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="registeredIpModalLabel">Add New Registered IP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3"> <!-- g-3 adds spacing between columns -->
                            <div class="col-md-6">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control" id="registration_number"
                                    name="registration_number" required>
                            </div>

                            <div class="col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="col-md-6">
                                <label for="remarks" class="form-label">Remarks</label>
                                <select class="form-select" id="remarks" name="remarks">
                                    <option value="" selected disabled>-- Select Remarks --</option>
                                    <option value="Notice of Issuance and Registration">Notice of Issuance and Registration
                                    </option>
                                    <option value="Notice of Publication">Notice of Publication</option>
                                    <option value="Registered with certificate">Registered with certificate</option>
                                    <option value="Other">Other</option>
                                </select>

                                <!-- Hidden text input for 'Other' -->
                                <input type="text" class="form-control mt-2 d-none" id="remarks_other"
                                    name="remarks_other" placeholder="Enter custom remark">
                            </div>

                            <div class="col-md-6">
                                <label for="date_received" class="form-label">Date Received</label>
                                <input type="date" class="form-control" id="date_received" name="date_received"
                                    max="{{ date('Y-m-d') }}">


                            </div>

                            <div class="col-md-6">
                                <label for="inventor_owner" class="form-label">Inventor/Owner (comma separated)</label>
                                <textarea class="form-control" id="inventor_owner" name="inventor_owner" rows="3"
                                    placeholder="Enter inventor/owner details"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="ip_type" class="form-label">IP Type</label>
                                <select class="form-select" id="ip_type" name="ip_type">
                                    <option value="" selected disabled>-- Select IP Type --</option>
                                    <option value="Patent">Patent</option>
                                    <option value="Trademark">Trademark</option>
                                    <option value="Copyright">Copyright</option>
                                    <option value="Industrial Design">Industrial Design</option>
                                    <option value="Utility Model">Utility Model</option>
                                    <option value="Other">Other</option>
                                </select>

                                <!-- Hidden text input for 'Other' -->
                                <input type="text" class="form-control mt-2 d-none" id="ip_type_other"
                                    name="ip_type_other" placeholder="Enter custom IP type">
                            </div>
                            <div class="col-md-6">
                                <label for="notice" class="form-label">Notice</label>
                                <select class="form-select" id="notice" name="notice">
                                    <option value="" selected disabled>-- Select Notice --</option>
                                    <option value="Notice of Issuance">Notice of Issuance</option>
                                    <option value="Registered w/o cert">Registered w/o cert</option>
                                    <option value="Registered w/ cert">Registered w/ cert</option>
                                    <option value="Undelivered Cert">Undelivered Cert</option>
                                    <option value="Other">Other</option>
                                </select>

                                <!-- Hidden text input for 'Other' -->
                                <input type="text" class="form-control mt-2 d-none" id="notice_other"
                                    name="notice_other" placeholder="Enter custom notice">
                            </div>
                            <div class="col-md-6">
                                <label for="comment" class="form-label">Comment</label>
                                <input type="text" class="form-control" id="comment" name="comment">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save IP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @foreach ($registrations as $ip)
        <!-- Edit Modal -->
        <div class="modal fade" id="editIpModal-{{ $ip->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="{{ route('admin.registrations.update', $ip->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Registered IP</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="registration_number" class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" name="registration_number"
                                        value="{{ $ip->registration_number }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $ip->title }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <select class="form-select remarks" name="remarks">
                                        <option value="Notice of Issuance and Registration"
                                            {{ $ip->remarks == 'Notice of Issuance and Registration' ? 'selected' : '' }}>
                                            Notice
                                            of Issuance and Registration</option>
                                        <option value="Notice of Publication"
                                            {{ $ip->remarks == 'Notice of Publication' ? 'selected' : '' }}>Notice of
                                            Publication
                                        </option>
                                        <option value="Registered with certificate"
                                            {{ $ip->remarks == 'Registered with certificate' ? 'selected' : '' }}>
                                            Registered with
                                            certificate</option>
                                        <option value="Other"
                                            {{ !in_array($ip->remarks, ['Notice of Issuance and Registration', 'Notice of Publication', 'Registered with certificate']) ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    <input type="text"
                                        class="form-control mt-2 {{ !in_array($ip->remarks, ['Notice of Issuance and Registration', 'Notice of Publication', 'Registered with certificate']) ? '' : 'd-none' }}"
                                        name="remarks_other"
                                        value="{{ !in_array($ip->remarks, ['Notice of Issuance and Registration', 'Notice of Publication', 'Registered with certificate']) ? $ip->remarks : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="date_received" class="form-label">Date Received</label>
                                    <input type="date" class="form-control" name="date_received"
                                        value="{{ $ip->date_received }}" max="{{ date('Y-m-d') }}">

                                </div>
                                <div class="col-md-6">
                                    <label for="inventor_owner" class="form-label">Inventor/Owner</label>
                                    <textarea class="form-control" name="inventor_owner" rows="3">{{ $ip->inventor_owner }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="ip_type" class="form-label">IP Type</label>
                                    <select class="form-select ip_type" name="ip_type">
                                        <option value="Patent" {{ $ip->ip_type == 'Patent' ? 'selected' : '' }}>Patent
                                        </option>
                                        <option value="Trademark" {{ $ip->ip_type == 'Trademark' ? 'selected' : '' }}>
                                            Trademark
                                        </option>
                                        <option value="Copyright" {{ $ip->ip_type == 'Copyright' ? 'selected' : '' }}>
                                            Copyright
                                        </option>
                                        <option value="Industrial Design"
                                            {{ $ip->ip_type == 'Industrial Design' ? 'selected' : '' }}>Industrial Design
                                        </option>
                                        <option value="Utility Model"
                                            {{ $ip->ip_type == 'Utility Model' ? 'selected' : '' }}>
                                            Utility Model</option>
                                        <option value="Other"
                                            {{ !in_array($ip->ip_type, ['Patent', 'Trademark', 'Copyright', 'Industrial Design', 'Utility Model']) ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    <input type="text"
                                        class="form-control mt-2 {{ !in_array($ip->ip_type, ['Patent', 'Trademark', 'Copyright', 'Industrial Design', 'Utility Model']) ? '' : 'd-none' }}"
                                        name="ip_type_other"
                                        value="{{ !in_array($ip->ip_type, ['Patent', 'Trademark', 'Copyright', 'Industrial Design', 'Utility Model']) ? $ip->ip_type : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="notice" class="form-label">Notice</label>
                                    <select class="form-select notice" name="notice">
                                        <option value="Notice of Issuance"
                                            {{ $ip->notice == 'Notice of Issuance' ? 'selected' : '' }}>Notice of Issuance
                                        </option>
                                        <option value="Registered w/o cert"
                                            {{ $ip->notice == 'Registered w/o cert' ? 'selected' : '' }}>Registered w/o
                                            cert
                                        </option>
                                        <option value="Registered w/ cert"
                                            {{ $ip->notice == 'Registered w/ cert' ? 'selected' : '' }}>Registered w/ cert
                                        </option>
                                        <option value="Undelivered Cert"
                                            {{ $ip->notice == 'Undelivered Cert' ? 'selected' : '' }}>Undelivered Cert
                                        </option>
                                        <option value="Other"
                                            {{ !in_array($ip->notice, ['Notice of Issuance', 'Registered w/o cert', 'Registered w/ cert', 'Undelivered Cert']) ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    <input type="text"
                                        class="form-control mt-2 {{ !in_array($ip->notice, ['Notice of Issuance', 'Registered w/o cert', 'Registered w/ cert', 'Undelivered Cert']) ? '' : 'd-none' }}"
                                        name="notice_other"
                                        value="{{ !in_array($ip->notice, ['Notice of Issuance', 'Registered w/o cert', 'Registered w/ cert', 'Undelivered Cert']) ? $ip->notice : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="comment" class="form-label">Comment</label>
                                    <input type="text" class="form-control" name="comment"
                                        value="{{ $ip->comment }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update IP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                let table;

                if (!$.fn.DataTable.isDataTable('#IPTable')) {
                    table = $('#IPTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        pageLength: 10
                    });
                } else {
                    table = $('#IPTable').DataTable();
                }

                // Details toggle
                $('#IPTable tbody').on('click', 'td.details-toggle', function() {
                    let tr = $(this).closest('tr');
                    let row = table.row(tr);

                    if (row.child.isShown()) {
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {
                        let iptype = $(this).data('iptype');
                        let notice = $(this).data('notice');
                        let comment = $(this).data('comment');

                        row.child(`
                <div class="p-1 details-row text-center">
                    <p><strong>IP Type:</strong> ${iptype}</p>
                    <p><strong>Notice:</strong> ${notice}</p>
                    <p><strong>Comment:</strong> ${comment}</p>
                </div>
            `).show();

                        tr.addClass('shown');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $('#IPTable').DataTable({
                    responsive: true,
                    autoWidth: false,
                    pageLength: 10,
                    order: [
                        [3, 'desc']
                    ], // Sort by Date Received
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Search registered IPs...",
                        lengthMenu: "Show _MENU_ entries",
                        zeroRecords: "No matching IPs found",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        infoFiltered: "(filtered from _MAX_ total entries)"
                    }
                });

                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#198754'
                    });
                @endif

                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#dc3545'
                    });
                @endif
            });
        </script>

        <script>
            function deleteIp(id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This IP will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/admin/registrations/${id}`)
                            .then(response => {
                                Swal.fire(
                                    'Deleted!',
                                    'The IP has been deleted.',
                                    'success'
                                ).then(() => location.reload());
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            });
                    }
                })
            }
        </script>
    @endpush

@endsection
