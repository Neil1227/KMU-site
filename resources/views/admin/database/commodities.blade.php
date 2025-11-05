@extends('layouts.admin')

@section('title', 'Database Management')

@push('css')
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
@endpush

@section('content')
@include('admin.database.navbar')

<div class="container">
    <!-- Overview -->
    <h2 class="mt-4 d-flex justify-content-center">Technology Overview</h2>

    <div class="commodity-overview">
        <div class="commodity-grid">

            @php
            // Sort priority areas: normal first, N/A second to last, For Checking (empty) last
            $priorityAreas = $priorityAreas->sortBy(function ($area) {
            $name = strtolower(trim($area->priority_area ?? ''));

            if ($name === 'n/a') {
            return 2; // second to last
            }

            if ($name === '' || $name === null) {
            return 3; // last (For Checking)
            }

            return 1; // normal first
            });
            @endphp

            @foreach($priorityAreas as $area)
            @php
            $areaName = trim($area->priority_area);
            $isEmpty = empty($areaName);
            $isKMU = session('admin_role') === 'KMU';
            @endphp

            <div class="commodity-card">
                <h3>{{ $isEmpty ? 'For Checking' : $areaName }}</h3>
                <p>{{ $area->total }} research record(s)</p>

                @if(!$isEmpty)
                <a href="{{ route('admin.database.priority.show', [
                        'priority_area' => strtolower($areaName) === 'n/a' ? 'n-a' : strtolower($areaName)
                    ]) }}" class="btn btn-outline">
                    View Records
                </a>
                @else
                @if($isKMU)
                <a href="{{ route('admin.database.priority.show', ['priority_area' => 'for-checking']) }}"
                    class="btn btn-outline">View Records</a>
                @else
                <span class="btn btn-outline disabled" style="opacity: 0.6; cursor: not-allowed;">View Records</span>
                @endif
                @endif
            </div>
            @endforeach
        </div>

    </div>

    <!-- Include Add Modal -->
    @include('admin.database.modal.add-modal')
</div>
@endsection

@push('script')
<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush