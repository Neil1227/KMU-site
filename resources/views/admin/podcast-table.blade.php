@extends('layouts.admin')

@section('title', 'Podcasts')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Podcasts</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $podcasts->count() }} total</span>
                    <a href="{{ route('admin.podcast') }}" class="btn btn-sm btn-primary" title="Add New Podcast">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    
                    <a href="{{ route('podcast') }}" class="btn btn-sm btn-dark" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="podcastTable" class="display table table-bordered table-striped table-sm">
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
                        @forelse ($podcasts as $podcast)
                            <tr>
                                <td>{{ $podcast->id }}</td>
                                <td>{{ $podcast->title }}</td>
                                <td>{{ $podcast->description }}</td>
                                <td>
                                    @if ($podcast->link)
                                        <a href="{{ $podcast->link }}" target="_blank" class="btn btn-sm btn-primary">
                                            View Link
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($podcast->png)
                                        <img src="{{ asset('storage/podcast_thumbnail/' . $podcast->png) }}" width="60" alt="Thumbnail">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $podcast->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success edit-podcast-btn"
                                        data-id="{{ $podcast->id }}"
                                        data-title="{{ $podcast->title }}"
                                        data-description="{{ $podcast->description }}"
                                        data-link="{{ $podcast->link }}"
                                        data-thumbnail="{{ $podcast->png }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>


                                    <button class="btn btn-danger btn-sm delete-podcast" data-id="{{ $podcast->id }}">
                                        <i class="bi bi-trash"></i> 
                                    </button>

                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @include('admin.components.modal-podcast')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- table config -->
<script>
    $(document).ready(function () {
        $('#podcastTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[5, 'desc']]
        });
    });
</script>

<!-- Edit Modal Population for Podcast -->
<script>
 $(document).ready(function () {
    $('.edit-podcast-btn').on('click', function () {
        const podcastId = $(this).data('id');
        const title = $(this).data('title');
        const description = $(this).data('description');
        const link = $(this).data('link');
        const thumbnail = $(this).data('thumbnail');

        $('#podcast_edit_id').val(podcastId);
        $('#podcast_edit_title').val(title);
        $('#podcast_edit_description').val(description);
        $('#podcast_edit_link').val(link);
        $('#editPodcastForm').attr('action', `/admin/podcast/${podcastId}`);

        let previewHTML = '';
        if (thumbnail) {
            previewHTML = `
                <div style="display:inline-block; text-align:center;">
                    <small>Current Thumbnail</small><br>
                    <img src="/storage/podcast_thumbnail/${thumbnail}" alt="Thumbnail" width="80" class="img-thumbnail">
                </div>`;
        }

        $('#podcast_current_thumbnail').html(previewHTML);
        $('#editPodcastModal').modal('show');
    });
    });
</script>

<!-- Edit Save for Podcast with SweetAlert + Axios -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const savePodcastBtn = document.getElementById("saveEditPodcastBtn");

        savePodcastBtn.addEventListener("click", function (e) {
            e.preventDefault();

            const form = document.getElementById("editPodcastForm");
            const formData = new FormData(form);
            const id = document.getElementById("podcast_edit_id").value;

            formData.append('_method', 'PUT');

            axios.post(`/admin/podcasts/${id}`, formData, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then(response => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: response.data.message || "Podcast updated successfully.",
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                console.error("Podcast update error:", error.response || error);
                Swal.fire("Error", "Something went wrong while updating the podcast.", "error");
            });
        });
    });
</script>


<!-- drag and drop and upload for Podcast -->
<script>
    document.querySelectorAll('#editPodcastModal .drop-area').forEach(area => {
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

<!-- delte js -->
<script>
    document.querySelectorAll('.delete-podcast').forEach(button => {
        button.addEventListener('click', function () {
            const podcastId = this.dataset.id;

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the podcast.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/podcasts/${podcastId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: data.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
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
