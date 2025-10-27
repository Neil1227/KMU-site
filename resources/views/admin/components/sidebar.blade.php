{{-- Sidebar --}}
<div class="col-md-2 sidebar p-4 min-vh-100 text-white" id="sidebar">
    <!-- Logo Section -->
    <div class="mb-3 text-center d-flex flex-column align-items-center">
        <img src="{{ asset('assets/img/kmlogo.png') }}" alt="Logo" class="mobile-logo mb-2"
            style="height: 50px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));">
        <h3 class="fw-bold text-white fs-5" style="letter-spacing: 0.5px;">Admin Panel</h3>
        <small class="text-secondary d-block">
            {{ session('admin_user') ? 'Welcome! ' . session('admin_user') : '(No admin logged in)' }}
        </small>
    </div>

    <hr class="border-secondary w-100">

    <div class="accordion" id="sidebarAccordion">

        {{-- KMU Section --}}
        <h5 class="mt-3 mb-2">KMU</h5>

        {{-- Dashboard --}}
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingDashboard">
                <a href="{{ route('admin.dashboard') }}"
                    class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : 'collapsed' }}">
                    <i class="bi bi-grid me-2"></i> Dashboard
                </a>
            </h2>
        </div>

        {{-- Tables Accordion --}}
        @if (session('admin_role') !== 'KMU')

        {{-- Disabled Accordion --}}
        <div class="accordion-item bg-transparent border-0 opacity-50" style="pointer-events: none;">
            <h2 class="accordion-header" id="headingTables">
                <button class="accordion-button sidebar-accordion-btn sidebar-item disabled"
                    type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTables" aria-expanded="false"
                    aria-controls="collapseTables">
                    <i class="bi bi-table me-2"></i> Tables
                </button>
            </h2>
        </div>

        @else
        {{-- Active Accordion for KMU and others --}}
        <div class="accordion-item bg-transparent border-0">
            <h2 class="accordion-header" id="headingTables">
                <button class="accordion-button sidebar-accordion-btn sidebar-item collapsed"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTables"
                    aria-expanded="false" aria-controls="collapseTables">
                    <i class="bi bi-table me-2"></i> Tables
                </button>
            </h2>
            <div id="collapseTables" class="accordion-collapse collapse"
                aria-labelledby="headingTables" data-bs-parent="#sidebarAccordion">
                <div class="accordion-body">
                    <ul class="list-unstyled ms-3">
                        <li><a href="{{ route('ictv-table') }}" class="{{ Route::currentRouteName() === 'ictv-table' ? 'active' : '' }}">
                                <i class="bi bi-tv me-2"></i> ICTV Table</a></li>
                        <li><a href="{{ route('admin.iec-table') }}" class="{{ Route::currentRouteName() === 'admin.iec-table' ? 'active' : '' }}">
                                <i class="bi bi-file-earmark-text me-2"></i> IEC Table</a></li>
                        <li><a href="{{ route('admin.modules-table') }}" class="{{ Route::currentRouteName() === 'admin.modules-table' ? 'active' : '' }}">
                                <i class="bi bi-journal-text me-2"></i> Modules Table</a></li>
                        <li><a href="{{ route('admin.newsletter-table') }}" class="{{ Route::currentRouteName() === 'admin.newsletter-table' ? 'active' : '' }}">
                                <i class="bi bi-envelope me-2"></i> Newsletter Table</a></li>
                        <li><a href="{{ route('admin.promotionalactivities-table') }}" class="{{ Route::currentRouteName() === 'admin.promotionalactivities-table' ? 'active' : '' }}">
                                <i class="bi bi-megaphone me-2"></i> Promotional Table</a></li>
                        <li><a href="{{ route('admin.podcast-table') }}" class="{{ Route::currentRouteName() === 'admin.podcast-table' ? 'active' : '' }}">
                                <i class="bi bi-headphones me-2"></i> Podcast Table</a></li>
                        <li><a href="{{ route('admin.technology-table') }}" class="{{ Route::currentRouteName() === 'admin.technology-table' ? 'active' : '' }}">
                                <i class="bi bi-cpu me-2"></i> Technology Table</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Recent Activities --}}
        @if (session('admin_role') !== 'KMU')

        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to KMU">
            <i class="bi bi-activity me-2"></i> Recent Activities
        </div>

        @else
        <a href="{{ route('admin.recent-activities') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.recent-activities' ? 'active' : 'collapsed' }}">
            <i class="bi bi-activity me-2"></i> Recent Activities
        </a>
        @endif

        {{-- New Research --}}
        @if (session('admin_role') !== 'KMU' && session('admin_role') !== 'RESEARCH')

        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to KMU">
            <i class="bi bi-lightbulb me-2"></i> New Research
            @if(!empty($newResearchCount) && $newResearchCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newResearchCount }}</span>
            @endif
        </div>

        @else
        <a href="{{ route('admin.new-research') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.new-research' ? 'active' : 'collapsed' }}">
            <i class="bi bi-lightbulb me-2"></i> Acquired Research
            @if(!empty($newResearchCount) && $newResearchCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newResearchCount }}</span>
            @endif
        </a>
        @endif

        {{-- IPTBM Section --}}
        <h5 class="mt-4 mb-2">IPTBM</h5>
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'IPTBM')
        <a href="{{ route('admin.database.commodities') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.database.commodities' ? 'active' : 'collapsed' }}">
            <i class="bi bi-database me-2"></i> Technology Database
        </a>
        @else
        <div class="accordion-button sidebar-item restricted" data-tooltip="Access restricted">
            <i class="bi bi-database me-2"></i> Technology Database
        </div>
        @endif

        {{-- TBI Section --}}
        <h5 class="mt-4 mb-2">TBI</h5>
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI')
        <a href="{{ route('admin.notifications') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.notifications' ? 'active' : 'collapsed' }}">
            <i class="bi bi-bell me-2"></i> For Application
            @if($newApplicationsCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newApplicationsCount }}</span>
            @endif
        </a>
        @else
        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to IPTBM and KMU">
            <i class="bi bi-bell me-2"></i> For Application
            @if($newApplicationsCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newApplicationsCount }}</span>
            @endif
        </div>
        @endif

        {{-- Registered Technology --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI')
        <a href="{{ route('admin.registered-technology') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.registered-technology' ? 'active' : 'collapsed' }}">
            <i class="bi bi-check2-circle me-2"></i> Registered Technology
            @if($newRegisteredCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newRegisteredCount }}</span>
            @endif
        </a>
        @else
        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to IPTBM and KMU">
            <i class="bi bi-check2-circle me-2"></i> Registered Technology
            @if($newRegisteredCount > 0)
            <span class="badge bg-danger ms-auto">{{ $newRegisteredCount }}</span>
            @endif
        </div>
        @endif

        {{-- RESEARCH Section --}}
        <h5 class="mt-4 mb-2">Research</h5>
        @if (session('admin_role') !== 'KMU' && session('admin_role') !== 'RESEARCH')
        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to Research and KMU">
            <i class="bi bi-search me-2"></i> Add Research
        </div>
        @else
        <a href="{{ route('admin.add-thesis') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.add-thesis' ? 'active' : 'collapsed' }}">
            <i class="bi bi-search me-2"></i> Add Research
        </a>
        @endif

        {{-- EXTENSION Section --}}
        <h5 class="mt-4 mb-2">Extension</h5>
        @if (session('admin_role') !== 'KMU' && session('admin_role') !== 'EXTENSION')
        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to Extension and KMU">
            <i class="bi bi-diagram-3 me-2"></i> Extension
        </div>
        @else
        <a href=""
            class="accordion-button sidebar-item {{ Route::currentRouteName() === '' ? 'active' : 'collapsed' }}">
            <i class="bi bi-diagram-3 me-2"></i> Extension
        </a>
        @endif

        {{-- SETTINGS Section --}}
        <h5 class="mt-4 mb-2">SETTINGS</h5>
        <a href="{{ route('admin.account-settings') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.account-settings' ? 'active' : 'collapsed' }}">
            <i class="bi bi-person-gear me-2"></i> Account Settings
        </a>

    </div>
</div>