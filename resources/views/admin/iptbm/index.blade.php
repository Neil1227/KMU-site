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
                            <th>Thesis Title</th>
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
                                    {{ Str::limit($commertial->thesis_title ?? '—', 50) }}</td>
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
                                    <button class="btn btn-primary btn-sm push-to-registered"
                                        data-id="{{ $commertial->id }}" data-technology="{{ $commertial->technologies }}"
                                        data-generator="{{ $commertial->technology_generator }}"
                                        title="Register Technology">
                                        <i class="bi bi-send"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm delete-notif"
                                        data-url="{{ route('admin.iptbm.destroy', $commertial->id) }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
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
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#commercializationTable').DataTable({
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

            // Folding row logic
            $('#commercializationTable tbody').on('click', 'td:first-child', function() {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var arrow = $(this).find('.expand-toggle');

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('expanded');
                } else {
                    var detailsHtml = tr.find('td').map(function(i) {
                        var title = $('#commercializationTable thead th').eq(i).text();
                        if ($(this).hasClass('hide-column')) {
                            return `<div><strong>${title}:</strong> ${$(this).attr('data-full') || $(this).text()}</div>`;
                        }
                    }).get().join('');
                    row.child(`<div class="folding-row p-2 bg-light">${detailsHtml}</div>`).show();
                    tr.addClass('expanded');
                }
            });

            // Delete record
            $(document).on('click', '.delete-notif', function() {
                var url = $(this).data('url');
                var tr = $(this).closest('tr');

                Swal.fire({
                    title: "Are you sure?",
                    text: "This will permanently delete the record.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: "Yes, delete it!"
                }).then(async (result) => {
                    if (result.isConfirmed) {
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
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                                table.row(tr).remove().draw();
                            } else Swal.fire("Error", data.message, "error");
                        } catch {
                            Swal.fire("Error", "Something went wrong.", "error");
                        }
                    }
                });
            });

            // Push modal
            $(document).on('click', '.push-to-registered', function() {
                $('#technology').val($(this).data('technology'));
                $('#techGenerator').val($(this).data('generator'));
                $('#description').val('');
                $('#link').val('');
                $('#notificationId').val($(this).data('id'));
                $('#pushTechnologyModal').modal('show');
            });

            // Push technology AJAX
            $('#pushTechnologyForm').on('submit', function(e) {
                e.preventDefault();
                let notificationId = $('#notificationId').val();
                let row = $(`tr[data-id="${notificationId}"]`);

                $.ajax({
                    url: "{{ route('admin.registered-technology.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        $('#pushTechnologyModal').modal('hide');
                        table.row(row).remove().draw();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'Something went wrong'
                        });
                    }
                });
            });
        });
    </script>
@endpush
