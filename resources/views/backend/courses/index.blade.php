@extends('backend.layout.app')
@section('title')
    Courses
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Courses
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('backend.courses.create') }}" class="btn btn-primary float-end">Add <i
                        class="tf-icons bx bx-plus-circle"></i></a>
            </div>
            {{-- <h5 class="card-header">Table Basic</h5> --}}
            <div class="p-4 table-responsive text-nowrap">
                <table class="table" id="dataTableSize">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Name</th>
                            <th>Type</th>
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
            let table = $("#dataTableSize").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    info: "Showing courses _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> courses'
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('courses.dataTable') }}',
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
                        "data": "type",
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
                            var type = ""
                            if (data == 0) {
                                type = '<span class="badge bg-label-secondary">Offline</span>'
                            } else if (data == 1) {
                                type = '<span class="badge bg-label-success">Online</span>'

                            } else {
                                type = '<span class="badge bg-label-secondary">Offline</span> / ' +
                                    '<span class="badge bg-label-success">Online</span>'
                            }

                            return type;
                        },
                    },
                    {
                        "targets": 3,
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

                            var edit = '{{ route('backend.courses.edit', [':course']) }}';
                            edit = edit.replace(':course', data);

                            var content = '{{ route('backend.courses.content', [':course']) }}';
                            content = content.replace(':course', data);

                            var schedule = '{{ route('backend.course-schedules', [':course']) }}';
                            schedule = schedule.replace(':course', data);

                            let contentHtml = ""
                            if (row.type == 0) {

                                contentHtml += `
                                  <a href="` + schedule + `" class="text-warning p-1" data-original-title="Edit"    title="Course Schedule" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-time" ></i></a>
                              `
                            } else if (row.type == 1) {
                                contentHtml += `
                                  <a href="` + content + `" class="text-danger p-1" data-original-title="Edit"    title="Course Content" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-message-square-detail" ></i></a>
                              `
                            }else{
                              contentHtml += `
                                  <a href="` + schedule + `" class="text-warning p-1" data-original-title="Edit"    title="Course Schedule" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-time" ></i></a>

                                   <a href="` + content + `" class="text-danger p-1" data-original-title="Edit"    title="Course Content" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-message-square-detail" ></i></a>
                              `
                            }

                            let returnData =
                                `<div class="text-center">
                                      <a href="` + edit + `" class="text-info p-1" data-original-title="Edit"    title="" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-edit-alt" ></i></a>
                                      ${contentHtml}

                                    </div>`;

                            return returnData;
                        },
                    },
                ],
                drawCallback: function() {


                    $(".js-status-switch").on("change", function() {
                        let url = "{{ route('backend.courses.status') }}";

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
                                        '{{ route('backend.courses.destroy') }}', {
                                            _method: 'delete',
                                            _token: '{{ csrf_token() }}',
                                            id: id,
                                        })
                                    .then(function(response) {
                                        console.log(response);

                                        Swal.fire(
                                            'Deleted!',
                                            'Courses has been deleted.',
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
    </script>
@endsection
