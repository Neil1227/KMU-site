<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<!-- Navbar -->
<nav class="dashboard-navbar">
    <div class="navbar-left">
        <div class="d-flex align-items-center mb-3">
    <!-- Logo -->
    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="height: 50px; margin-right: 10px;">
        <!-- Heading -->
        <h2 class="m-0">Database Management</h2>
    </div>

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
<!-- sweet alert for success on adding new commodity -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('commodityForm');
    if(!form) return;

    const saveBtn = document.getElementById('saveCommodityBtn');
    saveBtn.addEventListener('click', async () => {
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

            if(data.success){
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

                // Append new commodity card dynamically
                const grid = document.getElementById('commodityGrid');
                const div = document.createElement('div');
                div.classList.add('commodity-card');
                div.innerHTML = `
                    <h3>${data.data.commodity}</h3>
                    <p>1 research record(s)</p>
                    <a href="/admin/database/commodities/${data.data.commodity.toLowerCase()}" class="btn btn-outline mt-2">View Records</a>
                `;
                grid.appendChild(div);
            }
        } catch(err){
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