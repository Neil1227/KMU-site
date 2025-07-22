<!-- Dashboard Stats Cards (2x2 layout) -->
<div class="row g-3 mt-4">
    <h5>Tables</h5>
<!-- ------------------------------------------------------route for the other card for accessing the table -->
    <div class="col-md-6">
        <a href="{{ route('ictv-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.ictv' ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div><strong>ICTV Episodes</strong></div>
                    <i class="fa-solid fa-tv card-icon"></i>
                </div>
                <h3>{{ $episodes->count() }}</h3>
                <small>Total Content</small>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('admin.iec-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.iec' ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div><strong>IEC Materials</strong></div>
                    <i class="fa-solid fa-image card-icon"></i>
                </div>
                <h3>{{ $iecMaterials->count() }}</h3>
                <small>Total IEC Materials</small>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="{{ route('admin.modules-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.modules' ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div><strong>Modules</strong></div>
                    <i class="fa-solid fa-book-open-reader card-icon"></i>
                </div>
                <h3>{{ $modules->count() }}</h3>
                <small>Total Modules</small>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="#" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.newsletter' ? 'active' : '' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div><strong>Newsletters</strong></div>
                    <i class="fa fa-file-alt card-icon"></i>
                </div>
                <h3>12.5K</h3>
                <small>Total Newsletters</small>
            </div>
        </a>
    </div>
</div>
