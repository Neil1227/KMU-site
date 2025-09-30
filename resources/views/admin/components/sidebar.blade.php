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

         <a href="{{ route('admin.dashboard') }}" 
            class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
            <i class="bi bi-grid me-2"></i> Dashboard
         </a>

         <a href="{{ route('ictv-table') }}" 
            class="{{ Route::currentRouteName() === 'ictv-table' ? 'active' : '' }}">
            <i class="bi bi-tv me-2"></i> ICTV Table
         </a>

         <a href="{{ route('admin.iec-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.iec-table' ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text me-2"></i> IEC Table
         </a>

         <a href="{{ route('admin.modules-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.modules-table' ? 'active' : '' }}">
            <i class="bi bi-journal-text me-2"></i> Modules Table
         </a>

         <a href="{{ route('admin.newsletter-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.newsletter-table' ? 'active' : '' }}">
            <i class="bi bi-envelope me-2"></i> Newsletter Table
         </a>

         <a href="{{ route('admin.promotionalactivities-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.promotionalactivities-table' ? 'active' : '' }}">
            <i class="bi bi-megaphone me-2"></i> Promotional Table
         </a>

         <a href="{{ route('admin.podcast-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.podcast-table' ? 'active' : '' }}">
            <i class="bi bi-headphones me-2"></i> Podcast Table
         </a>

         <a href="{{ route('admin.technology-table') }}" 
            class="{{ Route::currentRouteName() === 'admin.technology-table' ? 'active' : '' }}">
            <i class="bi bi-cpu me-2"></i> Technology Table
         </a>

         <a href="{{ route('admin.recent-activities') }}" 
            class="{{ Route::currentRouteName() === 'admin.recent-activities' ? 'active' : '' }}">
            <i class="bi bi-activity me-2"></i> Recent Activities
         </a>
<a href="{{ route('admin.notifications') }}" 
   class="{{ Route::currentRouteName() === 'admin.notifications' ? 'active' : '' }}">
   <i class="bi bi-bell me-2"></i> Notifications
</a>



         <a href="{{ route('admin.database.commodities') }}" 
            class="{{ Route::currentRouteName() === 'admin.database.commodities' ? 'active' : '' }}">
            <i class="bi bi-database me-2"></i> Manage Database
         </a>

            
        </div>