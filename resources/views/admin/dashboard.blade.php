
@extends('layouts.admin') {{-- Use your master layout --}}

@section('title', 'Admin Dashboard')

@section('content')


        {{-- Main Content --}}
            <!-- <div class="welcome-text mt-3 mx-3">
                <h1>Dashboard</h1>
                <p>Welcome back! Here's an overview of your content.</p>
            </div> -->

            <div class="row g-4 mb-3 mt-2 mx-1">
                <div class="col-md-3 col-sm-6  ">
                    <div class="dashboard-card" style="background-color:#e1f1ff;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>ICTV Episodes</strong></div>
                            <i class="fa-solid fa-tv card-icon" style="color:#1e90ff;" ></i>
                        </div>
                        <h1>{{ $episodes->count() }}</h1>
                        <small>Total Episodes</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#ffe1e1;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>IEC Materials</strong></div>
                            <i class="fa-solid fa-image  card-icon" style="color:#dc143c;"></i>
                        </div>
                        <h1>{{ $iecMaterials->count() }}</h1>
                        <small>Total IEC Materials</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#f0f0f0;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Modules</strong></div>
                            
                            <i class="fa-solid fa-book-open-reader card-icon" style="color:696969;"></i>
                        </div>
                        <h1>{{ $modules->count() }}</h1>
                        <small>Total Modules</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#e1f9e1;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Newsletters</strong></div>
                            <i class="fa fa-file-alt card-icon" style="color:#228B22;"></i>
                        </div>
                        <h1>{{ $newsletter->count() }}</h1>
                        <small>Total Newsletters</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#fff9e1;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Promotional Activities</strong></div>
                            <i class="fa-solid fa-bullhorn card-icon" style="color:#FF8C00;"></i>
                        </div>
                        <h1>{{ $promotional->count() }}</h1>
                        <small>Total Activities</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#d5fafa;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Podcast</strong></div>
                            <i class="fa-solid fa-clapperboard card-icon" style="color:#48D1CC;"></i>
                        </div>
                        <h1>{{ $podcast->count() }}</h1>
                        <small>Total Podcast</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#E6DAFA;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Technologies</strong></div>
                            <i class="fa-solid fa-microchip card-icon" style="color:#9370DB;"></i>
                        </div>
                        <h1>{{ $technologies->count() }}</h1>
                        <small>Total Technologies</small>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 ">
                    <div class="dashboard-card" style="background-color:#FFFAFA;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Visitors</strong></div>
                            <i class="fa fa-eye" style="color:#2F4F4F;"></i>
                        </div>
                        <h1>{{ number_format($totalPageViews) }}</h1>
                        <small>Total Visitors</small>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="dashboard-card">
                        <h5>Recent Content</h5>
                        <ul class="list-group mt-3">
                            @forelse ($recentActivities as $activity)
                                <li class="list-group-item d-flex justify-content-between align-items-start flex-column">
                                    <div class="w-100 d-flex justify-content-between align-items-center mt-2">
                                        <strong>{{ $activity->title }}</strong>
                                            <span class="status-badge 
                                                {{ $activity->action === 'added' ? 'status-published' : 
                                                ($activity->action === 'updated' ? 'status-draft' : 
                                                ($activity->action === 'deleted' ? 'status-review' : '')) }}">
                                                {{ ucfirst($activity->action) }}
                                            </span>
                                    </div>
                                    <small class="text-muted">Source: {{ $activity->source }}</small>
                                </li>
                            @empty
                                <li class="list-group-item">No recent activities yet.</li>
                            @endforelse
                        </ul>
                        <!-- "See All" Link -->
                        <div class="text-end mt-2">
                            <a href="{{ route('admin.recent-activities') }}" class="btn btn-sm btn-outline-dark">See All Activities</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    @include('admin.components.quick-action')
                    </div>
                </div>
            </div>


@endsection
@push('scripts')
<!-- prevent redirecting from previous button  -->
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    window.addEventListener("pageshow", function(event) {
        if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
            window.location.reload();
        }
    });
</script>

@endpush
