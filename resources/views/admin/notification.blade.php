@extends('layouts.admin')

@section('title', 'Manage Application')

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
        <!-- Header -->
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Notifications</h5>
            <span class="badge bg-light text-dark">{{ $notifications->count() }} total</span>
        </div>

        <!-- Table -->
        <div class="card-body table-responsive-sm">
            <table id="notificationTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>Commodity</th>
                        <th>Thesis Title</th>
                        <th>Technologies</th>
                        <th>Technology Generator</th>
                        <th>Contact Info</th>
                        <th>Type of Technology</th>
                        <th>Link</th>
                        <th>Priority Area</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifications as $notification)
                        @php $commodity = $notification->commodity; @endphp
                        <tr data-id="{{ $notification->id }}">
                            <td data-full="{{ $commodity->commodity ?? '—' }}">{{ $commodity->commodity ?? '—' }}</td>
                            <td data-full="{{ $commodity->thesis_title ?? '—' }}">{{ Str::limit($commodity->thesis_title ?? '—', 50) }}</td>
                            <td data-full="{{ $commodity->technologies ?? '—' }}">{{ Str::limit($commodity->technologies ?? '—', 50) }}</td>
                            <td data-full="{{ $commodity->technology_generator ?? '—' }}">{{ Str::limit($commodity->technology_generator ?? '—', 50) }}</td>
                            <td data-full="{{ $commodity->contact_info ?? '—' }}">{{ Str::limit($commodity->contact_info ?? '—', 50) }}</td>
                            <td data-full="{{ $commodity->type_of_technology ?? '—' }}">{{ $commodity->type_of_technology ?? '—' }}</td>
                            <td data-full="{{ $commodity->link ?? '—' }}">
                                @if($commodity->link)
                                    <a href="{{ $commodity->link }}" target="_blank" class="text-decoration-underline">View</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td data-full="{{ $commodity->priority_area ?? '—' }}">{{ $commodity->priority_area ?? '—' }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm push-to-registered"
                                data-id="{{ $notification->id }}"
                                    data-technology="{{ $commodity->technologies }}"
                                    data-generator="{{ $commodity->technology_generator }}"
                                    data-link="{{ $commodity->link }}">
                                    <i class="bi bi-send"></i>
                                </button>


                                <button class="btn btn-danger btn-sm delete-notif" data-id="{{ $notification->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No notifications found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Push to Registered Modal -->
<!-- Push Technology Modal -->
<div class="modal fade" id="pushTechnologyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="pushTechnologyForm" method="POST" action="{{ route('admin.registered-technology.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Push Technology</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="technology_generator" id="techGenerator">
                    
                    <div class="mb-3">
                        <label for="technology" class="form-label">Technology</label>
                        <input type="text" class="form-control" name="technology" id="technology" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">New Link</label>
                        <input type="url" class="form-control" name="link" id="link" placeholder="https://example.com" required>
                    </div>
                    <input type="hidden" name="notification_id" id="notificationId">

                        <input type="hidden" name="notification_id" id="notificationId">

                    <div class="mb-3">
                        <label for="description" class="form-label">Description of the Product</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Push</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="customModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
$(document).on('click', '.delete-notif', function () {
    let id = $(this).data('id');
    let row = $(this).closest('tr');

    Swal.fire({
        title: 'Are you sure?',
        text: "This notification will be deleted permanently.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/notifications/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.success) {
                        row.fadeOut(300, function () { 
                            $(this).remove();
                        });

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: response.message || 'Notification deleted successfully.',
                            timer: 1500,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Something went wrong.'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Failed to delete notification.'
                    });
                }
            });
        }
    });
});
</script>

<!-- push to registered -->
<script>

    // Push to Registered Modal
        $(document).on('click', '.push-to-registered', function(){
            $('#technology').val($(this).data('technology'));
            $('#techGenerator').val($(this).data('generator'));
            $('#description').val('');
            $('#link').val(''); // clear it so user must enter new link
            $('#notificationId').val($(this).data('id'));
            $('#pushTechnologyModal').modal('show');
        });


    // Push Technology AJAX with delete
$('#pushTechnologyForm').on('submit', function(e){
    e.preventDefault();
    let notificationId = $('#notificationId').val(); // now this is correct
    let row = $(`tr[data-id="${notificationId}"]`);

    $.ajax({
        url: "{{ route('admin.registered-technology.store') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function(response){
            Swal.fire({icon:'success', title:'Success', text: response.message});
            $('#pushTechnologyModal').modal('hide');

            // Remove the row from the table
            row.fadeOut(300, function(){ $(this).remove(); });
        },
        error: function(xhr){
            Swal.fire({icon:'error', title:'Error', text: xhr.responseJSON?.message || 'Something went wrong'});
        }
    });
});






</script>

<!-- table config -->
<script>
    $(document).ready(function() {
        $('#notificationTable').DataTable({
            responsive: {
                details: {
                    display: function(row, update) {
                        if (!update) {
                            const tr = row.node();
                            const dl = $('<dl class="row"/>');

                            $(tr).find('td').each(function(i){
                                const title = $('#notificationTable thead th').eq(i).text();
                                if(title !== 'Actions') {
                                    dl.append(`<dt class="col-sm-3 fw-bold">${title}:</dt>
                                            <dd class="col-sm-9">${$(this).attr('data-full') || $(this).text()}</dd>`);
                                }
                            });

                            $('#customModal .modal-title').html(`Details for <span class="text-primary fw-bold">${$(tr).find('td').eq(0).attr('data-full')}</span>`);
                            $('#customModal .modal-body').html(dl);
                            $('#customModal').modal('show');
                        }
                    },
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({ tableClass: 'table table-sm' })
                }
            },
            columnDefs: [
                { orderable: false, targets: -1 }
            ],
            columns: [
                { responsivePriority: 1, className: "all" },
                { responsivePriority: 2, className: "all" },
                { className: "all" },
                { className: "none" },
                { className: "all" },
                { className: "none" },
                { className: "all" },
                { className: "none" },
                { responsivePriority: 3, className: "all" }
            ],
            pageLength: 10,
            lengthMenu: [5,10,25,50],
            autoWidth: false,
            language: { search: "_INPUT_", searchPlaceholder: "Search notifications..." }
        });
    });
</script>


@endpush
