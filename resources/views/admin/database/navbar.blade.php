<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<!-- Navbar -->
@if(session('admin_logged_in') && !request()->routeIs('admin.database.commodities'))
<nav class="dashboard-navbar">
    <div class="navbar-left">
        <div class="d-flex align-items-center mb-3">
            <!-- Logo -->
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 50px; margin-right: 10px;">
            <!-- Heading -->
            <h2 class="m-0">Technology Database Management</h2>
        </div>

    </div>

    <div class="navbar-right">
        <a href="{{ route('admin.database.commodities') }}" class="btn-back">
            <span class="btn-back-icon">←</span> Dashboard
        </a>
    </div>
    @endif


</nav>
@if(session('admin_logged_in'))
<div class="nav-container">

    <div class="tabs">

        <a href="{{ route('admin.database.commodities') }}" class="tab {{ request()->routeIs('admin.database.commodities') ? 'active' : '' }}">
            <i data-lucide="bar-chart-3"></i>
            <span>Commodities</span>
        </a>

        <a href="{{ route('admin.database.records') }}" class="tab {{ request()->routeIs('admin.database.records') ? 'active' : '' }}">
            <i data-lucide="file-text"></i>
            <span>Technologies</span>
        </a>

        <a href="{{ route('admin.database.view-ip-applied') }}" class="tab {{ request()->routeIs('admin.database.view-ip-applied') ? 'active' : '' }}">
            <i data-lucide="file-check"></i>
            <span>IP Applied</span>
        </a>

        <a href="{{ route('admin.database.view-regtech') }}" class="tab {{ request()->routeIs('admin.database.view-regtech') ? 'active' : '' }}">
            <i data-lucide="user-check"></i>
            <span>IP Registered</span>
        </a>
        <a href="{{ route('admin.database.graphs') }}" class="tab {{ request()->routeIs('admin.database.graphs') ? 'active' : '' }}">
            <i data-lucide="bar-chart-3"></i>
            <span>Graphs</span>
        </a>
        <a href="{{ route('admin.database.activity') }}" class="tab {{ request()->routeIs('admin.database.activity') ? 'active' : '' }}">
            <i data-lucide="activity"></i>
            <span>Activity Logs</span>
        </a>
        @if(request()->routeIs('admin.database.commodities'))
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addCommodityModal">
            <span class="btn-add-icon mx-auto">Add Commodity</span>
        </button>

        @include('admin.database.modal.add-modal')
        @else
        <!-- Fallback disabled button -->
        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addCommodityModal">
            <span class="btn-add-icon mx-auto">Add Commodity</span>
        </button>
        @endif


    </div>

</div>
@endif

<!-- sweet alert for success on adding new commodity -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('commodityForm');
        const saveBtn = document.getElementById('saveCommodityBtn');

        // Only attach event if both exist
        if (!form || !saveBtn) return;

        saveBtn.addEventListener('click', async (e) => {
            e.preventDefault(); // prevent default form submission
            const formData = new FormData(form);
            const url = "{{ route('commodities.store') }}";

            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await res.json();

                if (data.success) {
                    // Close modal
                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addCommodityModal'));
                    modal.hide();

                    // Reset form
                    form.reset();

                    // SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        timer: 2500,
                        showConfirmButton: false
                    });

                    // Append new commodity card dynamically if grid exists
                    const grid = document.getElementById('commodityGrid');
                    if (grid) {
                        const div = document.createElement('div');
                        div.classList.add('commodity-card');
                        div.innerHTML = `
                        <h3>${data.data.commodity}</h3>
                        <p>1 research record(s)</p>
                        <a href="/admin/database/commodities/${data.data.commodity.toLowerCase()}" class="btn btn-outline mt-2">View Records</a>
                    `;
                        grid.appendChild(div);
                    }
                }
            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });
    });
</script>