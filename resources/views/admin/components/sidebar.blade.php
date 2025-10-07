{{-- Sidebar --}}
<div class="col-md-2 sidebar p-4 min-vh-100 text-white" id="sidebar">
    <!-- Logo Section -->
    <div class="mb-3 text-center d-flex flex-column align-items-center">
        <img src="../assets/img/kmlogo.png" alt="Logo" class="mobile-logo mb-2" style="height: 50px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">
        <h3 class="fw-bold text-white fs-5" style="letter-spacing: 0.5px;">Admin Panel</h3>
        <small class="text-secondary d-block">Content Management</small>
    </div>

    <hr class="border-secondary w-100">

    <div class="accordion" id="sidebarAccordion">

        {{-- KMU Section --}}
        <h5 class="mt-3 mb-2">KMU</h5>

        {{-- Dashboard --}}
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingDashboard">
                <a href="{{ route('admin.dashboard') }}" 
                   class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.dashboard' ? '' : 'collapsed' }}">
                    <i class="bi bi-grid me-2"></i> Dashboard
                </a>
            </h2>
        </div>

        {{-- Tables Accordion --}}
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingTables">
                <button class="accordion-button sidebar-accordion-btn sidebar-item collapsed" 
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseTables" 
                        aria-expanded="false" aria-controls="collapseTables">
                    <i class="bi bi-table me-2"></i> Tables
                </button>
            </h2>
            <div id="collapseTables" class="accordion-collapse collapse" aria-labelledby="headingTables" data-bs-parent="#sidebarAccordion">
                <div class="accordion-body p-0">
                    <ul class="list-unstyled ms-3">
                        <li><a href="{{ route('ictv-table') }}" class="{{ Route::currentRouteName() === 'ictv-table' ? 'active' : '' }}">
                            <i class="bi bi-tv me-2"></i> ICTV Table
                        </a></li>
                        <li><a href="{{ route('admin.iec-table') }}" class="{{ Route::currentRouteName() === 'admin.iec-table' ? 'active' : '' }}">
                            <i class="bi bi-file-earmark-text me-2"></i> IEC Table
                        </a></li>
                        <li><a href="{{ route('admin.modules-table') }}" class="{{ Route::currentRouteName() === 'admin.modules-table' ? 'active' : '' }}">
                            <i class="bi bi-journal-text me-2"></i> Modules Table
                        </a></li>
                        <li><a href="{{ route('admin.newsletter-table') }}" class="{{ Route::currentRouteName() === 'admin.newsletter-table' ? 'active' : '' }}">
                            <i class="bi bi-envelope me-2"></i> Newsletter Table
                        </a></li>
                        <li><a href="{{ route('admin.promotionalactivities-table') }}" class="{{ Route::currentRouteName() === 'admin.promotionalactivities-table' ? 'active' : '' }}">
                            <i class="bi bi-megaphone me-2"></i> Promotional Table
                        </a></li>
                        <li><a href="{{ route('admin.podcast-table') }}" class="{{ Route::currentRouteName() === 'admin.podcast-table' ? 'active' : '' }}">
                            <i class="bi bi-headphones me-2"></i> Podcast Table
                        </a></li>
                        <li><a href="{{ route('admin.technology-table') }}" class="{{ Route::currentRouteName() === 'admin.technology-table' ? 'active' : '' }}">
                            <i class="bi bi-cpu me-2"></i> Technology Table
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Other Links --}}
        <a href="{{ route('admin.recent-activities') }}" 
           class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.recent-activities' ? '' : 'collapsed' }}">
            <i class="bi bi-activity me-2"></i> Recent Activities
        </a>

        {{-- IPTBM Section --}}
        <h5 class="mt-4 mb-2">IPTBM</h5>
        <a href="{{ route('admin.database.commodities') }}" 
           class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.database.commodities' ? '' : 'collapsed' }}">
            <i class="bi bi-database me-2"></i>Technology Database
        </a>


{{-- TBI Section --}}
<h5 class="mt-4 mb-2">TBI</h5>

<a href="{{ route('admin.notifications') }}" 
   class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.notifications' ? '' : 'collapsed' }}">
    <i class="bi bi-bell me-2"></i> For Application
    @if($newApplicationsCount > 0)
        <span class="badge bg-danger ms-auto">{{ $newApplicationsCount }}</span>
    @endif
</a>

<a href="{{ route('admin.registered-technology') }}" 
   class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.registered-technology' ? '' : 'collapsed' }}">
    <i class="bi bi-check2-circle me-2"></i> Registered Technology
    @if($newRegisteredCount > 0)
        <span class="badge bg-danger ms-auto">{{ $newRegisteredCount }}</span>
    @endif
</a>

        
    </div>
</div>
