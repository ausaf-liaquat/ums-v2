@extends('backend.layout.app')
@section('title')
    Colors
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);">Master Files</a>
            </li>
            <li class="breadcrumb-item active">
                Colors
            </li>

        </ol>
    </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('backend.colors.create') }}" class="btn btn-primary float-end">Add <i
                        class="tf-icons bx bx-plus-circle"></i></a>
            </div>
            {{-- <h5 class="card-header">Table Basic</h5> --}}
            <div class="p-4 table-responsive text-nowrap">
                <table class="table" id="dataTableColor">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let table = $("#dataTableColor").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    info: "Showing leave requests _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> colors'
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('colors.dataTable') }}',
                    data: {
                        // department_id: $("#department_id").val(),
                        // employee_id: $("#employee_id").val(),
                        // mf_leave_type_id: $("#mf_leave_type_id").val(),
                        // leave_status: $("#leave_status").val(),
                        // isApproval: isApproval,
                        // showArchived: null,
                    }
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "orderable": false,
                        "searchable": false,
                         "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "name",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "status",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "id",
                        "className": "text-center",
                        "defaultContent": "",

                    },

                ],
                columnDefs: [{
                        "targets": 2,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            var checked = row.status == 1 ? 'checked' : null;
                            return `<div class="form-check form-switch mb-2">
                        <input class="form-check-input js-status-switch" type="checkbox" data-id="${row.id}"  ${checked}>

                      </div>`;
                        },
                    },
                    {
                        "targets": -1,
                        "render": function(data, type, row, meta) {

                            var edit = '{{ route('backend.colors.edit', [':color']) }}';
                            edit = edit.replace(':color', data);

                            let returnData =
                                `<div class="text-center">
                                      <a href="` + edit + `" class="text-info p-1" data-original-title="Edit"    title="" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-edit-alt" ></i></a>

                                      <i class="tf-icons text-danger bx bx-trash js-delete-item cursor-pointer"  data-id="${row.id}"></i>
                                    </div>`;

                            return returnData;
                        },
                    },
                ],
                drawCallback: function() {


                    $(".js-status-switch").on("change", function() {
                        let url = "{{ route('backend.colors.status') }}";

                        axios.patch(url, {
                            id: $(this).data("id"),
                            status: $(this).prop("checked"),
                        })
                    });
                    $(".js-delete-item").on("click", function() {
                        let id = $(this).data("id");

                        Swal.fire({
                            icon: "question",
                            title: "Are you sure?",
                            showCancelButton: 1,
                            confirmButtonText: "Yes, delete it!",
                            showLoaderOnConfirm: 1,
                            allowOutsideClick: !1,
                            preConfirm: function(n) {
                                return axios
                                    .post(
                                        '{{ route('backend.colors.destroy') }}', {
                                            _method: 'delete',
                                            _token: '{{ csrf_token() }}',
                                            id: id,
                                        })
                                    .then(function(response) {
                                        console.log(response);

                                        Swal.fire(
                                            'Deleted!',
                                            'Color has been deleted.',
                                            'success'
                                        )
                                        table.draw(false);
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                        Swal.fire(
                                            'Failed!',
                                            error.response.data.error,
                                            'error'
                                        )
                                    });
                            },
                        })
                    });
                }
            })

        });

        function dataTableRefresh() {

            // RESPONSIVE WIDTH CHECK
            let responsiveValue = $(window).width() < 1024 ? true : false;
            const isApproval = "";
            let table = $("#products-datatable").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    info: "Showing leave requests _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> users'
                },
                order: [],
                processing: true,
                serverSide: true,
                responsive: responsiveValue,
                ajax: {
                    url: 'https://digitalhyperlinks.ezhr.pk/ems/leave_requests/datatable',
                    data: {
                        department_id: $("#department_id").val(),
                        employee_id: $("#employee_id").val(),
                        mf_leave_type_id: $("#mf_leave_type_id").val(),
                        leave_status: $("#leave_status").val(),
                        isApproval: isApproval,
                        showArchived: null,
                    }
                },
                columns: [{
                        "data": "id",
                        "className": "text-center",
                        "defaultContent": "",
                        "visible": false,
                    },
                    {
                        "data": "id",
                        "className": "text-center",
                        "defaultContent": ""
                    },
                    {
                        "data": "id",
                        "defaultContent": ""
                    },
                    {
                        "data": "formated_start_date",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": ""
                    },
                    {
                        "data": "formated_end_date",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": ""
                    },
                    {
                        "data": "duration",
                        "className": "text-center",
                        "defaultContent": ""
                    },
                    {
                        "data": "id",
                        "className": "text-center",
                        "defaultContent": ""
                    },
                    {
                        "data": "formated_created_at",
                        "orderable": false,
                        "className": "text-center",
                        "searchable": false,
                        "defaultContent": ""
                    },
                    {
                        "data": "cause",
                        "orderable": false,
                        "defaultContent": ""
                    },
                    {
                        "data": "request_status",
                        "className": "text-center",
                        "defaultContent": ""
                    },

                    {
                        "data": "user_registration.mf_department_id",
                        "defaultContent": "",
                        "searchable": false,
                        "visible": false
                    },
                    {
                        "data": "user_registration.id",
                        "searchable": false,
                        "defaultContent": "",
                        "visible": false
                    },
                    {
                        "data": "id",
                        "defaultContent": ""
                    },


                ],
                "columnDefs": [{
                        "targets": 'no-sort',
                        "orderable": false,
                    },
                    {
                        "targets": 0,
                        "render": function(data, type, row, meta) {

                            if (row.request_status == 0) {
                                return `<input type="checkbox" class="mini-checkbox" data-id="${data}">`;
                            }
                        },
                    },
                    {
                        "targets": 1,
                        "render": function(data, type, row, meta) {

                            return meta.row + 1;
                        },
                    },
                    {
                        "targets": 2,
                        "render": function(data, type, row, meta) {
                            return row.employee
                                .employee_code + " | " + row.employee.first_name + " " + row.employee
                                .last_name;
                        },
                    },
                    {
                        "targets": 3,
                        "render": function(data, type, row, meta) {
                            if (row.if_manager_applied == 1) {
                                return `<span class="text-primary">${data}</span>`;
                            } else {
                                return data;
                            }
                        },
                    },
                    {
                        "targets": 4,
                        "render": function(data, type, row, meta) {
                            if (row.if_manager_applied == 1) {
                                return `<span class="text-primary">${data}</span>`;
                            } else {
                                return data;
                            }
                        },
                    },
                    {
                        "targets": 5,
                        "render": function(data, type, row, meta) {
                            if (row.if_manager_applied == 1) {
                                return `<span class="text-primary">${data}</span>`;
                            } else {
                                return data;
                            }
                        },
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row, meta) {
                            if (row.type == 2) {
                                return `<h4><span class="badge badge-soft-warning rounded-pill"><i class="fas fa-exclamation-triangle me-1"></i>Exception</span></h5>`;
                            } else if (row.if_manager_applied == 1) {
                                return `<h4><span class="badge badge-soft-danger rounded-pill"><i class="fas fa-universal-access me-1"></i>${row.leave_types.name}</span></h4>`;
                            } else {
                                return `<h4><span class="badge badge-soft-primary rounded-pill"><i class="fas fa-universal-access me-1"></i>${row.leave_types.name}</span></h4>`;
                            }
                        },
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row, meta) {
                            if (row.if_manager_applied == 1) {
                                return `<span class="text-primary">${data}</span>`;
                            } else {
                                return data;
                            }
                        },
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row, meta) {
                            if (data) {
                                return limitStringTo25Words(data);
                            } else {
                                return data;
                            }
                        },
                    },
                    {
                        "targets": 9,
                        "render": function(data, type, row, meta) {
                            if (data == 0) {
                                return "<h4><span class='badge bg-warning rounded-pill'>Pending</span></h4>";
                            } else if (data == 1) {
                                return "<h4><span class='badge bg-success rounded-pill'>Accepted</span></h4>";
                            } else {
                                return "<h4><span class='badge bg-danger rounded-pill'>Rejected</span></h4>";
                            }
                        },
                    },

                    {
                        "targets": -1,
                        "render": function(data, type, row, meta) {
                            const isHr = 0;

                            var edit = 'https://digitalhyperlinks.ezhr.pk/ems/leave_requests/:id/edit';
                            edit = edit.replace(':id', data);

                            var view = 'https://digitalhyperlinks.ezhr.pk/ems/leave_requests/view/:id';
                            view = view.replace(':id', data);

                            var checked = row.status == 1 ? 'checked' : null;

                            let returnData = `<div class="text-center">`;

                            if (row.request_status == 0) {
                                returnData +=
                                    `                    `;

                                returnData +=
                                    `                      <a href="` + edit + `" class="text-info p-1" data-original-title="Edit"    title="" data-placement="top" data-toggle="tooltip">
                    <i class="fa fa-pencil-alt" ></i>
                </a>
                              `;
                            }

                            if ((row.request_status == 0 && isHr == 1) || (row.request_status == 0 &&
                                    CURRENT_EMP_ID == row.employee_id)) {
                                console.log('hello');
                                returnData +=
                                    `                      <a href="javascript:;" class="delete text-danger p-2 js-delete-item"   data-original-title="Delete" title="" data-placement="top"  data-toggle="tooltip" data-id="` +
                                    data + `">
                                  <i class="fa fa-trash text-danger"></i>
                                </a>
                              `;
                            }

                            returnData +=
                                `                  <a class="text-info p-1" data-original-title="View" title="View" href="` +
                                view + `" data-toggle="tooltip">
                              <i class="fa fa-list"></i>
                            </a>
                          `;
                            returnData += `</div>`;

                            return returnData;
                        },
                    },
                ],
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $(
                            ".dataTables_length label")
                        .addClass("form-label"), $(".dataTables_filter label").addClass("form-label");

                    $(".js-status-switch").on("change", function() {
                        let url = "https://digitalhyperlinks.ezhr.pk/trainers/status";

                        axios.patch(url, {
                            id: $(this).data("id"),
                            status: $(this).prop("checked"),
                        })
                    });

                    $(".js-resend-item").on("click", function() {
                        let id = $(this).data("id");

                        Swal.fire({
                            icon: "question",
                            title: "Resend email notification?",
                            showCancelButton: 1,
                            confirmButtonText: "Yes, resend it!",
                            showLoaderOnConfirm: 1,
                            allowOutsideClick: !1,
                            preConfirm: function(n) {
                                return axios
                                    .post(
                                        'https://digitalhyperlinks.ezhr.pk/ems/leave_requests/resend-email', {
                                            _token: 'YfbQE3MDcRkqGpesmrHSk0fAXW3FRlfXKbSs4qnt',
                                            id: id,
                                        })
                                    .then(function(response) {
                                        console.log(response);

                                        Swal.fire(
                                            'Sent!',
                                            'Email has been resent.',
                                            'success'
                                        )
                                        table.draw(false);
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                        Swal.fire(
                                            'Failed!',
                                            error.response.data.error,
                                            'error'
                                        )
                                    });
                            },
                        })
                    });

                    $(".js-delete-item").on("click", function() {
                        let id = $(this).data("id");

                        Swal.fire({
                            icon: "question",
                            title: "Are you sure?",
                            showCancelButton: 1,
                            confirmButtonText: "Yes, delete it!",
                            showLoaderOnConfirm: 1,
                            allowOutsideClick: !1,
                            preConfirm: function(n) {
                                return axios
                                    .post(
                                        'https://digitalhyperlinks.ezhr.pk/ems/leave_requests/delete', {
                                            _method: 'delete',
                                            _token: 'YfbQE3MDcRkqGpesmrHSk0fAXW3FRlfXKbSs4qnt',
                                            id: id,
                                        })
                                    .then(function(response) {
                                        console.log(response);

                                        Swal.fire(
                                            'Deleted!',
                                            'Leave Request has been deleted.',
                                            'success'
                                        )
                                        table.draw(false);
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                        Swal.fire(
                                            'Failed!',
                                            error.response.data.error,
                                            'error'
                                        )
                                    });
                            },
                        })
                    });

                    $(".mini-checkbox").change(function() {
                        if ($(".mini-checkbox:checked").length > 0) {
                            $("#resendEmailBTN").show();
                        } else {
                            $("#resendEmailBTN").hide();
                        }
                    })
                }
            })
        }
    </script>
@endsection
