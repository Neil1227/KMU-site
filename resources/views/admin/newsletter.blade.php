@extends('layouts.admin')

@section('title', 'Upload Newsletter')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-content.css') }}">
@endpush

@section('content')
            <div class="row g-4">
                <!-- IEC Upload Form -->
                <div class="col-md-6">
                    <div class="ictv-form mt-2">
                        <div class="form-title">
                            <h4 class="text-white mb-0">Newsletter Details</h4>
                        </div>

                        <form action="{{ route('admin.newsletter.upload') }}" method="POST" enctype="multipart/form-data" data-show-loader>
                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="newsletter-pdf" class="form-label">Upload PDF</label>
                                    <div class="upload-box drop-area">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Upload PDF file</p>
                                        <input type="file" class="file-input" id="newsletter-pdf" name="newsletter-pdf" accept="application/pdf" hidden>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="newsletter-png" class="form-label">PNG Image</label>
                                    <div class="upload-box drop-area">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Upload PNG file</p>
                                        <input type="file" class="file-input" id="newsletter-png" name="newsletter-png" accept="image/png" hidden>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-upload w-100">
                                <i class="fa fa-upload me-1"></i> Upload Newsletter Content
                            </button>
                        </form>

                    </div>
                </div>


                <!-- Quick Actions + Dashboard Stats -->
                <div class="col-md-6">
                        @include('admin.components.quick-action')

                        <!-- Dashboard Summary Cards -->
                        @include('admin.components.stats-card')
                    </div>
                </div>
            </div>

@endsection
@push('scripts')


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
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(droppedFile);
                input.files = dataTransfer.files;
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
            text: @json(session('success')),
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
            text: @json(session('error')),
            showConfirmButton: true
        });
    </script>
@endif
@endpush