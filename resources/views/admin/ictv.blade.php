
@extends('layouts.app')

@section('title', 'Upload ICTV Content')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-content.css') }}">
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.components.sidebar')

        <!-- Main Content -->
        <div class="col-md-10">
            @include('admin.components.header')

            <!-- ICTV Form and Quick Actions Side-by-Side -->
            <div class="row g-4">
                <!-- Content Details Form -->
                <div class="col-md-6">
                    <div class="ictv-form mt-2">
                        <div class="form-title">
                            <h4 class="text-white mb-0">ICTV Episode Details</h4>
                        </div>

                        <form action="{{ route('ictv.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="link" class="form-label">Link URL</label>
                                <input type="url" class="form-control" id="link" name="link" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="webp" class="form-label">WEBP Image</label>
                                    <div class="upload-box drop-area" data-type="webp" >
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Drag & drop WEBP or click</p>
                                        <input type="file" id="webp" name="webp" accept="image/webp" class="file-input" required hidden>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="png" class="form-label">PNG Image</label>
                                    <div class="upload-box drop-area" data-type="png" >
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p class="upload-text">Drag & drop PNG or click</p>
                                        <input type="file" id="png" name="png" accept="image/png" class="file-input" required hidden>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-upload w-100">
                                <i class="fa fa-upload"></i> Upload Content
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Quick Actions and Dashboard Cards -->
                <div class="col-md-6">
                    @include('admin.components.quick-action')

                    @include('admin.components.stats-card')
                </div>
            </div>
            <!-- End Form and Actions -->
        </div>
    </div>
</div>
@push('scripts')
<!-- drag and drop img -->
<script>
document.querySelectorAll('.drop-area').forEach(area => {
    const input = area.querySelector('.file-input');
    const text = area.querySelector('.upload-text');

    // Click triggers file input
    area.addEventListener('click', () => input.click());

    // Handle file select
    input.addEventListener('change', () => {
        if (input.files.length > 0) {
            text.textContent = input.files[0].name;
        }
    });

    // Drag over effect
    area.addEventListener('dragover', e => {
        e.preventDefault();
        area.classList.add('drag-over');
    });

    area.addEventListener('dragleave', () => {
        area.classList.remove('drag-over');
    });

    // Drop file
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
<!-- SweetAlert Flash Message -->
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: @json(session('success')),
        confirmButtonColor: '#f85e0a',
        confirmButtonText: 'OK'
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: @json(session('error')),
        confirmButtonColor: '#d33',
        confirmButtonText: 'OK'
    });
</script>
@endif
<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#ictvTable').DataTable({
            responsive: true
        });
    });
</script>

@endpush
@endsection
