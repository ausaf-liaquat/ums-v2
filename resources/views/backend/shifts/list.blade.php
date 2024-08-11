@extends('backend.layout.app')
@section('title')
    Clinician Shifts
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.shifts') }}">Shifts</a>
                </li>
                <li class="breadcrumb-item active">
                    Clinician Shifts
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">

                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex p-4 pt-3">
                          <div class="alert alert-primary" role="alert"><b>Shift: </b> {{ $shift->title }} <b>|</b> <b>Facility: </b> {{ $shift->user->name }}</div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="card-body">

                <div class="p-4 table-responsive text-nowrap">
                    <table class="table" id="dataTableSize">
                        <thead>
                            <tr>
                                <th>Sr. no</th>
                                <th>Clinician Name</th>
                                <th>Clinician Email</th>
                                <th>Shift Accepted At</th>
                                <th>Shift ClockIn At</th>
                                <th>Shift ClockOut At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            {{-- <h5 class="card-header">Table Basic</h5> --}}

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
                    info: "Showing shifts _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> shifts'
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('shifts-clinicians.dataTable') }}/?shift_id=' + "{{ $shift->id }}",
                },
                columns: [{
                        "data": "DT_RowIndex",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "clinician.name",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "clinician.email",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "accepted_at",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "clockin",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "clockout",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "shift_status",
                        "className": "text-center",
                        "defaultContent": "",

                    },

                ],
                columnDefs: [

                    {
                        "targets": 6,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            let status = ""

                            if (data == 0) {
                                status = `<span class="badge bg-label-info mb-2">In Process</span>`
                            } else if (data == 1) {
                                status =
                                    `<span class="badge bg-label-success mb-2">Completed</span>`

                            }

                            return status;
                        },
                    },

                ],
                drawCallback: function() {
                    $(".js-status-switch").on("change", function() {
                        let url = "{{ route('backend.shifts.status') }}";

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
                                        '{{ route('backend.shifts.destroy') }}', {
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
