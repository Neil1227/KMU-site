@extends('layouts.admin')

@section('title', 'Podcasts')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
    <div class="container mt-4">
        <div class="card ictv-card mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Podcasts</h5>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-light text-dark">{{ $podcasts->count() }} total</span>
                    <a href="{{ route('admin.podcast') }}" class="btn btn-sm btn-primary" title="Add New Podcast">
                        <i class="bi bi-plus-lg"></i>
                    </a>
                    <a href="#" class="btn btn-sm btn-dark" target="_blank">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="podcastTable" class="display table table-bordered table-striped table-sm">
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
                        @forelse ($podcasts as $podcast)
                            <tr>
                                <td>{{ $podcast->id }}</td>
                                <td>{{ $podcast->title }}</td>
                                <td>{{ $podcast->description }}</td>
                                <td>
                                    @if ($podcast->link)
                                        <a href="{{ $podcast->link }}" target="_blank" class="btn btn-sm btn-primary">
                                            View Link
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if ($podcast->png)
                                        <img src="{{ asset('storage/podcast/' . $podcast->png) }}" width="60" alt="Thumbnail">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ $podcast->created_at->format('Y-m-d h:i A') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm">
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
        $('#podcastTable').DataTable({
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
