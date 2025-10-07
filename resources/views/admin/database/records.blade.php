@extends('layouts.database')

@section('title', 'All Research Records')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/dark/1.13.6/css/dataTables.dark.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="{{ asset('css/admin/database/navbar.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/global.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/database/table.css') }}">
@endpush

@section('content')
<div class="container">
    @include('admin.database.navbar')

    <div class="header pt-5 mb-5 d-flex align-items-center position-relative">
        <!-- Back button on the left -->
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back position-absolute start-0">← Back</a>

        <!-- Centered heading -->
        <h1 class="mx-auto text-center">All Research Records</h1>
    </div>


    <div class="table-wrapper m-3">
        <table id="recordsTable" class="table table-sm table-striped table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Commodity</th>
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
                    <td>{{ $record->commodity }}</td>
                    <td>{{ $record->thesis_title }}</td>
                    <td>{{ $record->technologies }}</td>
                    <td>{!! $record->technology_generator !!}</td>
                    <td>{{ $record->contact_info }}</td>
                    @php
                        $techClasses = [
                            'Food' => 'badge-tech-food',
                            'Non-Food' => 'badge-tech-nonfood',
                            'N/A' => 'badge-tech-na',
                            'Non-Food (Chemical)' => 'badge-tech-nonfood-chemical',
                            'Non-Food (Software)' => 'badge-tech-nonfood-software',
                            'Non-Food (Equipment)' => 'badge-tech-nonfood-equipment',
                        ];
                    @endphp

                    <td>
                        @if(!empty($record->type_of_technology))
                            <span class="badge {{ $techClasses[$record->type_of_technology] ?? 'badge-tech-na' }}">
                                {{ $record->type_of_technology }}
                            </span>
                        @endif
                    </td>

                    <td>
                        @php
                            switch($record->ip_status) {
                                case 'Non-IP Applied': $badgeClass = 'badge-ip-non'; break;
                                case 'IP Applied': $badgeClass = 'badge-ip-applied'; break;
                                case 'Registered': $badgeClass = 'badge-ip-registered'; break;
                                case 'N/A': $badgeClass = 'badge-ip-na'; break;
                                default: $badgeClass = 'badge bg-light text-dark';
                            }
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ $record->ip_status }}</span>
                    </td>

                    <td><span class="badge bg-warning text-dark">{{ $record->trl_level }}</span></td>
                    <td>{{ $record->sdgs }}</td>
                    @php
                        $remarksClasses = [
                            'For Product Development' => 'badge-remarks-product',
                            'For Incubation' => 'badge-remarks-incubation',
                            'For Commercialization' => 'badge-remarks-commercialization',
                            'For IP Application' => 'badge-remarks-ip',
                            'For Deployment' => 'badge-remarks-deployment',
                            'For Extention' => 'badge-remarks-extension',
                            'N/A' => 'badge-remarks-na'
                        ];
                    @endphp

                    <td>
                        @if(!empty($record->remarks))
                            <span class="badge {{ $remarksClasses[$record->remarks] ?? 'badge-remarks-na' }}">
                                {{ $record->remarks }}
                            </span>
                        @endif
                    </td>


                    <td>{{ $record->recommendations }}</td>
                    <td>
                        <a href="{{ $record->link }}" target="_blank">{{ $record->link }}</a>
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
                            <!-- Push to Notifications -->
                        <button 
                            class="push-action btn btn-sm btn-primary" 
                            data-id="{{ $record->id }}" 
                            data-url="{{ route('notifications.push', $record->id) }}"
                        >
                            <i class="bi bi-arrow-right-circle"></i>
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

        <!-- Custom Modal for Responsive Details -->
        <div class="modal fade" id="customModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-bold"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <!-- trigger and populate the edit modal -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".edit").forEach(button => {
            button.addEventListener("click", function () {
                const record = this.dataset;

                // Populate "Type of Technology" <select>
                const typeSelect = document.getElementById("edit_type_of_technology");
                if (typeSelect) {
                    Array.from(typeSelect.options).forEach(option => {
                        option.selected = option.value === record.type_of_technology;
                    });
                }

                // Fill input fields
                document.getElementById("edit_id").value = record.id;
                document.getElementById("commodityEdit").value = record.commodity;
                document.getElementById("edit_thesis_title").value = record.thesis_title;
                document.getElementById("edit_technologies").value = record.technologies;
                document.getElementById("edit_technology_generator").value = record.technology_generator;
                document.getElementById("edit_contact_info").value = record.contact_info;
                document.getElementById("edit_ip_status").value = record.ip_status;
                document.getElementById("edit_trl_level").value = record.trl_level;
                document.getElementById("edit_sdgs").value = record.sdgs;
                document.getElementById("edit_remarks").value = record.remarks;
                document.getElementById("edit_recommendations").value = record.recommendations;
                document.getElementById("edit_link").value = record.link;
                document.getElementById("edit_priority_area").value = record.priority_area;

                // Show/hide "other" commodity input
                const otherInput = document.getElementById("edit_commodityOther");
                if (otherInput) {
                    otherInput.style.display = record.commodity === "other" ? "block" : "none";
                }

                // Open modal
                const modal = new bootstrap.Modal(document.getElementById("editCommodityModal"));
                modal.show();
            });
        });

        // Toggle "other" commodity field when user changes dropdown
        const commoditySelect = document.getElementById("commodityEdit");
        if (commoditySelect) {
            commoditySelect.addEventListener("change", function () {
                const otherInput = document.getElementById("edit_commodityOther");
                if (otherInput) {
                    otherInput.style.display = this.value === "other" ? "block" : "none";
                }
            });
        }
    });
