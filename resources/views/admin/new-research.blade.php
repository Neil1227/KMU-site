@extends('layouts.admin')

@section('title', 'New Research Papers')

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
    <div class="card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Research Papers</h5>

            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $researches->count() }} total</span>

                    <button class="btn btn-sm btn-primary"
                        @if(session('admin_role') !=='KMU' ) disabled @endif
                        title="Add Research"
                        data-bs-toggle="modal"
                        data-bs-target="#addResearchModal">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>

        </div>

        <div class="card-body table-responsive-sm">
            <table id="sampleTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Thesis Title</th>
                        <th>Thesis Authors</th>
                        <th>Type of Technology</th>
                        <th>Link</th>
                        <th>Priority Area</th>
                        <th>Source</th>
                        <th>Date Added</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($researches as $research)
                    <tr>
                        <td>
                            {{ $research->title }}
                        </td>
                        <td>{{ $research->authors }}</td>
                        <td>{{ $research->technology_type }}</td>
                        <td>
                            @if (session('admin_role') === 'KMU')
                            @if ($research->link)
                            <a href="{{ $research->link }}" target="_blank">View</a>
                            @else
                            <em>Restricted Access</em>
                            @endif
                            @else
                            <em>Restricted Access</em>
                            @endif
                        </td>

                        <td>{{ $research->priority_area }}</td>
                        <td>
                            @if($research->source === 'Research')
                            <span class="badge bg-primary">From Research</span>
                            @elseif($research->source === 'KMU Thesis')
                            <span class="badge bg-success">From KMU Thesis</span>
                            @endif
                        </td>
                        <td>{{ $research->created_at }}</td>
                        <td class="text-center">
                            {{-- ✅ Show Acknowledge button if pending --}}
                            @if($research->status === 'pending')
                            <form action="{{ route('admin.new-research.acknowledge', ['id' => $research->id]) }}" method="POST" class="d-inline acknowledge-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-warning" title="Acknowledge this research" data-id="{{ $research->id }}">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            </form>
                            @else
                            {{-- ✅ Show the other buttons ONLY after acknowledgment --}}
                            <button
                                class="btn btn-sm btn-primary push-to-iptbm-btn"
                                title="Push to IPTBM"
                                data-id="{{ $research->id }}"
                                data-title="{{ $research->title }}"
                                data-authors="{{ $research->authors }}"
                                data-technology_type="{{ $research->technology_type }}"
                                data-priority_area="{{ $research->priority_area }}"
                                data-link="{{ $research->link }}"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-arrow-right-circle"></i>
                            </button>

                            <button
                                class="btn btn-sm btn-success push-to-extension"
                                data-id="{{ $research->id }}"
                                title="Push to Extension"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-box"></i>
                            </button>

                            <button
                                class="btn btn-sm btn-danger delete-research"
                                data-id="{{ $research->id }}"
                                title="Delete Research"
                                @if(session('admin_role') !=='KMU' ) disabled @endif>
                                <i class="bi bi-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No research data found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Push to IPTBM Modal -->
        <div class="modal fade" id="pushToIptbmModal" tabindex="-1" aria-labelledby="pushToIptbmLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="pushToIptbmForm">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="pushToIptbmLabel">Push Research to IPTBM</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="kmu_id" id="kmu_id">

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Commodity</label>
                                    <select name="commodity" id="commoditySelect" class="form-select" required>
                                        <option value="" disabled selected>-- Select Commodity --</option>
                                        <option value="other">New Commodity</option>
                                        <option value="For Checking">For Checking</option>

                                        @foreach($commodities as $c)
                                        <option value="{{ $c->commodity }}">{{ $c->commodity }} ({{ $c->total }})</option>
                                        @endforeach
                                    </select>

                                    <!-- Shown only when user selects "other" -->
                                    <input
                                        type="text"
                                        name="commodity_other"
                                        id="commodityOther"
                                        class="form-control mt-2"
                                        placeholder="Enter new commodity"
                                        style="display:none;">
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">Type of Technology</label>
                                    <select name="type_of_technology" id="type_of_technology" class="form-select" required>
                                        <option value="" disabled selected>-- Select Type --</option>
                                        <option value="Food">Food</option>
                                        <option value="Non-Food">Non-Food</option>
                                        <option value="N/A">N/A</option>
                                        <optgroup label="Non-Food">
                                            <option value="Non-Food (Chemical)">Non-Food (Chemical)</option>
                                            <option value="Non-Food (Software)">Non-Food (Software)</option>
                                            <option value="Non-Food (Equipment)">Non-Food (Equipment)</option>
                                        </optgroup>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label class="form-label">Thesis Title</label>
                                    <input type="text" class="form-control" name="thesis_title" id="thesis_title" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Technology Generator</label>
                                    <input type="text" class="form-control" name="technology_generator" id="technology_generator" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Priority Area</label>
                                    <select name="priority_area" id="priority_area" class="form-select" required>
                                        <option value="" disabled selected>-- Select Type --</option>
                                        <option value="Agriculture">Agriculture</option>
                                        <option value="Aquaculture">Aquaculture</option>
                                        <option value="LiveStock">LiveStock</option>
                                        <option value="Livelihood">Livelihood</option>
                                        <option value="Biotechnology">Biotechnology</option>
                                        <option value="Root Crops">Root Crops</option>
                                        <option value="Internet Of Things">Internet Of Things</option>
                                        <option value="Others">Others</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Link</label>
                                    <input type="url" class="form-control" name="link" id="link" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">IP Status</label>
                                    <select name="ip_status" class="form-select">
                                        <option value="Non-IP Applied">Non-IP Applied</option>
                                        <option value="IP Applied">IP Applied</option>
                                        <option value="Registered">Registered</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">TRL Level</label>
                                    <select name="trl_level" class="form-select" required>
                                        @for($i=1; $i<=9; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Remarks</label>
                                    <textarea class="form-control" name="remarks"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Push to IPTBM</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add Research Modal -->
        <div class="modal fade" id="addResearchModal" tabindex="-1" aria-labelledby="addResearchModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title text-white" id="addResearchModalLabel"><i class="bi bi-flask me-2"></i>Add New Research</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.add-thesis.storetokmu') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label fw-bold">Thesis Title</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Enter thesis title" required>
                            </div>

                            <div class="mb-3">
                                <label for="authors" class="form-label fw-bold">Thesis Authors</label>
                                <input type="text" name="authors" id="authors" class="form-control" placeholder="Enter author(s)" required>
                            </div>

                            <div class="mb-3">
                                <label for="technology_type" class="form-label fw-bold">Type of Technology</label>
                                <input type="text" name="technology_type" id="technology_type" class="form-control" placeholder="Enter type of technology" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Priority Area</label>
                                <select name="priority_area" class="form-select">
                                    <option value="" disabled selected>-- Select Type --</option>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Aquaculture">Aquaculture</option>
                                    <option value="LiveStock">LiveStock</option>
                                    <option value="Livelihood">Livelihood</option>
                                    <option value="Biotechnology">Biotechnology</option>
                                    <option value="Root Crops">Root Crops</option>
                                    <option value="Internet Of Things">Internet Of Things</option>
                                    <option value="Others">Others</option>
                                    <option value="N/A">N/A</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label fw-bold">Link</label>
                                <input type="url" name="link" id="link" class="form-control" placeholder="Optional: enter research link (e.g., Google Drive)">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i> Save Research
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


<!-- fetching and population of modal push to iptbm -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commoditySelect = document.getElementById('commoditySelect');
        const commodityOther = document.getElementById('commodityOther');

        // Toggle "other" input visibility
        commoditySelect.addEventListener('change', function() {
            if (this.value === 'other') {
                commodityOther.style.display = 'block';
                commodityOther.required = true;
            } else {
                commodityOther.style.display = 'none';
                commodityOther.required = false;
            }
        });

        // Auto-fill "commodity" with priority area when modal opens
        document.querySelectorAll('.push-to-iptbm-btn').forEach(button => {
            button.addEventListener('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('pushToIptbmModal'));

                document.getElementById('kmu_id').value = this.dataset.id;
                document.getElementById('thesis_title').value = this.dataset.title;
                document.getElementById('technology_generator').value = this.dataset.authors;
                document.getElementById('type_of_technology').value = this.dataset.technology_type;
                document.getElementById('priority_area').value = this.dataset.priority_area;
                document.getElementById('link').value = this.dataset.link;

                // Auto-select or suggest commodity
                const priorityArea = this.dataset.priority_area || '';
                let found = false;

                // Loop through select options to see if it matches priority_area
                for (const option of commoditySelect.options) {
                    if (option.value.toLowerCase() === priorityArea.toLowerCase()) {
                        commoditySelect.value = option.value;
                        found = true;
                        break;
                    }
                }

                // If not found, set “other” and prefill the text field
                if (!found) {
                    commoditySelect.value = 'other';
                    commodityOther.style.display = 'block';
                    commodityOther.value = ''; // empty by default
                } else {
                    commodityOther.style.display = 'none';
                    commodityOther.value = '';
                }

                modal.show();
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('pushToIptbmForm');
        const modalEl = document.getElementById('pushToIptbmModal');
        const modal = new bootstrap.Modal(modalEl);

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch("{{ route('admin.pushToIptbm') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1800
                        });
                        modal.hide(); // close modal
                        form.reset(); // clear form
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Duplicate',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong while pushing the record. Please try again.'
                    });
                });
        });
    });
