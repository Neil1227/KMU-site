
@extends('layouts.admin') {{-- Use your master layout --}}

@section('title', 'Admin Dashboard')

@section('content')

        {{-- Main Content --}}
            <div class="welcome-text mt-3 mx-3">
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
                        <h3>{{ $episodes->count() }}</h3>
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


@endsection

