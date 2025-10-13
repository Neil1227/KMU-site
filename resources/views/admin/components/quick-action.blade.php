<div class="dashboard-card-quick mt-2">
    <h5>Upload Content</h5>
    <div class="mt-3">
        <div class="row g-3">

            {{-- Show upload buttons only if KMU --}}
            @if (session('admin_role') === 'KMU')
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.ictv') }}"
                       class="btn w-100 d-flex justify-content-between align-items-center {{ Route::currentRouteName() === 'admin.ictv' ? 'btn-primary text-white' : 'btn-outline-primary' }}">
                        ICTV <i class="fa-solid fa-tv me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.iec') }}"
                       class="btn w-100 d-flex justify-content-between align-items-center {{ Route::currentRouteName() === 'admin.iec' ? 'btn-danger text-white' : 'btn-outline-danger' }}">
                        IEC Materials <i class="fa-solid fa-image me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.modules') }}"
                       class="btn w-100 d-flex justify-content-between align-items-center {{ Route::currentRouteName() === 'admin.modules' ? 'btn-secondary text-white' : 'btn-outline-secondary' }}">
                        Modules <i class="fa fa-file-alt me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.newsletter') }}"
                       class="btn w-100 d-flex justify-content-between align-items-center {{ Route::currentRouteName() === 'admin.newsletter' ? 'btn-success text-white' : 'btn-outline-success' }}">
                        Newsletters <i class="fa-solid fa-book-open-reader me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.promotional') }}"
                       class="btn btn-outline-warning w-100 d-flex justify-content-between align-items-center">
                        Prom. Activities <i class="fa fa-table me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.podcast') }}"
                       class="btn btn-outline-info w-100 d-flex justify-content-between align-items-center">
                        Podcast <i class="fa-solid fa-clapperboard me-1"></i>
                    </a>
                </div>
                <div class="col-md-4 d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.technology') }}"
                       class="btn w-100 d-flex justify-content-between align-items-center {{ Route::currentRouteName() === 'admin.technology' ? 'btn-primary text-white' : 'btn-outline-lavender' }}">
                        Add Technology <i class="fa-solid fa-microchip me-1"></i>
                    </a>
                </div>
            @endif

            {{-- "View Site" is visible to everyone --}}
            <div class="col-md-8 d-flex justify-content-between align-items-center">
                <a href="{{ route('index') }}" class="btn btn-outline-dark w-100 d-flex justify-content-between align-items-center" target="_blank">
                    View Site <i class="fa fa-eye me-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
