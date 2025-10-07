@extends('layouts.admin')

@section('title', 'Manage Applied Records')

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
        transform: rotate(90deg); /* ▶ turns ▼ */
    }
    .details-row {
        background: #f9f9f9;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="card ictv-card mt-4">
        <!-- Header -->
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Registered Records</h5>
            <span class="badge bg-light text-dark">{{ $commodities->count() }} total</span>
        </div>

        <!-- Table -->
        <div class="card-body table-responsive-sm">
            <table id="appliedTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Technology</th>
                        <th>Inventor/s</th>
                        <th>Description of the Product</th>
                        <th>Link</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($commodities as $commodity)
                        <tr data-id="{{ $commodity->id }}">
                            <td class="details-toggle" data-full="{{ $commodity->technology ?? '—' }}">
                                <span class="arrow-icon">▶</span>
                                {{ Str::limit($commodity->technology ?? '—', 50) }}
                            </td>
                            <td data-full="{{ $commodity->technology_generator ?? '—' }}">
                                {{ Str::limit($commodity->technology_generator ?? '—', 50) }}
                            </td>
                            <td data-full="{{ $commodity->description ?? '—' }}">
                                {{ Str::limit($commodity->description ?? '—', 50) }}
                            </td>
                            <td>
                                @if(!empty($commodity->link))
                                    <a href="{{ $commodity->link }}" target="_blank">View</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger btn-sm delete-notif" data-id="{{ $commodity->id }}">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No registered records found.</td>
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
    let table = $('#appliedTable').DataTable({
        responsive: false,
        order: [] // disables default ordering, keeps server-side ordering (latest first)
    });

    // Toggle details when clicking on Technology cell
    $('#appliedTable tbody').on('click', 'td.details-toggle', function () {
        let tr = $(this).closest('tr');
        let row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            let tech = tr.find('td:eq(0)').data('full');
            let inventors = tr.find('td:eq(1)').data('full');
            let desc = tr.find('td:eq(2)').data('full');

            row.child(`
                <div class="p-3 details-row">
                    <p><strong>Technology:</strong> ${tech}</p>
                    <p><strong>Inventor/s:</strong> ${inventors}</p>
                    <p><strong>Description:</strong> ${desc}</p>
                </div>
            `).show();
            tr.addClass('shown');
        }
    });
});



    // destroy script
    $(document).on('click', '.delete-notif', function() {
        let id = $(this).data('id');
        let row = $(this).closest('tr');

        Swal.fire({
            title: 'Are you sure?',
            text: "This will delete the technology permanently.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/admin/registered-technology/${id}`,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if(res.success){
                            row.fadeOut(300, function() { $(this).remove(); });
                            Swal.fire('Deleted!', res.message, 'success');
                        } else {
                            Swal.fire('Error!', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong.', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
