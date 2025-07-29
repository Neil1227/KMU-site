
@extends('layouts.admin') {{-- Use your master layout --}}

@section('title', 'Admin Dashboard')

@section('content')

        {{-- Main Content --}}
            <!-- <div class="welcome-text mt-3 mx-3">
                <h2>Dashboard</h2>
                <p>Welcome back! Here's an overview of your content.</p>
            </div> -->

            <div class="row g-4 mb-3 mt-2 mx-3">
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>ICTV Episodes</strong></div>
                            <i class="fa-solid fa-tv card-icon"></i>
                        </div>
                        <h3>{{ $episodes->count() }}</h3>
                        <small>Total Content</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>IEC Materials</strong></div>
                            <i class="fa-solid fa-image  card-icon"></i>
                        </div>
                        <h3>{{ $iecMaterials->count() }}</h3>
                        <small>Total IEC Materials</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Modules</strong></div>
                            
                            <i class="fa-solid fa-book-open-reader card-icon"></i>
                        </div>
                        <h3>{{ $modules->count() }}</h3>
                        <small>Total Modules</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Newsletters</strong></div>
                            <i class="fa fa-file-alt card-icon"></i>
                        </div>
                        <h3>{{ $newsletter->count() }}</h3>
                        <small>Total Newsletters</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Promotional Activities</strong></div>
                            <i class="fa-solid fa-bullhorn card-icon"></i>
                        </div>
                        <h3>#</h3>
                        <small>Total Activities</small>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><strong>Podcast</strong></div>
                            <i class="fa-solid fa-clapperboard card-icon"></i>
                        </div>
                        <h3>#</h3>
                        <small>Total Podcast</small>
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
