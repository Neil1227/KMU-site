@extends('layouts.admin')

@section('title', 'SDG Editor')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/ictv-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/custom-table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <style>
        .description-cell .desc-full {
            max-height: 200px;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 8px;
            border-radius: 4px;
        }

        .description-cell .desc-toggle {
            font-size: 12px;
        }
    </style>
@endpush


@section('content')
    <div class="container mt-4">

        <div class="card shadow-sm mt-4">
            <div class="card-header text-white d-flex justify-content-between align-items-center">
                <h5>SDG Descriptions</h5>
            </div>

            <div class="card-body table-responsive-sm">
                <table id="sdgTable" class="table table-bordered table-striped table-sm align-middle nowrap">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">SDG #</th>
                            <th width="80">Title</th>
                            <th>Description</th>
                            <th width="80">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($sdgs as $sdg)
                            <tr>
                                <td>{{ $sdg->sdg_number }}</td>
                                <td>{{ $sdg->title }}</td>

                                <td class="description-cell">
                                    <div class="desc-short">
                                        {{ Str::limit($sdg->description, 120) }}

                                        @if (strlen($sdg->description) > 120)
                                            <button class="btn btn-link p-0 desc-toggle">
                                                Show More
                                            </button>
                                        @endif
                                    </div>

                                    <div class="desc-full d-none">
                                        {{ $sdg->description }}

                                        <button class="btn btn-link p-0 desc-toggle">
                                            Show Less
                                        </button>
                                    </div>
                                </td>

                                <td>
                                    <button class="btn btn-primary btn-sm editBtn" data-id="{{ $sdg->id }}"
                                        data-description="{{ $sdg->description }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>


    {{-- =============================
        EDIT MODAL
================================ --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form id="editForm">
                @csrf
                @method('PUT')

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit SDG Description</h5>
                    </div>

                    <div class="modal-body">
                        <textarea id="editDescription" name="description" class="form-control" rows="10"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection



@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===================================
            // DataTable Initialization
            // ===================================
            $('#sdgTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search SDG descriptions...",
                },
                columnDefs: [{
                    orderable: false,
                    targets: [3]
                }]
            });


            // ===================================
            // Edit Button Handler
            // ===================================
            let editId = null;

            $('#sdgTable').on('click', '.editBtn', function() {
                editId = $(this).data('id');
                $('#editDescription').val($(this).data('description'));

                new bootstrap.Modal('#editModal').show();
            });


            // ===================================
            // Save Button Handler (PUT Request)
            // ===================================
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                fetch(`/admin/sdg/${editId}`, {
                        method: 'PUT',
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name=_token]').value,
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            description: $('#editDescription').val()
                        })
                    })
                    .then(res => res.json())
                    .then(() => {
                        Swal.fire({
                            icon: "success",
                            title: "Updated",
                            text: "Description updated successfully!",
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    });
            });



            // ===================================
            // Description Show/Hide Toggle
            // ===================================
            $('#sdgTable').on('click', '.desc-toggle', function() {
                const cell = this.closest('.description-cell');

                cell.querySelector('.desc-short').classList.toggle('d-none');
                cell.querySelector('.desc-full').classList.toggle('d-none');
            });

        });
    </script>
@endpush
