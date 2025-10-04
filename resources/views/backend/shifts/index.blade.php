@extends('backend.layout.app')
@section('title')
    Shifts
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Shifts
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                @if (auth()->user()->hasRole('facility'))
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex p-4 pt-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="{{ asset('assets/assets/img/icons/unicons/wallet.png') }}" alt="User">
                                </div>
                                <div>
                                    <small class="text-muted d-block">Total Balance</small>
                                    <div class="d-flex align-items-center">
                                        <h6 class="mb-0 me-1">${{ balanceData()['currentBalance'] }}</h6>
                                        <small class="text-success fw-semibold">
                                            <i class="bx bx-chevron-up"></i>
                                            {{ balanceData()['percentageIncrease'] }}
                                        </small>
                                        <input type="hidden" id="current_balance" name="current_balance"
                                            value="{{ auth()->user()->wallet->balanceFloatNum }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('backend.shifts.create') }}" class="btn btn-primary float-end">Add <i
                                    class="tf-icons bx bx-plus-circle"></i></a>
                        </div>
                    </div>
                @endif

            </div>

            <div class="card-body">

                <div class="p-4 table-responsive text-nowrap">
                    <table class="table" id="dataTableSize">
                        <thead>
                            <tr>
                                {{-- <th>Sr. no</th> --}}
                                <th>Shift Date</th>
                                <th>Shift Created By (Facility)</th>
                                <th>Shift Title</th>
                                <th>Clinician Type</th>
                                <th>Shift Hours</th>
                                <th>Rate Per Hour</th>
                                <th>Total Shift Cost</th>
                                {{-- <th>Shift Notes</th> --}}
                                <th>Status</th>
                                <th>Actions</th>
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
            let checkUser = "{{ auth()->user()->hasRole('super admin') }}";

            let table = $("#dataTableSize").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    },
                    info: "Showing shifts _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> shifts'
                },
                order: [0],
                processing: false,
                serverSide: false,
                ajax: {
                    url: '{{ route('shifts.dataTable') }}',
                },
                columns: [
                    // {
                    //       "data": "DT_RowIndex",
                    //       "orderable": false,
                    //       "searchable": false,
                    //       "className": "text-center",
                    //       "defaultContent": "",

                    //   },
                    {
                        "data": "date",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "user.name",
                        "visible": checkUser ? true : false,
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "title",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "clinician_type",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "shift_hour",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "rate_per_hour",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "total_amount",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    // {
                    //     "data": "mfshift_types",
                    //     "searchable": false,
                    //     "orderable": false,
                    //     "className": "text-center",
                    //     "defaultContent": "",

                    // },
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
                        "targets": 5,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {

                            return `$ ${data}`;
                        },
                    },
                    // {
                    //     "targets": 7,
                    //     "className": "text-center",
                    //     "render": function(data, type, row, meta) {
                    //         let notes = ''
                    //         data.forEach(element => {
                    //             notes +=
                    //                 `<span class="badge bg-label-info mb-2">${element.types.name}</span> <br> `
                    //         });

                    //         return notes;
                    //     },
                    // },
                    {
                        "targets": 7,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {
                            let status = ""

                            if (data == 1) {
                                status =
                                    `<span class="badge bg-label-success mb-2">In Process</span>`
                            } else if (data == 2) {
                                status = `<span class="badge bg-label-danger mb-2">Expired</span>`

                            } else if (data == 3) {
                                status = `<span class="badge bg-label-info mb-2">Completed</span>`;
                            } else {
                                status =
                                    `<span class="badge bg-label-secondary mb-2">Deactivated</span>`

                            }

                            return status;
                        },
                    },
                    {
                        "targets": -1,
                        "render": function(data, type, row, meta) {

                            var edit = '{{ route('backend.shifts.edit', [':course']) }}';
                            edit = edit.replace(':course', data);

                            var detail = '{{ route('backend.shift-clinician.list', [':shift']) }}';
                            detail = detail.replace(':shift', data);

                            let returnData =
                                `<div class="text-center">
                                  <a href="` + edit + `" class="text-info p-1" data-original-title="Edit"    title="" data-placement="top" data-toggle="tooltip"><i class="tf-icons bx bx-edit-alt" ></i></a>
                                   <a href="` + detail + `" class="text-info p-1" data-original-title="Edit"    title="Clinicians Details" data-placement="top" data-toggle="tooltip"><i class='bx bx-detail'></i></a>
                                  <i class="tf-icons text-danger bx bx-trash js-delete-item cursor-pointer"  data-id="${data}"></i>
                                </div>`;

                            return returnData;
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
                                        table.ajax.reload(null, false);
                                        Swal.fire(
                                            'Deleted!',
                                            'Shift has been deleted.',
                                            'success'
                                        )

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