</script>

<!-- handle acknowledgement button -->
<script>
    $(document).ready(function() {
        // Handle Acknowledge form submission
        $(document).on('submit', '.acknowledge-form', function(e) {
            e.preventDefault(); // stop normal form submission

            const form = $(this);
            const id = form.find('button').data('id');

            $.ajax({
                url: `/admin/new-research/${id}/acknowledge`,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Acknowledged!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        // ✅ Smooth auto-update of row (no reload)
                        const table = $('#sampleTable').DataTable();
                        const row = form.closest('tr');
                        const rowData = table.row(row).data();

                        // Update the "status" visually — for example, remove button & show "Active"
                        rowData[7] = `<span class="badge bg-success">Acknowledged</span>`;
                        table.row(row).data(rowData).invalidate().draw(false);

                        // Optionally disable the acknowledge button to prevent re-click
                        form.remove();

                    } else {
                        Swal.fire('Notice', response.message, 'warning');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
        });
    });
</script>

<!-- Push to Extension logic -->
<script>
    $(document).ready(function() {
        // ✅ Prevent multiple DataTable initializations
        if (!$.fn.DataTable.isDataTable('#sampleTable')) {
            $('#sampleTable').DataTable({
                responsive: true,
                order: [
                    [6, 'desc']
                ],
                language: {
                    searchPlaceholder: "Search research...",
                    search: "",
                }
            });
        }

        // ✅ Push to Extension logic
        $(document).on('click', '.push-to-extension', function() {
            const button = $(this);
            const researchId = button.data('id');

            Swal.fire({
                title: 'Push to Extension?',
                text: "This will move the research to the Extension list.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, push it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/extensions/push/${researchId}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                const table = $('#sampleTable').DataTable();
                                const row = button.closest('tr');
                                const rowData = table.row(row).data();

                                // ✅ Replace actions column with a badge
                                rowData[7] = `
                                <span class="badge bg-success">
                                    <i class="bi bi-box-seam me-1"></i> Pushed to Extension
                                </span>
                            `;

                                // ✅ Update the table instantly
                                table.row(row).data(rowData).invalidate().draw(false);

                            } else {
                                Swal.fire('Notice', response.message, 'warning');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

<!-- Deletion -->
<script>
    $(document).on('click', '.delete-research', function() {
        const button = $(this);
        const id = button.data('id');

        Swal.fire({
            title: 'Delete this record?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/new-research/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');

                            // Remove deleted row
                            const table = $('#sampleTable').DataTable();
                            const row = button.closest('tr');
                            table.row(row).remove().draw(false);
                        } else {
                            Swal.fire('Notice', response.message, 'warning');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete record.', 'error');
                    }
                });
            }
        });
    });
</script>

<script>
    // ✅ SweetAlert for success or error messages after adding research
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('
        success ') }}',
        confirmButtonColor: '#198754'
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('
        error ') }}',
        confirmButtonColor: '#dc3545'
    });
    @endif
</script>
@endpush