</script>

<!-- updating records -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Handle edit button click to populate modal
        document.querySelectorAll(".edit").forEach(button => {
            button.addEventListener("click", function () {
                const record = this.dataset;
                const form = document.getElementById("editCommodityForm");

                form.action = `/admin/database/records/${record.id}`;

                // Populate fields
                document.getElementById("edit_id").value = record.id;
                document.getElementById("edit_commodity").value = record.commodity;
                document.getElementById("edit_thesis_title").value = record.thesis_title;
                document.getElementById("edit_technologies").value = record.technologies;
                document.getElementById("edit_technology_generator").value = record.technology_generator;
                document.getElementById("edit_contact_info").value = record.contact_info;
                document.getElementById("edit_type_of_technology").value = record.type_of_technology;
                document.getElementById("edit_ip_status").value = record.ip_status;
                document.getElementById("edit_trl_level").value = record.trl_level;
                document.getElementById("edit_sdgs").value = record.sdgs;
                document.getElementById("edit_remarks").value = record.remarks;
                document.getElementById("edit_recommendations").value = record.recommendations;
                document.getElementById("edit_link").value = record.link;
                document.getElementById("edit_priority_area").value = record.priority_area;

                // Show/hide "other" commodity input
                const otherInput = document.getElementById("edit_commodityOther");
                if (otherInput) otherInput.style.display = record.commodity === "other" ? "block" : "none";

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById("editCommodityModal"));
                modal.show();
            });
        });

        // Toggle "other" commodity input dynamically
        const commoditySelect = document.getElementById("edit_commodity");
        if (commoditySelect) {
            commoditySelect.addEventListener("change", function () {
                const otherInput = document.getElementById("edit_commodityOther");
                if (otherInput) otherInput.style.display = this.value === "other" ? "block" : "none";
            });
        }

        // Handle form submit
        const form = document.getElementById("editCommodityForm");
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST", // PUT is spoofed via @method('PUT') in Blade
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Updated!",
                        text: data.message,
                        showConfirmButton: true
                    }).then(() => {
                        // Hide modal and reload after user clicks OK
                        bootstrap.Modal.getInstance(document.getElementById("editCommodityModal")).hide();
                        location.reload();
                    });
                } else {
                    Swal.fire("Error", data.message, "error");
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire("Error", "Something went wrong.", "error");
            });
        });
    });
</script>

<!-- delete for the record -->
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

