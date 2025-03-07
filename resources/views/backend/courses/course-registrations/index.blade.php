@extends('backend.layout.app')
@section('title')
    Course Registrations
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Course Registrations
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
                            <th>Course Name</th>
                            <th>Register By</th>
                            <th>Clinician Email</th>
                            <th>Clinician Phone no</th>
                            <th>Register At</th>
                            <th>Course Type</th>
                            <th>Course Details</th>
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
                    info: "Showing course registrations _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> course registrations'
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('course-registration.dataTable') }}',
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course.name",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "user.name",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "user.email",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "user.phone",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "created_at",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "type",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "course_schedule",
                        "className": "text-center",
                        "defaultContent": "",

                    },

                ],
                columnDefs: [{
                        "targets": 2,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            if (row.user) {
                                var edit = '{{ route('backend.clinicians.edit', [':id']) }}';
                                edit = edit.replace(':id', row.user.id);

                                return `<a href="${edit}" target="_blank">${row.user.name}  <i class="tf-icons bx bx-arrow-from-left"></i></a>`;
                            } else {
                                return "";
                            }

                        },
                    },
                    {
                        "targets": 5,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            let date = new Date(data); // Current date

                            let month = (date.getMonth() + 1).toString().padStart(2,
                                '0'); // Add leading zero
                            let day = date.getDate().toString().padStart(2,
                                '0'); // Add leading zero
                            let year = date.getFullYear();

                            let formattedDate = `${month}/${day}/${year}`;

                            return formattedDate
                        },
                    },
                    {
                        "targets": 6,
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
