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
    {{-- General Uploads Section --}}
    <h5 class="mt-4 mb-2">General Uploads</h5>
    @if (session('admin_role') === 'KMU')
        {{-- SDG Description Editor --}}
        <a href="{{ route('admin.sdg.index') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.sdg.index' ? 'active' : 'collapsed' }}">
            <i class="bi bi-list-columns-reverse me-2"></i> SDG Descriptions
        </a>

        <a href="{{ route('admin.sdg.media') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.sdg.media' ? 'active' : 'collapsed' }}">
            <i class="bi bi-images me-2"></i> SDG Activities
        </a>
    @endif
    <a href="{{ route('admin.upload-updates') }}"
        class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.upload-updates' ? 'active' : 'collapsed' }}">
        <i class="bi bi-newspaper me-2"></i> Updates Section
    </a>


    {{-- VISITORS Section --}}
    <h5 class="mt-4 mb-2">VISITORS</h5>

    <a href="{{ route('admin.visitors') }}"
        class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.visitors' ? 'active' : 'collapsed' }}">
        <i class="bi bi-people-fill me-2"></i> Visitor Profiles
    </a>
    {{-- STUDENT RESEARCH Section --}}

    @if (session('admin_role') === 'KMU' || session('admin_role') === 'RESEARCH')
        <h5 class="mt-4 mb-2">Student Research</h5>

        <a href="{{ route('admin.thesis-papers') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.thesis-papers' ? 'active' : 'collapsed' }}">
            <i class="bi bi-journal-bookmark me-2"></i> Thesis Papers
        </a>
        {{-- @else
        <div class="accordion-button sidebar-item disabled-item" data-tooltip="Access restricted to KMU and Research">
            <i class="bi bi-journal-bookmark me-2"></i> Thesis Papers
        </div> --}}

        {{-- RESEARCH Section --}}
        <h5 class="mt-4 mb-2">Research</h5>

        <a href="{{ route('admin.add-thesis') }}"
            class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.add-thesis' ? 'active' : 'collapsed' }}">
            <i class="bi bi-search me-2"></i> Research
        </a>
    @endif
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
        @if (session('admin_role') == 'KMU')
            {{-- Active Accordion for KMU and others --}}
            <div class="accordion-item bg-transparent border-0">
                <h2 class="accordion-header" id="headingTables">
                    <button class="accordion-button sidebar-accordion-btn sidebar-item collapsed" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseTables" aria-expanded="false"
                        aria-controls="collapseTables">
                        <i class="bi bi-table me-2"></i> Tables
                    </button>
                </h2>
                <div id="collapseTables" class="accordion-collapse collapse" aria-labelledby="headingTables"
                    data-bs-parent="#sidebarAccordion">
                    <div class="accordion-body">
                        <ul class="list-unstyled ms-3">
                            <li><a href="{{ route('ictv-table') }}"
                                    class="{{ Route::currentRouteName() === 'ictv-table' ? 'active' : '' }}">
                                    <i class="bi bi-tv me-2"></i> ICTV Table</a></li>
                            <li><a href="{{ route('admin.iec-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.iec-table' ? 'active' : '' }}">
                                    <i class="bi bi-file-earmark-text me-2"></i> IEC Table</a></li>
                            <li><a href="{{ route('admin.modules-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.modules-table' ? 'active' : '' }}">
                                    <i class="bi bi-journal-text me-2"></i> Modules Table</a></li>
                            <li><a href="{{ route('admin.newsletter-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.newsletter-table' ? 'active' : '' }}">
                                    <i class="bi bi-envelope me-2"></i> Newsletter Table</a></li>
                            <li><a href="{{ route('admin.promotionalactivities-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.promotionalactivities-table' ? 'active' : '' }}">
                                    <i class="bi bi-megaphone me-2"></i> Promotional Table</a></li>
                            <li><a href="{{ route('admin.podcast-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.podcast-table' ? 'active' : '' }}">
                                    <i class="bi bi-headphones me-2"></i> Podcast Table</a></li>
                            <li><a href="{{ route('admin.technology-table') }}"
                                    class="{{ Route::currentRouteName() === 'admin.technology-table' ? 'active' : '' }}">
                                    <i class="bi bi-cpu me-2"></i> Technology Table</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.recent-activities') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.recent-activities' ? 'active' : 'collapsed' }}">
                <i class="bi bi-activity me-2"></i> Recent Activities
            </a>
        @endif

        {{-- NEW RESEARCH Section --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'RESEARCH')
            <a href="{{ route('admin.new-research') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.new-research' ? 'active' : 'collapsed' }}">
                <i class="bi bi-lightbulb me-2"></i> Acquired Research

                @if ($newResearchCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $newResearchCount }}</span>
                @endif
            </a>
        @endif

        {{-- Technology Database --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'IPTBM')
            <a href="{{ route('admin.database.commodities') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.database.commodities' ? 'active' : 'collapsed' }}">
                <i class="bi bi-database me-2"></i> Technology Database
            </a>
        @endif

        {{-- EXTENSION Section --}}

        @if (in_array(session('admin_role'), ['EXTENSION', 'KMU']))
            <h5 class="mt-4 mb-2">Extension</h5>

            <a href="{{ route('admin.extensions.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.extension' ? 'active' : 'collapsed' }}">
                <i class="bi bi-diagram-3 me-2"></i> Extension
                @if (!empty($pendingExtension) && $pendingExtension > 0)
                    <span class="badge bg-danger ms-auto">{{ $pendingExtension }}</span>
                @endif
            </a>
        @endif

        {{-- IPTBM Section --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'IPTBM')
            <h5 class="mt-4 mb-2">IPTBM</h5>

            {{-- Registered IPs --}}

            <a href="{{ route('admin.registrations.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.registrations.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-file-earmark-text me-2"></i> Registered IPs
            </a>
        @endif

        {{-- Commercialization --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'IPTBM')
            <a href="{{ route('admin.iptbm.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.iptbm.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-bell me-2"></i> Commercialization
                @if ($newApplicationsCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $newApplicationsCount }}</span>
                @endif
            </a>
        @endif

        {{-- TBI Section --}}

        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI_AgriBus')
            <h5 class="mt-4 mb-2">Agri-Business</h5>

            {{-- Agri-Business --}}
            <a href="{{ route('admin.agri-business.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.agri-business.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-graph-up me-2"></i> Agri-Business

            </a>
        @endif
        {{-- Technology Licensing Section --}}

        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI_TLU')
            <h5 class="mt-4 mb-2">Technology Licensing</h5>

            <a href="{{ route('admin.tlu.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.tlu.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-cpu-fill me-2"></i> Technology Licensing Unit

            </a>
        @endif

        {{-- TBI Section --}}

        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI')
            <h5 class="mt-4 mb-2">TBI</h5>

            <a href="{{ route('admin.promotion.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.promotion.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-building me-2"></i> Promotion and Development
            </a>
            <a href="{{ route('admin.tbi.index') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.tbi.index' ? 'active' : 'collapsed' }}">
                <i class="bi bi-building me-2"></i> TBI Records
            </a>
        @endif

        {{-- For Registration --}}
        {{-- @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI')
            <a href="{{ route('admin.notifications') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.notifications' ? 'active' : 'collapsed' }}">
                <i class="bi bi-bell me-2"></i> For Registration
                @if ($newApplicationsCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $newApplicationsCount }}</span>
                @endif
            </a>
        @endif --}}

        {{-- Registered Technology --}}
        @if (session('admin_role') === 'KMU' || session('admin_role') === 'TBI')
            <a href="{{ route('admin.registered-technology') }}"
                class="accordion-button sidebar-item {{ Route::currentRouteName() === 'admin.registered-technology' ? 'active' : 'collapsed' }}">
                <i class="bi bi-check2-circle me-2"></i> Registered Technology
                @if ($newRegisteredCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $newRegisteredCount }}</span>
                @endif
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
