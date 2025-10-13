@extends('layouts.database')

@section('title', 'Activity Log')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/dark/1.13.6/css/dataTables.dark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
@endpush

@section('content')
@include('admin.database.navbar') {{-- Include your navbar --}}
<div class="container">


    <div class="header pt-5 mb-3 d-flex align-items-center position-relative">
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back position-absolute start-0">← Back</a>
        <h1 class="mx-auto text-center">Activity Log</h1>
        <div class="mb-3 text-end">
            <button id="clearAllActivities" class="btn btn-danger">Clear All</button>
        </div>
    </div>



    <div class="table-wrapper m-3">
        <table id="activitiesTable" class="table table-striped table-hover table-bordered" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Action</th>
                    <th>Thesis Title</th>
                    <th>Technology</th>
                    <th>IP Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $sortedActivities = $activities->sortByDesc(function($activity) {
                return $activity->updated_at ?? $activity->created_at;
                });
                @endphp

                @forelse ($sortedActivities as $activity)
                <tr id="activity-{{ $activity->id }}">
                    <td>
                        <span class="badge 
                            @if($activity->action === 'created') bg-success
                            @elseif($activity->action === 'updated') bg-primary
                            @elseif($activity->action === 'deleted') bg-danger
                            @elseif($activity->action === 'pushed') bg-warning text-dark
                            @elseif($activity->action === 'reverted') bg-secondary
                            @else bg-dark
                            @endif">
                            {{ ucfirst($activity->action) }}
                        </span>

                    </td>
                    <td>{{ $activity->thesis_title }}</td>
                    <td>{{ $activity->technology }}</td>
                    <td>{{ $activity->ip_status }}</td>
                    <td>{{ $activity->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        @php
                        $changes = json_decode($activity->changes, true);
                        $isReverted = $activities->contains(function ($act) use ($changes) {
                        $actChanges = json_decode($act->changes, true);
                        return $act->action === 'reverted'
                        && isset($actChanges['notification_id'], $changes['notification_id'])
                        && $actChanges['notification_id'] == $changes['notification_id'];
                        });
                        @endphp

                        @if($activity->action === 'pushed' && isset($changes['notification_id']) && !$isReverted)
                        <button class="btn btn-sm btn-warning revert-push"
                            data-id="{{ $changes['notification_id'] }}"
                            title="Revert Push">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </button>
                        @endif



                        <button class="btn btn-sm btn-danger delete-activity" data-id="{{ $activity->id }}" title="Delete Activity">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No activities found.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        var table = $('#activitiesTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            responsive: true,
            autoWidth: false,
            order: [
                [4, 'desc']
            ], // Sort by Date column ascending
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search activities..."
            }
        });


        // Row-level delete
        $('.delete-activity').click(function() {
            let id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the activity permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('activities') }}/" + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                table.row($('#activity-' + id)).remove().draw();
                                Swal.fire('Deleted!', res.message, 'success');
                            }
                        }
                    });
                }
            });
        });

        // Clear all activities
        $('#clearAllActivities').click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete ALL activities permanently.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, clear all!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('activities.clearAll') }}",
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                table.clear().draw();
                                Swal.fire('Cleared!', res.message, 'success');
                            }
                        }
                    });
                }
            });
        });
        // Revert pushed notification
        $(document).on('click', '.revert-push', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Revert this push?',
                text: "This will remove the notification record.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, revert it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/notifications/revert/' + id,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Reverted!', res.message, 'success');
                                // Remove the corresponding row from the DataTable
                                $('#activitiesTable').DataTable().row($(`button[data-id="${id}"]`).parents('tr')).remove().draw();
                            } else {
                                Swal.fire('Error', res.message || 'Something went wrong.', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error('Revert error:', xhr.responseText);
                            Swal.fire('Error', 'Something went wrong while reverting.', 'error');
                        }
                    });
                }
            });
        });


    });
</script>
@endpush