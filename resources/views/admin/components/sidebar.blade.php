        {{-- Sidebar --}}
        <div class="col-md-2 sidebar p-3">
            <h3 class="text-white">Admin Panel</h3>
            <small class="d-block mb-4">Content Management</small>
            <hr>
            <a href="{{ route('admin.dashboard') }}" class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('ictv-table') }}" 
            class="{{ (Route::currentRouteName() === 'admin.ictv' || Route::currentRouteName() === 'ictv-table') ? 'active' : '' }}">
            ICTV Table
            </a>

            <a href="{{ route('admin.iec') }}" class="{{ Route::currentRouteName() === 'admin.iec' ? 'active' : '' }}">IEC Materials</a>
            <a href="{{ route('admin.modules') }}" class="{{ Route::currentRouteName() === 'admin.modules' ? 'active' : '' }}">Modules</a>
            <a href="{{ route('admin.newsletter') }}" class="{{ Route::currentRouteName() === 'admin.newsletter' ? 'active' : '' }}">Newsletters</a>
            <a href="#">Settings</a>
        </div>