@extends('layouts.database')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
@endpush

@section('content')

@include('admin.database.navbar')

<div class="container">
    <!-- Overview -->
    <div class="card commodity-overview">
        <h2>Commodities Overview</h2>
        <div class="commodity-grid" id="commodityGrid">
            @foreach($commodities as $commodity)
            <div class="commodity-card">
                <h3>{{ $commodity->commodity }}</h3>
                <p>{{ $commodity->total }} research record(s)</p>
                <a href="{{ route('admin.database.commodities.show', ['commodity' => strtolower($commodity->commodity)]) }}" class="btn btn-outline">
                    View Records
                </a>
            </div>
            @endforeach
        </div>

        <!-- Include Modal Here -->
        @include('admin.database.modal.add-modal')
    </div>
</div>

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

@endpush

@endsection
