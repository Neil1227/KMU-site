@extends('layouts.admin')

@section('title', 'Manage Technology Business Incubation Records')

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
                <h5 class="mb-0">Technology Business Incubation Records</h5>
                <span class="badge bg-light text-dark">{{ $tbiRecords->count() }} total</span>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="tbiTable" class="table table-bordered table-striped table-sm align-middle nowrap">
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
                        @forelse ($tbiRecords as $tbi)
                            <tr data-id="{{ $tbi->id }}">
                                <td>{{ Str::limit($tbi->thesis_title ?? '—', 50) }}</td>
                                <td>{{ Str::limit($tbi->technologies ?? '—', 50) }}</td>
                                <td>{{ $tbi->technology_generator ?? '—' }}</td>
                                <td>{{ $tbi->type_of_technology ?? '—' }}</td>
                                <td>{{ Str::limit($tbi->contact_info ?? '—', 50) }}</td>
                                <td>{{ Str::limit($tbi->remarks ?? '—', 50) }}</td>

                                <td>
                                    @if ($tbi->link)
                                        <a href="{{ $tbi->link }}" target="_blank"
                                            class="text-decoration-underline">View</a>
                                    @else
                                        —
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button"
                                            id="actionDropdown{{ $tbi->id }}" data-bs-toggle="dropdown">
                                            Actions
                                        </button>

                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item text-warning edit-record"
                                                    data-id="{{ $tbi->id }}"
                                                    data-thesis_title="{{ $tbi->thesis_title }}"
                                                    data-technologies="{{ $tbi->technologies }}"
                                                    data-technology_generator="{{ $tbi->technology_generator }}"
                                                    data-type_of_technology="{{ $tbi->type_of_technology }}"
                                                    data-contact_info="{{ $tbi->contact_info }}"
                                                    data-remarks="{{ $tbi->remarks }}" data-link="{{ $tbi->link }}">
                                                    <i class="bi bi-pencil-square me-2"></i>Edit
                                                </button>
                                            </li>

                                            <li>
                                                <button class="dropdown-item text-danger delete-notif"
                                                    data-url="{{ route('admin.tbi.destroy', $tbi->id) }}">
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

                {{-- Edit TBI Modal --}}
                <div class="modal fade" id="editTbiModal" tabindex="-1" aria-labelledby="editTbiModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <form id="editTbiForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-header">
                                    <h5 class="modal-title">Edit TBI Record</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="editTbiId" name="id">

                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label">Thesis Title</label>
                                            <input type="text" class="form-control" id="thesis_title"
                                                name="thesis_title">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Technologies</label>
                                            <input type="text" class="form-control" id="technologies"
                                                name="technologies">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Technology Generator</label>
                                            <input type="text" class="form-control" id="technology_generator"
                                                name="technology_generator">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Type of Technology</label>
                                            <input type="text" class="form-control" id="type_of_technology"
                                                name="type_of_technology">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Contact Info</label>
                                            <input type="text" class="form-control" id="contact_info"
                                                name="contact_info">
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Remarks</label>
                                            <input type="text" class="form-control" id="remarks" name="remarks">
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label">Link</label>
                                            <input type="text" class="form-control" id="link" name="link">
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

    <script>
        $(document).ready(function() {

            $('#tbiTable').DataTable({
                responsive: true
            });

            // Open Edit Modal
            $(document).on('click', '.edit-record', function() {
                $('#editTbiForm')[0].reset();

                const id = $(this).data('id');
                $('#editTbiId').val(id);

                $('#thesis_title').val($(this).data('thesis_title'));
                $('#technologies').val($(this).data('technologies'));
                $('#technology_generator').val($(this).data('technology_generator'));
                $('#type_of_technology').val($(this).data('type_of_technology'));
                $('#contact_info').val($(this).data('contact_info'));
                $('#remarks').val($(this).data('remarks'));
                $('#link').val($(this).data('link'));

                $('#editTbiForm').attr('action', `/admin/tbi/${id}`);

                $('#editTbiModal').modal('show');
            });

        });
    </script>
@endpush
