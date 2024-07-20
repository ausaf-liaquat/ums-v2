@extends('backend.layout.app')
@section('title')
    Funds
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">
                    Funds
                </li>

            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header">
                <a href="{{ route('backend.funds.create') }}" class="btn btn-primary float-end">Add <i
                        class="tf-icons bx bx-plus-circle"></i></a>
            </div>
            {{-- <h5 class="card-header">Table Basic</h5> --}}
            <div class="p-4 table-responsive text-nowrap">
                <table class="table" id="dataTableSize">
                    <thead>
                        <tr>
                            <th>Sr. no</th>
                            <th>Datetime</th>
                            <th>Transaction ID</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            {{-- <th>Actions</th> --}}
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
                    info: "Showing funds _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> funds'
                },

                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('funds.dataTable') }}',
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
                        "data": "transaction.uuid",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "payment_method.first",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    {
                        "data": "amount",
                        "className": "text-center",
                        "defaultContent": "",

                    },
                    // {
                    //     "data": "id",
                    //     "className": "text-center",
                    //     "defaultContent": "",

                    // },

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
                    {
                        "targets": 4,
                        "className": "text-center",
                        "render": function(data, type, row, meta) {

                            return `$ ${data}`;
                        },
                    },
                    // {
                    //     "targets": -1,
                    //     "render": function(data, type, row, meta) {

                    //         var edit = '{{ route('backend.funds.edit', [':course']) }}';
                    //         edit = edit.replace(':course', data);

                    //         let returnData =
                    //             `<div class="text-center">
                    //                   <i class="tf-icons text-danger bx bx-trash js-delete-item cursor-pointer"  data-id="${row.id}"></i>
                    //                 </div>`;

                    //         return returnData;
                    //     },
                    // },
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
                }
            })

        });
    </script>
@endsection
