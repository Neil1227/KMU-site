        {{-- Sidebar --}}
<div class="col-md-2 sidebar sidebar-wrapper p-4 " id="sidebar" 
     style=" min-height: 100vh; color: #fff;">

        <!-- Logo -->
        <div class="mb-3 text-center d-flex flex-column align-items-center">
            <img src="../assets/img/kmlogo.png" alt="Logo" class="mobile-logo mb-2" style="height: 50px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">
            <h3 class="fw-bold text-white" style="font-size: 1.25rem; letter-spacing: 0.5px;">Admin Panel</h3>
            <small class="text-secondary d-block">Content Management</small>
        </div>

        <hr class="border-secondary w-100">

            <a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">Dashboard</a>
            
            <a href="{{ route('ictv-table') }}" 
            class="{{ Route::currentRouteName() === 'ictv-table' ? 'active' : '' }}">
            ICTV Table
            </a>

            <a href="{{ route('admin.iec-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.iec-table' ? 'active' : '' }}">
            IEC Table
            </a>

            <a href="{{ route('admin.modules-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.modules-table' ? 'active' : '' }}">
            Modules Table
            </a>

            <a href="{{ route('admin.newsletter-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.newsletter-table' ? 'active' : '' }}">
            Newsletter Table
            </a>

            <a href="{{ route('admin.promotionalactivities-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.promotionalactivities-table' ? 'active' : '' }}">
            Promotional Table
            </a>

            <a href="{{ route('admin.podcast-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.podcast-table' ? 'active' : '' }}">
            Podcast Table
            </a>

            <a href="{{ route('admin.recent-activities') }}" 
            class="{{ Route::currentRouteName() === 'admin.recent-activities' ? 'active' : '' }}">
            Recent Activities
            </a>
            
            <a href="#" 
            class="#">
            Technology Profile
            </a>
        </div>