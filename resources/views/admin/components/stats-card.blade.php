<!-- Dashboard Stats Cards (2x2 layout) -->
<div class="row g-3 mt-4">
    <h5>Tables</h5>
<!-- ------------------------------------------------------route for the other card for accessing the table -->
    <div class="col-md-4">
        <a href="{{ route('ictv-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.ictv' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $episodes->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div><strong>ICTV Episodes</strong></div>
                    <!-- <i class="fa-solid fa-tv card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.iec-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.iec' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $iecMaterials->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div><strong>IEC Materials</strong></div>
                    <!-- <i class="fa-solid fa-image card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.modules-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.modules' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $modules->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div><strong>Modules</strong></div>
                    <!-- <i class="fa-solid fa-book-open-reader card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{ route('admin.newsletter-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.newsletter' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $newsletter->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div><strong>Newsletters</strong></div>
                    <!-- <i class="fa fa-file-alt card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>
        <div class="col-md-4">
        <a href="{{ route('admin.newsletter-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.newsletter' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $newsletter->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div ><strong>Promotional</strong></div>
                    <!-- <i class="fa fa-file-alt card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>
        <div class="col-md-4">
        <a href="{{ route('admin.newsletter-table') }}" class="text-decoration-none text-dark">
            <div class="dashboard-card {{ Route::currentRouteName() === 'admin.newsletter' ? 'active' : '' }}">
                
                <h3 class="d-flex justify-content-center align-items-center">{{ $newsletter->count() }}</h3>
                <div class="d-flex justify-content-center align-items-center">
                    <div><strong>Podcast</strong></div>
                    <!-- <i class="fa fa-file-alt card-icon"></i> -->
                </div>
            </div>
        </a>
    </div>
</div>