<!-- responsive modal script for records (paste after DataTables scripts) -->
<script>
$(document).ready(function () {
    $('#recordsTable').DataTable({
        order: [[0, 'desc']], // Sort first column (Commodity) DESC
        responsive: {
            details: {
                // Custom modal display using <dl> layout
                display: function (row, update, render) {
                    if (!update) {
                        var data = row.data();
                        // NOTE: data indexes mirror your <th> order:
                        // 0 = Commodity, 1 = Thesis Title, 2 = Technologies, 3 = Technology Generator,
                        // 4 = Contact Info, 5 = Type of Technology, 6 = IP Status,
                        // 7 = TRL Level, 8 = SDGs, 9 = Remarks, 10 = Recommendations,
                        // 11 = Link, 12 = Priority Area, 13 = Actions (buttons)
                        let detailsDL = `
                            <dl class="row">
                                <dt class="col-sm-3 fw-bold">Commodity:</dt><dd class="col-sm-9">${data[0]}</dd>
                                <dt class="col-sm-3 fw-bold">Thesis Title:</dt><dd class="col-sm-9">${data[1]}</dd>
                                <dt class="col-sm-3 fw-bold">Technologies:</dt><dd class="col-sm-9">${data[2]}</dd>
                                <dt class="col-sm-3 fw-bold">Technology Generator:</dt><dd class="col-sm-9">${data[3]}</dd>
                                <dt class="col-sm-3 fw-bold">Contact Info:</dt><dd class="col-sm-9">${data[4]}</dd>
                                <dt class="col-sm-3 fw-bold">Type of Technology:</dt><dd class="col-sm-9">${data[5]}</dd>
                                <dt class="col-sm-3 fw-bold">IP Status:</dt><dd class="col-sm-9">${data[6]}</dd>
                                <dt class="col-sm-3 fw-bold">TRL Level:</dt><dd class="col-sm-9">${data[7]}</dd>
                                <dt class="col-sm-3 fw-bold">SDGs:</dt><dd class="col-sm-9">${data[8]}</dd>
                                <dt class="col-sm-3 fw-bold">Remarks:</dt><dd class="col-sm-9">${data[9]}</dd>
                                <dt class="col-sm-3 fw-bold">Recommendations:</dt><dd class="col-sm-9">${data[10]}</dd>
                                <dt class="col-sm-3 fw-bold">Link:</dt><dd class="col-sm-9">${data[11] ? `<a href='${data[11]}' target='_blank'>${data[11]}</a>` : ''}</dd>
                                <dt class="col-sm-3 fw-bold">Priority Area:</dt><dd class="col-sm-9">${data[12]}</dd>
                            </dl>
                        `;

                        $('#customModal .modal-title').html(
                            `Details for <span class="text-primary fw-bold">${data[0]}</span> — <small>${data[1]}</small>`
                        );
                        $('#customModal .modal-body').html(detailsDL);
                        $('#customModal').modal('show');
                    }
                },
                renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                    tableClass: 'table table-sm'
                })
            }
        },
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        autoWidth: false,
        columnDefs: [
            { orderable: false, targets: -1 } // Actions column (last) not orderable
        ],
        columns: [
            { responsivePriority: 1, className: "all" }, // Commodity
            { responsivePriority: 2, className: "all" }, // Thesis Title
            { className: "none" }, // Technologies
            { className: "none" }, // Technology Generator
            { className: "all" }, // Contact Info
            { className: "all" }, // Type of Technology
            { className: "all" }, // IP Status
            { className: "none" }, // TRL Level
            { className: "none" }, // SDGs
            { className: "all" }, // Remarks
            { className: "all" }, // Recommendations
            { className: "none" }, // Link
            { className: "all" }, // Priority Area
            { responsivePriority: 3, className: "all" } // Actions
        ],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records..."
        }
    });
});
</script>

<!-- push notification -->
<script src="{{ asset('js/pushcontent.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/dark/1.13.6/js/dataTables.dark.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<!-- Include your edit, delete, and modal scripts from the commodity template -->
<!-- include('admin.database.scripts.edit-delete-modal') -->
@endpush
