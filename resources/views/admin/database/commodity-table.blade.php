@extends('layouts.database')

@section('title', $commodity . ' - Research Records')

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

    <div class="header pt-5 mb-5 d-flex align-items-center justify-content-between position-relative">
        <!-- Back button on the left -->
        <a href="{{ route('admin.database.commodities') }}" class="btn btn-back">← Back</a>

        <!-- Centered heading -->
        <h1 class="position-absolute start-50 translate-middle-x text-center m-0">
            {{ strtoupper($commodity) }} - RESEARCH RECORDS
        </h1>

    </div>


    <div class="table-wrapper">
        <table class="table table-sm table-striped table-hover nowrap" style="width:100%">


            <thead class="table-dark">
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
                        @if($record->remarks)
                        <span class="badge {{ $remarksClasses[$record->remarks] ?? 'badge-remarks-na' }}">
                            {{ $record->remarks }}
                        </span>
                        @endif
                    </td>


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
                            data-priority_area="{{ $record->priority_area }}">
                            <i class="bi bi-pencil-fill"></i>
                        </button>


                        <button class="save btn btn-success btn-sm" style="display:none;">
                            <i class="bi bi-check-lg"></i>
                        </button>
                        <!-- Push to Notifications -->
                        <button
                            class="push-action btn btn-sm btn-primary"
                            data-id="{{ $record->id }}"
                            data-url="{{ route('notifications.push', $record->id) }}">
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                        <button
                            class="delete btn btn-danger btn-sm"
                            data-id="{{ $record->id }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @include('admin.database.modal.edit-modal')

        <!-- modal for custom table -->
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
<script src="{{ asset('js/pushcontent.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/dark/1.13.6/js/dataTables.dark.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>


<!-- trigger and populate the edit modal -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".edit").forEach(button => {
            button.addEventListener("click", function() {
                const record = this.dataset;

                // Populate Type of Technology properly
                const typeSelect = document.getElementById("edit_type_of_technology");
                const typeValue = record.type_of_technology;
                Array.from(typeSelect.options).forEach(option => {
                    option.selected = option.value === typeValue;
                });

                // Other fields
                document.getElementById("edit_id").value = record.id;
                document.getElementById("commodityEdit").value = record.commodity;
                document.getElementById("edit_technology_generator").value = record.technology_generator;
                document.getElementById("edit_thesis_title").value = record.thesis_title;
                document.getElementById("edit_technologies").value = record.technologies;
                document.getElementById("edit_contact_info").value = record.contact_info;
                document.getElementById("edit_ip_status").value = record.ip_status;
                document.getElementById("edit_trl_level").value = record.trl_level;
                document.getElementById("edit_sdgs").value = record.sdgs;
                document.getElementById("edit_remarks").value = record.remarks;
                document.getElementById("edit_recommendations").value = record.recommendations;
                document.getElementById("edit_link").value = record.link;
                document.getElementById("edit_priority_area").value = record.priority_area;

                // Handle "other" commodity input
                const otherInput = document.getElementById("edit_commodityOther");
                otherInput.style.display = record.commodity === "other" ? "block" : "none";

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById("editCommodityModal"));
                modal.show();
            });
        });

        document.getElementById("commodityEdit").addEventListener("change", function() {
            const otherInput = document.getElementById("edit_commodityOther");
            otherInput.style.display = this.value === "other" ? "block" : "none";
        });
    });
</script>

<!-- update the record -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // When you click an "edit" button, open the modal and load data
        document.querySelectorAll(".edit").forEach(button => {
            button.addEventListener("click", function() {
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
        document.getElementById("updateCommodityBtn").addEventListener("click", async function() {
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

<!-- delete for the record -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".delete").forEach(button => {
            button.addEventListener("click", function() {
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

<!-- modal responsiveness and modal display for all the table  -->
<script>
    $(document).ready(function() {
        $('.table').DataTable({
            responsive: {
                details: {
                    // Custom modal display with <dl> layout
                    display: function(row, update, render) {
                        if (!update) {
                            var data = row.data();

                            let detailsDL = `
                                <dl class="row">
                                    <dt class="col-sm-3 fw-bold">Thesis Title:</dt><dd class="col-sm-9">${data[0]}</dd>
                                    <dt class="col-sm-3 fw-bold">Technologies:</dt><dd class="col-sm-9">${data[1]}</dd>
                                    <dt class="col-sm-3 fw-bold">Technology Generator:</dt><dd class="col-sm-9">${data[2]}</dd>
                                    <dt class="col-sm-3 fw-bold">Contact Info:</dt><dd class="col-sm-9">${data[3]}</dd>
                                    <dt class="col-sm-3 fw-bold">Type of Technology:</dt><dd class="col-sm-9">${data[4]}</dd>
                                    <dt class="col-sm-3 fw-bold">IP Status:</dt><dd class="col-sm-9">${data[5]}</dd>
                                    <dt class="col-sm-3 fw-bold">TRL Level:</dt><dd class="col-sm-9">${data[6]}</dd>
                                    <dt class="col-sm-3 fw-bold">SDGs:</dt><dd class="col-sm-9">${data[7]}</dd>
                                    <dt class="col-sm-3 fw-bold">Remarks:</dt><dd class="col-sm-9">${data[8]}</dd>
                                    <dt class="col-sm-3 fw-bold">Recommendations:</dt><dd class="col-sm-9">${data[9]}</dd>
                                    <dt class="col-sm-3 fw-bold">Link:</dt><dd class="col-sm-9"><a href='${data[10]}' target='_blank'>${data[10]}</a></dd>
                                    <dt class="col-sm-3 fw-bold">Priority Area:</dt><dd class="col-sm-9">${data[11]}</dd>
                                </dl>
                            `;

                            $('#customModal .modal-title').html(`Details for <span class="text-primary fw-bold">${data[0]}</span>`);
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
            columnDefs: [{
                    orderable: false,
                    targets: -1
                } // Actions column
            ],
            columns: [{
                    responsivePriority: 1,
                    className: "all"
                }, // Thesis Title
                {
                    responsivePriority: 2,
                    className: "all"
                }, // Technologies
                {
                    className: "all"
                }, // Tech Generator
                {
                    className: "all"
                }, // Contact Info
                {
                    className: "all"
                }, // Type of Technology
                {
                    className: "all"
                }, // IP Status
                {
                    className: "none"
                }, // TRL Level
                {
                    className: "none"
                }, // SDGs
                {
                    responsivePriority: 3,
                    className: "all"
                }, // Remarks
                {
                    className: "all"
                }, // Recommendations
                {
                    className: "none"
                }, // Link
                {
                    className: "none"
                }, // Priority Area
                {
                    responsivePriority: 4,
                    className: "all"
                } // Actions
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records..."
            }
        });
    });
</script>


@endpush