@extends('layouts.admin')

@section('title', 'Recent Activities')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Activities</h5>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $recentActivities->count() }} total</span>

                    <form id="deleteAllForm" action="{{ route('recent-activities.deleteAll') }}" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-sm btn-danger" id="deleteAllBtn">
                            Clear
                        </button>
                    </form>
                </div>
            </div>



            <div class="card-body table-responsive-sm">
                <table id="activityTable" class="display table table-bordered table-striped table-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Action</th>
                            <th>Source</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            @forelse($recentActivities as $activity)
                                <tr>
                                    <td>{{ $activity->id }}</td>
                                    <td>{{ $activity->title }}</td>
                                    <td>{{ ucfirst($activity->action) }}</td>
                                    <td>{{ $activity->source }}</td>
                                    <td>{{ $activity->created_at->format('Y-m-d h:i A') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <button type="button" class="btn btn-danger btn-sm delete-activity-btn"
                                                data-id="{{ $activity->id }}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No recent activities found.</td>
                                </tr>
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
            $('#activityTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthChange: true,
                lengthMenu: [5, 10, 20],
                autoWidth: false,
                order: [[4, 'desc']]
            });
        });
    </script>
    <!-- delete function for the recent activities -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.delete-activity-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const activityId = this.dataset.id;

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This activity will be deleted permanently.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/admin/recent-activities/${activityId}`)
                            .then(response => {
                                Swal.fire(
                                    'Deleted!',
                                    'The activity has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.reload(); // reload to reflect changes
                                });
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    });
</script>
<!-- delete all function for the recent activities -->
<script>
document.getElementById('deleteAllBtn').addEventListener('click', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will delete all recent activities.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete all',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteAllForm').submit();
        }
    });
});
</script>

@endpush
