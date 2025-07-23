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

                        <form action="#" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 mt-3">
                                <label for="title" class="form-label">Title *</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="newsletter-pdf" class="form-label">Upload PDF</label>
                                    <div class="upload-box">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p>Upload PDF file</p>
                                        <input type="file" id="newsletter-pdf" name="newsletter-pdf" accept="image/pdf" hidden onchange="this.previousElementSibling.previousElementSibling.innerHTML = this.files[0].name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="newsletter-png" class="form-label">PNG Image</label>
                                    <div class="upload-box">
                                        <i class="fa fa-upload upload-icon"></i>
                                        <p>Upload PNG file</p>
                                        <input type="file" id="newsletter-png" name="newsletter-png" accept="image/png" hidden onchange="this.previousElementSibling.previousElementSibling.innerHTML = this.files[0].name">
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
