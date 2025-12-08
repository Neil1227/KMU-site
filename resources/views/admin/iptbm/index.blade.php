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
                            <th>College</th>
                            <th class="hide-column">Type of Technology</th>
                            <th>Link</th>
                            <th class="hide-column">Priority Area</th>
                            <th>Pushed To</th> <!-- NEW COLUMN -->
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
                                    <span data-full="{{ $commodity->commodity ?? '—' }}">
                                        {{ $commodity->commodity ?? '—' }}
                                    </span>
                                </td>
                                <td data-full="{{ $commertial->thesis_title ?? '—' }}">
                                    {{ $commertial->thesis_title ?? '—' }}
                                </td>
                                <td data-full="{{ $commertial->technologies ?? '—' }}">
                                    {{ Str::limit($commertial->technologies ?? '—', 50) }}
                                </td>
                                <td class="hide-column" data-full="{{ $commertial->technology_generator ?? '—' }}">
                                    {{ $commertial->technology_generator ?? '—' }}
                                </td>
                                <td class="hide-column" data-full="{{ $commertial->contact_info ?? '—' }}">
                                    {{ Str::limit($commertial->contact_info ?? '—', 50) }}
                                </td>
                                <td data-full="{{ $commertial->college ?? '—' }}">
                                    {{ $commertial->college ?? '—' }}
                                </td>
                                <td class="hide-column" data-full="{{ $commertial->type_of_technology ?? '—' }}">
                                    {{ $commertial->type_of_technology ?? '—' }}
                                </td>
                                <td data-full="{{ $commertial->link ?? '—' }}">
                                    @if ($commertial->link)
                                        <a href="{{ $commertial->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="hide-column" data-full="{{ $commertial->priority_area ?? '—' }}">
                                    {{ $commertial->priority_area ?? '—' }}
                                </td>

                                <!-- NEW: Pushed To Column -->
                                <td>
                                    @if ($commertial->pushed_to_promotion && $commertial->pushed_to_agri)
                                        Both
                                    @elseif($commertial->pushed_to_promotion)
                                        Promotional/Development
                                    @elseif($commertial->pushed_to_agri)
                                        Agri-Business
                                    @else
                                        —
                                    @endif
                                </td>

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
                                                <button class="dropdown-item text-warning edit-commercialization"
                                                    data-id="{{ $commertial->id }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>

                                            <li>
                                                <button class="dropdown-item text-success push-to-registered"
                                                    data-id="{{ $commertial->id }}"
                                                    {{ $commertial->pushed_to_promotion ? 'disabled' : '' }}>
                                                    <i class="bi bi-send me-2"></i>Promotional/Development
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-success push-to-agri"
                                                    data-id="{{ $commertial->id }}"
                                                    {{ $commertial->pushed_to_agri ? 'disabled' : '' }}>
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
                                <td colspan="7" class="text-center">No records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="editCommercializationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="editCommercializationForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_comm_id" name="id">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Commercialization</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Commodity</label>

                                    <!-- Visible but NOT editable -->
                                    <input type="text" id="edit_commodity_name" class="form-control" disabled>

                                    <!-- Hidden ID for saving -->
                                    <input type="hidden" id="edit_commodity_id" name="commodity_id">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_thesis_title" class="form-label">Thesis Title</label>
                                    <input type="text" id="edit_thesis_title" name="thesis_title" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_technologies" class="form-label">Technologies</label>
                                    <input type="text" id="edit_technologies" name="technologies"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_technology_generator" class="form-label">Technology Generator</label>
                                    <input type="text" id="edit_technology_generator" name="technology_generator"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_contact_info" class="form-label">Contact Info</label>
                                    <input type="text" id="edit_contact_info" name="contact_info"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_college" class="form-label">College</label>
                                    <select name="college" id="edit_college" class="form-select">
                                        <option value="">Select College</option>
                                        <option value="CAS - College of Arts and Sciences">CAS - College of Arts and
                                            Sciences</option>
                                        <option value="CASTech - College of Agriculture Systems and Technology">CASTech -
                                            College of Agriculture Systems and Technology</option>
                                        <option value="CBEE - College of Business, Economics and Entrepreneurship">CBEE -
                                            College of Business, Economics and Entrepreneurship</option>
                                        <option value="CFAF - College of Forestry and Agroforestry">CFAF - College of
                                            Forestry and Agroforestry</option>
                                        <option value="COECS - College of Engineering and Computer Studies">COECS - College
                                            of Engineering and Computer Studies</option>
                                        <option value="COED - College of Education">COED - College of Education</option>
                                        <option value="CVM - College of Veterinary Medicine">CVM - College of Veterinary
                                            Medicine</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="edit_type_of_technology" class="form-label">Type of Technology</label>
                                    <select name="type_of_technology" id="edit_type_of_technology" class="form-select">
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
                                    <label for="edit_ip_status" class="form-label">IP Status</label>
                                    <select name="ip_status" id="edit_ip_status" class="form-select">
                                        <option value="Non-IP Applied">Non-IP Applied</option>
                                        <option value="IP Applied">IP Applied</option>
                                        <option value="Registered">Registered</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_trl_level" class="form-label">TRL Level</label>
                                    <select name="trl_level" id="edit_trl_level" class="form-select">
                                        @for ($i = 1; $i <= 9; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>


                                <div class="col-md-6">
                                    <label for="edit_sdgs" class="form-label">SDGs</label>
                                    <input type="text" id="edit_sdgs" name="sdgs" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_remarks" class="form-label">Remarks</label>
                                    <select name="remarks" id="edit_remarks" class="form-select">
                                        <option value="For Product Development">For Product Development</option>
                                        <option value="For Incubation">For Incubation</option>
                                        <option value="For Commercialization">For Commercialization</option>
                                        <option value="For IP Application">For IP Application</option>
                                        <option value="For Deployment">For Deployment</option>
                                        <option value="For Extention">For Extention</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>


                                <div class="col-md-12">
                                    <label for="edit_recommendations" class="form-label">Recommendations</label>
                                    <textarea id="edit_recommendations" name="recommendations" class="form-control"></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_link" class="form-label">Link</label>
                                    <input type="text" id="edit_link" name="link" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="edit_priority_area" class="form-label">Priority Area</label>
                                    <select name="priority_area" id="edit_priority_area" class="form-select">
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

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save Changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const table = $('#commercializationTable').DataTable({
                responsive: true
            });

            /* Folding row logic ... (keep your existing folding code) */
            $('#commercializationTable tbody').on('click', '.expand-toggle', function() {
                let tr = $(this).closest('tr');
                let row = table.row(tr);
                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('expanded');
                } else {
                    let details = '';
                    tr.find('td').each(function() {
                        let full = $(this).data('full');
                        let th = $(this).closest('table').find('thead th').eq($(this).index())
                            .text();
                        if (full && th !== "Actions" && th !== "Link") details +=
                            `<p><strong>${th}:</strong> ${full}</p>`;
                    });
                    row.child(details).show();
                    tr.addClass('expanded');
                }
            });

            /* ===== Persistent alerts (unique names to avoid conflicts) ===== */
            function showPersistentSuccess(msg) {
                console.log('[ALERT] showPersistentSuccess:', msg);
                return Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: msg || '',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: true
                });
            }

            function showPersistentError(msg) {
                console.log('[ALERT] showPersistentError:', msg);
                return Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg || '',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: true
                });
            }

            function askConfirm(text) {
                console.log('[ALERT] askConfirm');
                return Swal.fire({
                    title: 'Confirm',
                    text: text || 'Are you sure?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel',
                    allowOutsideClick: false
                });
            }

            /* ===== DELETE RECORD ===== */
            $(document).on('click', '.delete-notif', async function() {
                const tr = $(this).closest('tr');
                const id = tr.data('id');
                const url = $(this).data('url');

                const result = await askConfirm('This will permanently delete the record.');
                if (!result.isConfirmed) return;

                try {
                    const res = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Accept': 'application/json'
                        }
                    });
                    const data = await res.json();
                    console.log('[DELETE] response:', data);

                    if (data.success) {
                        await showPersistentSuccess(data.message || 'Deleted.');
                        table.row(tr).remove().draw();
                    } else {
                        await showPersistentError(data.message || 'Delete failed.');
                    }
                } catch (e) {
                    console.error('[DELETE] error', e);
                    await showPersistentError('Something went wrong.');
                }
            });

            /* ===== PUSH TO AGRI ===== */
            $(document).on('click', '.push-to-agri', function() {
                const commId = $(this).data('id');
                const tr = $(this).closest('tr');

                console.log('[PUSH TO AGRI] start, id=', commId);
                axios.post(`/admin/agri-business/push/${commId}`)
                    .then(async (res) => {
                        console.log('[PUSH TO AGRI] response', res.data);
                        await showPersistentSuccess(res.data.message || 'Pushed to Agri-Business!');
                        tr.find('.push-to-registered, .push-to-agri').prop('disabled', true);
                        const pushedCol = tr.find('td').eq(9);
                        const current = pushedCol.text().trim();
                        if (current === '—') pushedCol.text('Agri-Business');
                        else if (current === 'Promotional/Development') pushedCol.text('Both');
                    })
                    .catch(async (err) => {
                        console.error('[PUSH TO AGRI] error', err?.response?.data || err);
                        await showPersistentError(err?.response?.data?.message ||
                            'Unable to push record.');
                    });
            });

            /* ===== PUSH TO REGISTERED TECHNOLOGY ===== */
            $(document).on('click', '.push-to-registered', function() {
                const commId = $(this).data('id');
                const tr = $(this).closest('tr');

                console.log('[PUSH TO REGISTERED] id=', commId);
                axios.post(`/admin/promotion/push/${commId}`)
                    .then(async (res) => {
                        console.log('[PUSH TO REGISTERED] response', res.data);
                        await showPersistentSuccess(res.data.message || 'Pushed successfully.');
                        tr.find('.push-to-registered, .push-to-agri').prop('disabled', true);
                        const pushedCol = tr.find('td').eq(9);
                        const current = pushedCol.text().trim();
                        if (current === '—') pushedCol.text('Promotional/Development');
                        else if (current === 'Agri-Business') pushedCol.text('Both');
                    })
                    .catch(async (err) => {
                        console.error('[PUSH TO REGISTERED] error', err?.response?.data || err);
                        if (err?.response?.status === 409) {
                            await Swal.fire('Already Exists', 'This record is already pushed.',
                                'info');
                        } else {
                            await showPersistentError('Unable to push record.');
                        }
                    });
            });

            /* ===== EDIT - OPEN MODAL ===== */
            $(document).on('click', '.edit-commercialization', function() {
                const commId = $(this).data('id');
                console.log('[EDIT] fetching', commId);

                axios.get(`/admin/commercialization/${commId}/edit`)
                    .then(res => {
                        console.log('[EDIT] data', res.data);
                        const data = res.data;

                        $('#edit_comm_id').val(data.id);
                        $('#edit_commodity_name').val(data.commodity ? data.commodity.commodity : '');
                        $('#edit_commodity_id').val(data.commodity_id);
                        $('#edit_thesis_title').val(data.thesis_title);
                        $('#edit_technologies').val(data.technologies);
                        $('#edit_technology_generator').val(data.technology_generator);
                        $('#edit_contact_info').val(data.contact_info);
                        $('#edit_college').val(data.college);
                        $('#edit_type_of_technology').val(data.type_of_technology);
                        $('#edit_ip_status').val(data.ip_status);
                        $('#edit_trl_level').val(data.trl_level);
                        $('#edit_sdgs').val(data.sdgs);
                        $('#edit_remarks').val(data.remarks);
                        $('#edit_recommendations').val(data.recommendations);
                        $('#edit_link').val(data.link);
                        $('#edit_priority_area').val(data.priority_area);

                        $('#editCommercializationModal').modal('show');
                    })
                    .catch(err => {
                        console.error('[EDIT] fetch error', err);
                        showPersistentError('Unable to fetch record.');
                    });
            });

            /* ===== EDIT - SUBMIT ===== */
            $('#editCommercializationForm').on('submit', function(e) {
                e.preventDefault();
                const commId = $('#edit_comm_id').val();
                const formData = $(this).serialize();

                console.log('[EDIT SUBMIT] id=', commId, 'payload=', formData);
                axios.put(`/admin/commercialization/${commId}`, formData)
                    .then(async res => {
                        console.log('[EDIT SUBMIT] response', res.data);
                        await showPersistentSuccess(res.data.message || 'Updated successfully.');
                        $('#editCommercializationModal').modal('hide');

                        location.reload(); // <-- THIS reloads the table
                    })

                    .catch(async err => {
                        console.error('[EDIT SUBMIT] error', err?.response?.data || err);
                        await showPersistentError(err?.response?.data?.message ||
                            'Failed to update.');
                    });
            });

        });
    </script>
@endpush
