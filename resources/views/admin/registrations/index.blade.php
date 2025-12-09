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
                            <th width="200">Title</th>
                            <th>Remarks</th>
                            <th>Date Received</th>
                            <th>Inventor/Owner</th>
                            <th>IP Type</th>
                            <th width="70">Actions</th>
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
    @php
        $remarksOptions = [
            'Notice of Issuance and Registration',
            'Notice of Publication',
            'Registered with certificate',
        ];
        $ipTypeOptions = ['Patent', 'Trademark', 'Copyright', 'Industrial Design', 'Utility Model'];
        $noticeOptions = ['Notice of Issuance', 'Registered w/o cert', 'Registered w/ cert', 'Undelivered Cert'];
    @endphp

    {{-- Add New Registered IP --}}
    <div class="modal fade" id="registeredIpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.registrations.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Registered IP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            {{-- Registration Number --}}
                            <div class="col-md-6">
                                <label class="form-label">Registration Number</label>
                                <input type="text" class="form-control" name="registration_number" required>
                            </div>

                            {{-- Title --}}
                            <div class="col-md-6">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>

                            {{-- Remarks --}}
                            <div class="col-md-6">
                                <label class="form-label">Remarks</label>
                                <select class="form-select remarks" name="remarks">
                                    <option value="" selected disabled>-- Select Remarks --</option>
                                    @foreach ($remarksOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" class="form-control mt-2 remarks-other d-none" name="remarks_other"
                                    placeholder="Enter custom remark">
                            </div>

                            {{-- Date Received --}}
                            <div class="col-md-6">
                                <label class="form-label">Date Received</label>
                                <input type="date" class="form-control" name="date_received" max="{{ date('Y-m-d') }}">
                            </div>

                            {{-- Inventor/Owner --}}
                            <div class="col-md-6">
                                <label class="form-label">Inventor/Owner</label>
                                <textarea class="form-control" name="inventor_owner" rows="3"></textarea>
                            </div>

                            {{-- IP Type --}}
                            <div class="col-md-6">
                                <label class="form-label">IP Type</label>
                                <select class="form-select ip_type" name="ip_type">
                                    <option value="" selected disabled>-- Select IP Type --</option>
                                    @foreach ($ipTypeOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" class="form-control mt-2 ip-type-other d-none" name="ip_type_other"
                                    placeholder="Enter custom IP type">
                            </div>

                            {{-- Notice --}}
                            <div class="col-md-6">
                                <label class="form-label">Notice</label>
                                <select class="form-select notice" name="notice">
                                    <option value="" selected disabled>-- Select Notice --</option>
                                    @foreach ($noticeOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                    <option value="Other">Other</option>
                                </select>
                                <input type="text" class="form-control mt-2 notice-other d-none" name="notice_other"
                                    placeholder="Enter custom notice">
                            </div>

                            {{-- Comment --}}
                            <div class="col-md-6">
                                <label class="form-label">Comment</label>
                                <input type="text" class="form-control" name="comment">
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

    {{-- Edit Modals --}}
    @foreach ($registrations as $ip)
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
                                {{-- Registration Number --}}
                                <div class="col-md-6">
                                    <label class="form-label">Registration Number</label>
                                    <input type="text" class="form-control" name="registration_number"
                                        value="{{ $ip->registration_number }}" required>
                                </div>

                                {{-- Title --}}
                                <div class="col-md-6">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                        value="{{ $ip->title }}" required>
                                </div>

                                {{-- Remarks --}}
                                <div class="col-md-6">
                                    <label class="form-label">Remarks</label>
                                    <select class="form-select remarks" name="remarks">
                                        @foreach ($remarksOptions as $option)
                                            <option value="{{ $option }}"
                                                {{ $ip->remarks == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                        <option value="Other"
                                            {{ !in_array($ip->remarks, $remarksOptions) ? 'selected' : '' }}>
                                            Other
                                        </option>
                                        @if (!in_array($ip->remarks, $remarksOptions))
                                            <option value="{{ $ip->remarks }}" selected hidden>{{ $ip->remarks }}
                                            </option>
                                        @endif
                                    </select>
                                    <input type="text" class="form-control mt-2 remarks-other" name="remarks_other">
                                </div>

                                {{-- Date Received --}}
                                <div class="col-md-6">
                                    <label class="form-label">Date Received</label>
                                    <input type="date" class="form-control" name="date_received"
                                        value="{{ $ip->date_received }}" max="{{ date('Y-m-d') }}">
                                </div>

                                {{-- Inventor/Owner --}}
                                <div class="col-md-6">
                                    <label class="form-label">Inventor/Owner</label>
                                    <textarea class="form-control" name="inventor_owner" rows="3">{{ $ip->inventor_owner }}</textarea>
                                </div>

                                {{-- IP Type --}}
                                <div class="col-md-6">
                                    <label class="form-label">IP Type</label>
                                    <select class="form-select ip_type" name="ip_type">
                                        @foreach ($ipTypeOptions as $option)
                                            <option value="{{ $option }}"
                                                {{ $ip->ip_type == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                        <option value="Other"
                                            {{ !in_array($ip->ip_type, $ipTypeOptions) ? 'selected' : '' }}>Other</option>
                                        @if (!in_array($ip->ip_type, $ipTypeOptions))
                                            <option value="{{ $ip->ip_type }}" selected hidden>{{ $ip->ip_type }}
                                            </option>
                                        @endif
                                    </select>
                                    <input type="text" class="form-control mt-2 ip-type-other" name="ip_type_other">
                                </div>

                                {{-- Notice --}}
                                <div class="col-md-6">
                                    <label class="form-label">Notice</label>
                                    <select class="form-select notice" name="notice">
                                        @foreach ($noticeOptions as $option)
                                            <option value="{{ $option }}"
                                                {{ $ip->notice == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                        @endforeach
                                        <option value="Other"
                                            {{ !in_array($ip->notice, $noticeOptions) ? 'selected' : '' }}>Other</option>
                                        @if (!in_array($ip->notice, $noticeOptions))
                                            <option value="{{ $ip->notice }}" selected hidden>{{ $ip->notice }}
                                            </option>
                                        @endif
                                    </select>
                                    <input type="text" class="form-control mt-2 notice-other" name="notice_other">
                                </div>

                                {{-- Comment --}}
                                <div class="col-md-6">
                                    <label class="form-label">Comment</label>
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
            document.addEventListener("DOMContentLoaded", function() {

                // Generic handler for all select inputs with "Other"
                const handleOtherField = (selectElem, inputElem, optionsArray) => {
                    const selectedValue = selectElem.value;

                    if (selectedValue === "Other") {
                        inputElem.classList.remove("d-none");
                    } else if (!optionsArray.includes(selectedValue)) {
                        // Saved custom value in Edit Modal
                        inputElem.classList.remove("d-none");
                        inputElem.value = selectedValue;
                    } else {
                        inputElem.classList.add("d-none");
                        inputElem.value = "";
                    }
                };

                // Options list (must match Blade)
                const remarksOptions = [
                    "Notice of Issuance and Registration",
                    "Notice of Publication",
                    "Registered with certificate",
                ];
                const ipTypeOptions = [
                    "Patent", "Trademark", "Copyright",
                    "Industrial Design", "Utility Model",
                ];
                const noticeOptions = [
                    "Notice of Issuance",
                    "Registered w/o cert",
                    "Registered w/ cert",
                    "Undelivered Cert",
                ];

                // Loop through all select + input pairs
                document.querySelectorAll(".remarks").forEach((select) => {
                    const otherInput = select.parentElement.querySelector(".remarks-other");
                    handleOtherField(select, otherInput, remarksOptions);
                    select.addEventListener("change", () => handleOtherField(select, otherInput,
                        remarksOptions));
                });

                document.querySelectorAll(".ip_type").forEach((select) => {
                    const otherInput = select.parentElement.querySelector(".ip-type-other");
                    handleOtherField(select, otherInput, ipTypeOptions);
                    select.addEventListener("change", () => handleOtherField(select, otherInput,
                        ipTypeOptions));
                });

                document.querySelectorAll(".notice").forEach((select) => {
                    const otherInput = select.parentElement.querySelector(".notice-other");
                    handleOtherField(select, otherInput, noticeOptions);
                    select.addEventListener("change", () => handleOtherField(select, otherInput,
                        noticeOptions));
                });
            });
        </script>


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
