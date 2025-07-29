        {{-- Sidebar --}}
        <div class="col-md-2 sidebar p-3">
            <h3 class="text-white">Admin Panel</h3>
            <small class="d-block mb-4">Content Management</small>
            <hr>
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

            <a href="#">Settings</a>
        </div>