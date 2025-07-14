
@extends('layouts.app')

@section('title', 'Upload ICTV Content')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-content.css') }}">
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

                        <form action="#" method="POST" enctype="multipart/form-data">
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
                                <input type="url" class="form-control" id="link" name="link">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="webp" class="form-label">WEBP Image</label>
                                    <div class="upload-box">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p>Upload WEBP file</p>
                                        <input type="file" id="webp" name="webp" accept="image/webp" hidden onchange="this.previousElementSibling.previousElementSibling.innerHTML = this.files[0].name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="png" class="form-label">PNG Image</label>
                                    <div class="upload-box">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p>Upload PNG file</p>
                                        <input type="file" id="png" name="png" accept="image/png" hidden onchange="this.previousElementSibling.previousElementSibling.innerHTML = this.files[0].name">
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
@endsection
