@extends('layouts.admin')

@section('title', 'Upload Newsletter Content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card ictv-card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Newsletters</h5>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $newsletters->count() }} total</span>
                <a href="{{ route('admin.newsletter') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg"></i>
                </a>
                <a href="{{ route('newsletter') }}" class="btn btn-sm btn-dark" target="_blank">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>

        <div class="card-body table-responsive-sm">
            <table id="newsletterTable" class="display table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>PDF File</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletters as $newsletter)
                    <tr>
                        <td>{{ $newsletter->id }}</td>
                        <td>{{ $newsletter->title }}</td>
                        <td>
                            @if ($newsletter->file)
                                <a href="{{ asset('storage/newsletter/' . $newsletter->file) }}" target="_blank" class="btn btn-primary btn-sm">View PDF</a>
                            @else
                                <span class="text-muted">No PDF</span>
                            @endif
                        </td>
                        <td>
                            @if ($newsletter->png)
                                <img src="{{ asset('storage/newsletter_thumbnail/' . $newsletter->png) }}" width="80" alt="Newsletter Image">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $newsletter->created_at->format('Y-m-d h:i A') }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-1">
                                <button type="button" class="btn btn-sm btn-success edit-newsletter-btn"
                                    data-id="{{ $newsletter->id }}"
                                    data-title="{{ $newsletter->title }}"
                                    data-file="{{ asset('storage/newsletter/' . $newsletter->file) }}"
                                    data-thumbnail-png="{{ asset('storage/newsletter_thumbnail/' . $newsletter->png) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-newsletter" data-id="{{ $newsletter->id }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- include('admin.components.modal-newsletter') -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#newsletterTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[4, 'desc']]
        });
    });

    $('.edit-newsletter-btn').on('click', function () {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const pdfFile = $(this).data('file');
        const pngFile = $(this).data('thumbnail-png');

        $('#edit-id').val(id);
        $('#edit_newsletter_title').val(title);
        $('#editNewsletterForm').attr('action', `/admin/newsletters/${id}`);

        let fileHTML = '', thumbnailHTML = '';

        if (pdfFile) {
            fileHTML = `<div><small>PDF</small><br><a href="${pdfFile}" target="_blank">View PDF</a></div>`;
        }
        if (pngFile) {
            thumbnailHTML = `<div><small>PNG</small><br><img src="${pngFile}" width="80" class="img-thumbnail"></div>`;
        }

        $('#current_newsletter_file').html(fileHTML);
        $('#current_newsletter_thumbnail').html(thumbnailHTML);

        $('#editNewsletterModal').modal('show');
    });

    document.getElementById("saveEditNewsletterBtn").addEventListener("click", function (e) {
        e.preventDefault();
        const form = document.getElementById("editNewsletterForm");
        const formData = new FormData(form);
        const id = document.getElementById("edit-id").value;

        formData.append('_method', 'PUT');

        axios.post(`/admin/newsletters/${id}`, formData, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'multipart/form-data',
            }
        })
        .then(response => {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: response.data.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => location.reload());
        })
        .catch(error => {
            console.error(error);
            Swal.fire("Error", "Something went wrong.", "error");
        });
    });

    document.querySelectorAll('.delete-newsletter').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/newsletters/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: data.success,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        setTimeout(() => location.reload(), 1500);
                    })
                    .catch(error => {
                        console.error(error);
                        Swal.fire('Error', 'Something went wrong.', 'error');
                    });
                }
            });
        });
    });
</script>
@endpush
