@extends('layouts.admin')

@section('title', 'Promotional Activities')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Promotional Activities</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $promotional->count() }} total</span>
                    <a href="{{ route('promotional') }}" class="btn btn-sm btn-primary" title="Add New Activity">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="promoTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Thumbnail</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promotional as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->title }}</td>
                                <td>{{ $activity->description }}</td>
                                <td>
                                    @if ($activity->link)
                                        <a href="{{ $activity->link }}" target="_blank" class="btn btn-sm btn-primary">
                                            View Link
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($activity->thumbnail)
                                        <img src="{{ asset('storage/promotional/' . $activity->thumbnail) }}" width="60" alt="Thumbnail">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $activity->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button type="button">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#promoTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[5, 'desc']]
        });
    });
</script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            showConfirmButton: true
        });
    </script>
@endif
@endpush