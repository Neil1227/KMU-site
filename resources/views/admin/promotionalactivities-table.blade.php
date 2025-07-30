@extends('layouts.admin')

@section('title', 'Promotional Activities')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Promotional Activities</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $promotional->count() }} total</span>
                    <a href="{{ route('admin.promotional') }}" class="btn btn-sm btn-primary" title="Add New Activity">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    <a href="{{ route('promotional') }}" class="btn btn-sm btn-dark" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="promoTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Thumbnail</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promotional as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->title }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>
                                    @if ($activity->link)
                                        <a href="{{ $activity->link }}" target="_blank" class="btn btn-sm btn-primary">
                                            View Link
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($activity->png)
                                        <img src="{{ asset('storage/promotional_thumbnail/' . $activity->png) }}" width="60" alt="Thumbnail">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $activity->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <button 
                                        type="button" 
                                        class="btn btn-success btn-sm edit-promo-btn"
                                        data-id="{{ $activity->id }}"
                                        data-title="{{ $activity->title }}"
                                        data-description="{{ $activity->description }}"
                                        data-link="{{ $activity->link }}"
                                        data-thumbnail="{{ $activity->png }}"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $activity->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin.components.modal-promotional')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- table config -->
<script>
    $(document).ready(function () {
        $('#promoTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[5, 'desc']]
        });
    });
</script>

<!-- Edit Modal Population for Promotional -->
    <script>
        $(document).ready(function () {
            $('.edit-promo-btn').on('click', function () {
                const promoId = $(this).data('id');
                const title = $(this).data('title');
                const description = $(this).data('description');
                const link = $(this).data('link');
                const thumbnail = $(this).data('thumbnail');

                // Match the input IDs inside your modal
                $('#promo_edit_id').val(promoId);
                $('#promo_edit_title').val(title);
                $('#promo_edit_description').val(description);
                $('#promo_edit_link').val(link);
                $('#editPromoForm').attr('action', `/admin/promotional/${promoId}`);

                let previewHTML = '';
                if (thumbnail) {
                    previewHTML = `
                        <div style="display:inline-block; text-align:center;">
                            <small>Current Thumbnail</small><br>
                            <img src="/storage/promotional_thumbnail/${thumbnail}" alt="Thumbnail" width="80" class="img-thumbnail">
                        </div>`;
                }

                $('#promo_current_thumbnail').html(previewHTML);
                $('#editPromoModal').modal('show');
            });
        });
    </script>

<!-- drag and drop and upload -->
<script>
    document.querySelectorAll('#editPromoModal .drop-area').forEach(area => {
        const input = area.querySelector('.file-input');
        const text = area.querySelector('.upload-text');

        area.addEventListener('click', () => input.click());

        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                text.textContent = input.files[0].name;
            }
        });

        area.addEventListener('dragover', e => {
            e.preventDefault();
            area.classList.add('drag-over');
        });

        area.addEventListener('dragleave', () => {
            area.classList.remove('drag-over');
        });

        area.addEventListener('drop', e => {
            e.preventDefault();
            area.classList.remove('drag-over');

            const droppedFile = e.dataTransfer.files[0];
            if (droppedFile) {
                input.files = e.dataTransfer.files;
                text.textContent = droppedFile.name;
            }
        });
    });
</script>


<!-- SweetAlert Delete for Promotional Activity -->
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the promotional activity.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/promotionalactivities/${id}`)
                        .then(response => {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The promotional activity has been deleted.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error', 'There was a problem deleting the activity.', 'error');
                            console.error(error);
                        });
                }
            });
        });
    });
</script>


@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    </script>
@endif
@endpush