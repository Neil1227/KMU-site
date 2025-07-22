@extends('layouts.admin')

@section('title', 'Upload Module Content')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card ictv-card mt-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Learning Modules</h5>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark">{{ $modules->count() }} total</span>
                <a href="{{ route('admin.modules') }}" class="btn btn-sm btn-primary" title="Add New Episode">
                    <i class="bi bi-plus-lg"></i>
                </a>
                <a href="{{ route('modules') }}" class="btn btn-sm btn-dark" target="_blank" title="View Page">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>

        <div class="card-body table-responsive-sm">
            <table id="moduleTable" class="display table table-bordered table-striped table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>PDF File</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modules as $module)
                    <tr>
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->title }}</td>
                        <td>
                            @if ($module->file)
                                <a href="{{ asset('storage/modules/' . $module->file) }}" target="_blank" class="btn btn-primary btn-sm">View PDF</a>
                            @else
                                <span class="text-muted">No PDF</span>
                            @endif
                        </td>
                        <td>
                            @if ($module->png)
                                <img src="{{ asset('storage/modules_thumbnail/' . $module->png) }}" width="80" alt="Module Image">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $module->created_at->format('Y-m-d h:i A') }}</td>
                                                    <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-success edit-module-btn">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>

                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm delete-module">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#moduleTable').DataTable({
            responsive: true,
            pageLength: 8,
            lengthChange: true,
            lengthMenu: [5, 8, 10, 15, 20],
            autoWidth: false,
            order: [[4, 'asc']]
        });
    });
</script>
@endpush
