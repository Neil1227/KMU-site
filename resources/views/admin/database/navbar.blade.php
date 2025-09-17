<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<!-- Navbar -->
<nav class="dashboard-navbar">
    <div class="navbar-left">
        <h2>Database Management</h2>
    </div>
    <div class="navbar-right">
        <a href="{{ route('admin.dashboard') }}" class="btn-back">
            <span class="btn-back-icon">←</span> Dashboard
        </a>
       <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addCommodityModal">
            <span class="btn-add-icon">+</span> Add Commodity
        </button>
    </div>
</nav>
