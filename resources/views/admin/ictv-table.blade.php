@extends('layouts.admin')

@section('title', 'ICTV Table Content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">ICTV Episodes</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $episodes->count() }} total</span>
                    <a href="{{ route('admin.ictv') }}" class="btn btn-sm btn-primary" title="Add New Episode">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    <a href="{{ route('ictv') }}" class="btn btn-sm btn-dark" target="_blank" title="View Page">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="ictvTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Episode</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($episodes as $episode)
                            <tr>
                                <td>{{ $episode->id }}</td>
                                <td>{{ $episode->title }}</td>
                                <td>{{ $episode->description }}</td>
                                <td>
                                    <a href="{{ $episode->link }}" target="_blank" class="btn btn-sm btn-primary">
                                        View Episode
                                    </a>
                                </td>
                                <td>
                                    @if ($episode->png)
                                        <img src="{{ asset('storage/ictv_thumbnail/' . $episode->png) }}" width="60" alt="png">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $episode->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button type="button"
                                            class="btn btn-sm btn-success edit-btn"
                                            title="Edit"
                                            data-id="{{ $episode->id }}"
                                            data-title="{{ $episode->title }}"
                                            data-description="{{ $episode->description }}"
                                            data-link="{{ $episode->link }}"
                                            data-thumbnail-webp="{{ asset('storage/ictv_thumbnail/' . $episode->webp) }}"
                                            data-thumbnail-png="{{ asset('storage/ictv_thumbnail/' . $episode->png) }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button"
                                            class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $episode->id }}"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                @include('admin.components.modal-ictv')
            </div>
        </div>
    </div>
@endsection

@push('scripts')

<!-- DataTable Config -->
<script>
    $(document).ready(function () {
        $('#ictvTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[5, 'desc']]
        });
    });
</script>

<!-- SweetAlert Delete -->
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the episode.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/admin/ictv/${id}`)
                        .then(response => {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The episode has been deleted.',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire('Error', 'There was a problem deleting the episode.', 'error');
                            console.error(error);
                        });
                }
            });
        });
    });
</script>

<!-- Edit Modal Population -->
<script>
    $(document).ready(function () {
        $('.edit-btn').on('click', function () {
            const episodeId = $(this).data('id');
            const title = $(this).data('title');
            const description = $(this).data('description');
            const link = $(this).data('link');
            const thumbnailWebp = $(this).data('thumbnail-webp');
            const thumbnailPng = $(this).data('thumbnail-png');

            $('#edit_id').val(episodeId);
            $('#edit_title').val(title);
            $('#edit_description').val(description);
            $('#edit_link').val(link);
            $('#editEpisodeForm').attr('action', `/admin/ictv/${episodeId}`);

            let previewHTML = '';
            if (thumbnailWebp) {
                previewHTML += `
                    <div style="display:inline-block; text-align:center; margin-right:10px;">
                        <small>WEBP</small><br>
                        <img src="${thumbnailWebp}" alt="WEBP Thumbnail" width="80" class="img-thumbnail">
                    </div>`;
            }
            if (thumbnailPng) {
                previewHTML += `
                    <div style="display:inline-block; text-align:center;">
                        <small>PNG</small><br>
                        <img src="${thumbnailPng}" alt="PNG Thumbnail" width="80" class="img-thumbnail">
                    </div>`;
            }

            $('#current_thumbnail').html(previewHTML);
            $('#editEpisodeModal').modal('show');
        });
    });
</script>

<!-- Drag & Drop Upload -->
<script>
    document.querySelectorAll('.drop-area').forEach(area => {
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

    <!-- SweetAlert Feedback -->
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
