@extends('layouts.database')

@section('title', $commodity . ' - Research Records')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/dark/1.13.6/css/dataTables.dark.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
@endpush

@section('content')
<div class="container">
    @include('admin.database.navbar')

    <div class="header pt-5">
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back">← Back</a>
        <h1>{{ strtoupper($commodity) }} - RESEARCH RECORDS</h1>
        <button class="btn btn-add">Add Record</button>
    </div>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Thesis Title</th>
                    <th>Technologies</th>
                    <th>Technology Generator</th>
                    <th>Contact Info</th>
                    <th>Type of Technology</th>
                    <th>IP Status</th>
                    <th>TRL Level</th>
                    <th>SDGs</th>
                    <th>Remarks</th>
                    <th>Recommendations</th>
                    <th>Link</th>
                    <th>Priority Area</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr data-id="{{ $record->id }}">
                    <td>{{ $record->thesis_title }}</td>
                    <td>{{ $record->technologies }}</td>
                    <td>{!! $record->technology_generator !!}</td>
                    <td>{{ $record->contact_info }}</td>
                    <td>{{ $record->type_of_technology }}</td>
                    <td>{{ $record->ip_status }}</td>
                    <td>{{ $record->trl_level }}</td>
                    <td>{{ $record->sdgs }}</td>
                    <td>{{ $record->remarks }}</td>
                    <td>{{ $record->recommendations }}</td>
                    <td>
                        <a href="{{ $record->link }}" target="_blank">
                            {{ $record->link }}
                        </a>
                    </td>


                    <td>{{ $record->priority_area }}</td>
                    <td class="actions">
                    <button 
                        class="edit btn btn-warning btn-sm"
                        data-bs-toggle="modal" 
                        data-bs-target="#editCommodityModal"
                        data-id="{{ $record->id }}"
                        data-commodity="{{ $record->commodity }}"
                        data-technology_generator="{{ $record->technology_generator }}"
                        data-thesis_title="{{ $record->thesis_title }}"
                        data-technologies="{{ $record->technologies }}"
                        data-contact_info="{{ $record->contact_info }}"
                        data-type_of_technology="{{ $record->type_of_technology }}"
                        data-ip_status="{{ $record->ip_status }}"
                        data-trl_level="{{ $record->trl_level }}"
                        data-sdgs="{{ $record->sdgs }}"
                        data-remarks="{{ $record->remarks }}"
                        data-recommendations="{{ $record->recommendations }}"
                        data-link="{{ $record->link }}"
                        data-priority_area="{{ $record->priority_area }}"
                    >
                        <i class="bi bi-pencil-fill"></i>
                    </button>


                        <button class="save btn btn-success btn-sm" style="display:none;">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <button class="push btn btn-primary btn-sm">
                            <i class="bi bi-check2-circle"></i>
                        </button>
                        <button 
                            class="delete btn btn-danger btn-sm"
                            data-id="{{ $record->id }}"
                        >
                            <i class="bi bi-trash-fill"></i>
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @include('admin.database.modal.edit-modal')
    </div>
</div>
@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/dark/1.13.6/js/dataTables.dark.min.js"></script>

<!-- trigger and populate the edit modal -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const editButtons = document.querySelectorAll(".edit");

        editButtons.forEach(button => {
            button.addEventListener("click", function () {
                // Fill modal fields from data attributes
                document.getElementById("edit_id").value = this.dataset.id;
                document.getElementById("edit_commodity").value = this.dataset.commodity;
                document.getElementById("edit_technology_generator").value = this.dataset.technology_generator;
                document.getElementById("edit_thesis_title").value = this.dataset.thesis_title;
                document.getElementById("edit_technologies").value = this.dataset.technologies;
                document.getElementById("edit_contact_info").value = this.dataset.contact_info;
                document.getElementById("edit_type_of_technology").value = this.dataset.type_of_technology;
                document.getElementById("edit_ip_status").value = this.dataset.ip_status;
                document.getElementById("edit_trl_level").value = this.dataset.trl_level;
                document.getElementById("edit_sdgs").value = this.dataset.sdgs;
                document.getElementById("edit_remarks").value = this.dataset.remarks;
                document.getElementById("edit_recommendations").value = this.dataset.recommendations;
                document.getElementById("edit_link").value = this.dataset.link;
                document.getElementById("edit_priority_area").value = this.dataset.priority_area;

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById("editCommodityModal"));
                modal.show();
            });
        });
    });
</script>

<!-- update the record -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
    // When you click an "edit" button, open the modal and load data
    document.querySelectorAll(".edit").forEach(button => {
        button.addEventListener("click", function () {
            const row = this.closest("tr");

            // Fill modal with row data (adjust selectors to match your <td> order)
            document.getElementById("edit_id").value = row.dataset.id;
            document.getElementById("edit_commodity").value = row.querySelector("td:nth-child(1)").innerText;
            document.getElementById("edit_thesis_title").value = row.querySelector("td:nth-child(2)").innerText;
            document.getElementById("edit_technologies").value = row.querySelector("td:nth-child(3)").innerText;
            // 👉 Continue filling for all fields you want

            // Show modal
            const modal = new bootstrap.Modal(document.getElementById("editCommodityModal"));
            modal.show();
        });
    });

    // Handle update button inside modal
    document.getElementById("updateCommodityBtn").addEventListener("click", async function () {
        const form = document.getElementById("editCommodityForm");
        const formData = new FormData(form);
        const id = document.getElementById("edit_id").value;

        try {
            const res = await fetch(`/commodities/update/${id}`, {
                method: "POST", // Laravel needs spoofed PUT
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            });

            const data = await res.json();

            if (data.success) {
                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                });

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById("editCommodityModal"));
                modal.hide();

                // Optionally refresh page or update row in table
                location.reload();
            } else {
                Swal.fire("Error", data.message, "error");
            }

        } catch (err) {
            console.error(err);
            Swal.fire("Error", "Something went wrong.", "error");
        }
    });
    });
</script>

<!-- delte for the record -->
 <script>
    document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".delete").forEach(button => {
        button.addEventListener("click", function () {
            const id = this.dataset.id;

            Swal.fire({
                title: "Are you sure?",
                text: "This will permanently delete the record.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it!"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const res = await fetch(`/commodities/${id}`, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            }
                        });

                        const data = await res.json();

                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted!",
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Remove row from table without reload
                            this.closest("tr").remove();
                        } else {
                            Swal.fire("Error", data.message, "error");
                        }
                    } catch (err) {
                        console.error(err);
                        Swal.fire("Error", "Something went wrong.", "error");
                    }
                }
            });
        });
    });
});

 </script>
<script>
$(document).ready(function() {
    $('.table').DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        responsive: true,
        columnDefs: [{ orderable: false, targets: -1 }],
        theme: 'dark'
    });
});
</script>
@endpush
