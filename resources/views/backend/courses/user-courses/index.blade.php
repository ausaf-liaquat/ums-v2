@extends('backend.layout.app')
@section('title')
    My Courses
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    My Courses
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">

            {{-- <h5 class="card-header">Table Basic</h5> --}}
            <div class="p-4 table-responsive text-nowrap">
                <table class="table" id="dataTableSize">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Schedule Date</th>
                            <th>Slot</th>
                            <th>Address</th>
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
                    url: '{{ route('course-schedules.dataTable') }}',
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "datetime",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "slot",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "address",
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
                        "targets": 4,
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

                            var edit = '{{ route('backend.course-schedules.edit', [':course']) }}';
                            edit = edit.replace(':course', data);

                            var content = '{{ route('backend.courses.content', [':course']) }}';
                            content = content.replace(':course', data);
                            let contentHtml = ""
                            if (row.type == 1) {
                                contentHtml += `
                                  <a href="` + content + `" class="text-info p-1" data-original-title="Edit"    title="Course Content" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-message-square-detail" ></i></a>
                              `
                            }

                            let returnData =
                                `<div class="text-center">
                                      <a href="` + edit + `" class="text-info p-1" data-original-title="Edit"    title="" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-edit-alt" ></i></a>
                                      ${contentHtml}
                                      <i class="tf-icons text-danger bx bx-trash js-delete-item cursor-pointer"  data-id="${row.id}"></i>
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
                                        '{{ route('backend.course-schedules.destroy') }}', {
                                            _method: 'delete',
                                            _token: '{{ csrf_token() }}',
                                            id: id,
                                        })
                                    .then(function(response) {
                                        console.log(response);

                                        Swal.fire(
                                            'Deleted!',
                                            'Course schedule has been deleted.',
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
