@extends('backend.layout.app')
@section('title')
    My Courses
@endsection
@section('css')
    <style>
        .word-wrap-custom {
            word-wrap: break-word
        }
    </style>
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
            <div class="p-4 table-responsive">
                <table class="table" id="dataTableSize" style="table-layout: fixed; width: 100%">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Course Image</th>
                            <th>Course Title</th>
                            <th>Course Address</th>
                            <th>Course Type</th>
                            <th>Course Price</th>
                            <th>Scheduled At</th>
                            <th>Purchased At</th>
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
                    url: '{{ route('user-courses.dataTable') }}',
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course.image",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course.name",
                        "className": "text-center",
                        "defaultContent": "",

                    },

                    {
                        "data": "course.address",
                        "className": "text-center word-wrap-custom ",
                        "defaultContent": "",

                    },
                    {
                        "data": "course.type",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course.price",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course_schedule.datetime",
                        // "name":"datetime",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "created_at",
                        // "name":"datetime",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "id",
                        "className": "text-center",
                        "defaultContent": "",

                    },

                ],
                columnDefs: [

                    {
                        "targets": 4,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            let typeHtml = ""
                            if (data == 0) {
                                typeHtml += `<span class="badge bg-label-secondary">OFFLINE</span>`
                            } else if (data == 1) {
                                typeHtml += `<span class="badge bg-label-success">ONLINE</span>`

                            } else {
                                typeHtml += `<span class="badge bg-label-danger">ONLINE</span>`

                            }

                            return `${typeHtml}`;
                        },
                    },
                    {
                        "targets": -1,
                        "render": function(data, type, row, meta) {

                            var edit = '{{ route('backend.course-schedules.edit', [':course']) }}';
                            edit = edit.replace(':course', data);

                            var view = '{{ route('backend.user-courses.view', [':user_course']) }}';
                            view = view.replace(':user_course', data);
                            let viewHtml = ""

                            if (row.type == 1) {
                                viewHtml = `
                                  <a href="` + view + `" class="text-info p-1" data-original-title="Edit"    title="Course view" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-message-square-detail" ></i></a>
                              `
                            }

                            let returnData =
                                `<div class="text-center">

                                      ${viewHtml}

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
