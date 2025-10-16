@extends('layouts.admin')

@section('title', 'Upload Technology')

@section('content')

<!-- Technology Form and Quick Actions Side-by-Side -->
<div class="row g-4">
    <!-- Technology Form -->
    <div class="col-md-6">
        <div class="ictv-form mt-2">
            <div class="form-title">
                <h4 class="text-white mb-0">Technology Profile Details</h4>
            </div>

            <form action="{{ route('technology.upload') }}" method="POST" enctype="multipart/form-data" data-show-loader>
                @csrf

                <div class="mb-3 mt-3">
                    <label for="product" class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="product" name="product" required>
                </div>

                <div class="mb-3">
                    <label for="desc" class="form-label">Description *</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="net" class="form-label">Net Value </label>
                        <input type="number" class="form-control" id="net" name="net" step="0.01" >
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="profit" class="form-label">Profit Value </label>
                        <input type="number" class="form-control" id="profit" name="profit" step="0.01" >
                    </div>
                </div>

                <div class="mb-3">
                    <label for="inventors" class="form-label">Inventors (comma separated)</label>
                    <input type="text" class="form-control" id="inventors" name="inventors">
                </div>

                <div class="mb-3">
                    <label for="ip_status" class="form-label">IP Status *</label>
                    <input type="text" class="form-control" id="ip_status" name="ip_status" required>
                </div>

                <div class="mb-3">
                    <label for="proposition" class="form-label">Value Proposition (comma separated)</label>
                    <input type="text" class="form-control" id="proposition" name="proposition">
                </div>

                <div class="mb-3">
                    <label for="benefits" class="form-label">Benefits (comma separated)</label>
                    <input type="text" class="form-control" id="benefits" name="benefits">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Technology Image *</label>
                        <div class="upload-box drop-area" data-type="image">
                            <i class="fa fa-upload upload-icon"></i>
                            <p class="upload-text">Drag & drop Image or click</p>
                            <input type="file" id="image" name="image" accept="image/*" class="file-input" required hidden>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="poster" class="form-label">Technology Poster *</label>
                        <div class="upload-box drop-area" data-type="image">
                            <i class="fa fa-upload upload-icon"></i>
                            <p class="upload-text">Drag & drop Poster or click</p>
                            <input type="file" id="poster" name="poster" accept="image/*" class="file-input" required hidden>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-upload w-100">
                    <i class="fa fa-upload"></i> Upload Technology
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

@push('scripts')
<!-- Drag and Drop Image Upload -->
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

<!-- SweetAlert Flash Messages -->
@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: @json(session('success')),
            timer: 1500,
            showConfirmButton: false,
            timerProgressBar: true
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
@endpush

@endsection
