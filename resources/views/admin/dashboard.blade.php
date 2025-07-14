{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app') {{-- Use your master layout --}}

@section('title', 'Admin Dashboard')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/sidebar.css') }}">
@endpush

@section('content')
<div class="container-fluid">

    <div class="row">

            <!-- Sidebar -->
            @include('admin.components.sidebar')

        {{-- Main Content --}}
        <div class="col-md-10">
            <!-- Header -->
            @include('admin.components.header')

            <div class="welcome-text mt-3">
                <h2>Dashboard</h2>
                <p>Welcome back! Here's an overview of your content.</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>ICTV Episodes</strong></div>
                            <i class="fa-solid fa-tv card-icon"></i>
                        </div>
                        <h3>1,234</h3>
                        <small>Total Content</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>IEC Materials</strong></div>
                            <i class="fa-solid fa-image  card-icon"></i>
                        </div>
                        <h3>856</h3>
                        <small>Total IEC Materials</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Modules</strong></div>
                            
                            <i class="fa-solid fa-book-open-reader card-icon"></i>
                        </div>
                        <h3>48</h3>
                        <small>Total Modules</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Newsletters</strong></div>
                            <i class="fa fa-file-alt card-icon"></i>
                        </div>
                        <h3>12.5K</h3>
                        <small>Total Newsletters</small>
                    </div>
                </div>
            </div>


            <div class="row g-4">
                <div class="col-md-6">
                    <div class="dashboard-card">
                        <h5>Recent Content</h5>
                        <ul class="list-group mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                New Product Launch <span class="status-badge status-published">Published</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Company Updates <span class="status-badge status-draft">Draft</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Marketing Campaign <span class="status-badge status-published">Published</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Blog Post Series <span class="status-badge status-review">Review</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    @include('admin.components.quick-action')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Optional: Add footer here --}}
@endsection

@push('scripts')
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endpush
