@extends('backend.layout.app')
@section('title')
    Clinicians
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Clinicians
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    {{-- <div class="col-md-6">
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
                    </div> --}}
                    {{-- <div class="col-md-6">
                        <a href="{{ route('backend.funds.create') }}" class="btn btn-primary float-end">Add <i
                                class="tf-icons bx bx-plus-circle"></i></a>
                    </div> --}}
                </div>
            </div>

            <div class="card-body">

                <div class="p-4 table-responsive text-nowrap">
                    <table class="table" id="dataTableSize">
                        <thead>
                            <tr>
                                <th>Sr. no</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th style="width: 320px;">Status</th>
                                <th>Resume</th>
                                <th>Action</th>
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
                    info: "Showing clinicians _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> clinicians'
                },
                order:[],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('clinicians.dataTable') }}',
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
                        "data": "email",
                        "className": "text-center",
                        "defaultContent": "",
                    },
                    {
                        "data": "phone",
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
                        "data": "resume",
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
                    // {
                    //       "targets": 2,
                    //       "className": "text-center",
                    //       "render": function(data, type, row, meta) {
                    //           var type = data == 1 ? '<span class="badge bg-label-success">Online</span>' : '<span class="badge bg-label-secondary">Offline</span>';
                    //           return type;
                    //       },
                    //   },
                    // {
                    //     "targets": 6,
                    //     "className": "text-center",
                    //     "render": function(data, type, row, meta) {
                    //         let html = ''

                    //         if (data) {
                    //             data?.forEach(element => {
                    //                 html +=
                    //                     `<span class="badge bg-label-info mb-2">${element.clinician_type.name}</span> <br> `
                    //             });
                    //         }
                    //         return html;
                    //     },
                    // },
                    {
                        "targets": -1,
                        "render": function(data, type, row, meta) {

                            var edit = '{{ route('backend.clinicians.edit', [':course']) }}';
                            edit = edit.replace(':course', data);

                            let returnData =
                                `<div class="text-center">
                                  <a class="text-info" href="${edit}"> <i class="tf-icons bx bxs-user-detail"></i></a>

                                </div>`;
                            // <i class="tf-icons text-danger bx bx-trash js-delete-item cursor-pointer"  data-id="${row.id}"></i>
                            return returnData;
                        },
                    },
                ],
                drawCallback: function() {
                    $(".js-status-switch").on("change", function() {
                        let url = "{{ route('backend.funds.status') }}";

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
                                        '{{ route('backend.funds.destroy') }}', {
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

                    $('.facility_select').select2({
                        width: "350px"
                    });

                    $('.facility_select').on('change.select2', function(e) {
                        // Store a reference to the Select2 element
                        let select2 = $(this);

                        // Get selected facility ID(s)
                        let facilityIds = select2.val();

                        // Ask for confirmation using SweetAlert
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Do you want to update the clinician status?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Prepare data for the request
                                let data = {
                                    id: $(this).data("id"),
                                    facility_ids: facilityIds, // Array of facility IDs
                                };

                                // Make POST request
                                axios.patch("{{ route('backend.clinicians.facility.banned.update') }}", data)
                                    .then((res) => {
                                        Swal.fire({
                                            title: "Done!",
                                            text: "Clinician status successfully updated!",
                                            icon: "success"
                                        });
                                        console.log(table, 'dasasd');
                                        table.draw();
                                    })
                                    .catch((err) => {
                                        Swal.fire({
                                            title: "Error!",
                                            text: `${err}`,
                                            icon: "error"
                                        });
                                        table.draw();
                                    });
                            } else {
                                // If the user cancels the operation, reset the Select2 dropdown to its previous state
                                // select2.val(e.params.data._result.previousValue)
                                //     .trigger('change.select2');
                                table.draw();
                            }
                        });
                    });
                }
            })

        });
    </script>
@endsection
