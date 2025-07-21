@extends('layouts.admin')

@section('title', 'Upload IEC Material')

@section('content')
            <div class="row g-4">
                <!-- IEC Upload Form -->
                <div class="col-md-6">
                    <div class="ictv-form mt-2">
                        <div class="form-title">
                            <h4 class="text-white mb-0">IEC Material Details</h4>
                        </div>

                       <form action="{{ route('admin.iec.upload') }}" id="editIecForm" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="edit_title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="modulues-pdf" class="form-label">Upload PDF</label>
                                    <div class="upload-box drop-area">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Upload PDF file</p>
                                        <input type="file" class="file-input" id="modulues-pdf" name="pdf" accept="application/pdf" hidden>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="modules-png" class="form-label">PNG Image</label>
                                    <div class="upload-box drop-area">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Upload PNG file</p>
                                        <input type="file" class="file-input" id="modules-png" name="png" accept="image/png" hidden>
                                    </div>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-upload w-100">
                                <i class="fa fa-upload me-1"></i> Upload IEC Material
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions + Dashboard Stats -->
                <div class="col-md-6">
                        @include('admin.components.quick-action')          
                        @include('admin.components.stats-card')
                    
                </div>
            </div>
@push('scripts')
<!-- Drag & Drop Upload -->
<script>
    document.querySelectorAll('.drop-area').forEach(area => {
        const input = area.querySelector('.file-input');
        const text = area.querySelector('.upload-text');

        // Clicking the area triggers file dialog
        area.addEventListener('click', () => input.click());

        // File selected via dialog
        input.addEventListener('change', () => {
            if (input.files.length > 0) {
                text.textContent = input.files[0].name;
            }
        });

        // Drag over
        area.addEventListener('dragover', e => {
            e.preventDefault();
            area.classList.add('drag-over');
        });

        // Drag leave
        area.addEventListener('dragleave', () => {
            area.classList.remove('drag-over');
        });

        // Drop file
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
@endsection
