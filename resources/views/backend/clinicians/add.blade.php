@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'View' : 'Add' }} Clinician
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.facilities') }}">Clinician</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'View' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <!-- Account -->

            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        {{-- <form action="">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-md-3">

                                    <input type="text" name="first_name" value="{{ $clinician->first_name }}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-3">

                                    <input type="text" name="last_name" value="{{ $clinician->last_name }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Email</label>
                                <div class="col-md-6">

                                    <input type="text" name="email" value="{{ $clinician->email ?? '' }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Address</label>
                                <div class="col-md-6">

                                    <textarea name="address" id="address" class="form-control" cols="30" rows="1">{{ $clinician->address ?? 'N/A' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Mobile</label>
                                <div class="col-md-6">

                                    <input type="text" name="phone" value="{{ $clinician->phone ?? '' }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Zip Code</label>
                                <div class="col-md-6">

                                    <input type="text" name="zip_code" value="{{ $clinician->zip_code ?? '' }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Referred BY</label>
                                <div class="col-md-6">

                                    <input type="text" name="referred_by" value="{{ $clinician->referred_by ?? '' }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Qualification</label>
                                <div class="col-md-6">

                                    <input type="text" name="qualification_type"
                                        value="{{ $clinician->qualification_type ?? '' }}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">What types of shifts are you
                                    interested
                                    in? (Select all that interests you)</label>
                                <div class="col-md-6">

                                    @foreach (json_decode($clinician->shifts) ?? [] as $item)
                                        <span class="badge bg-label-primary mb-2">{{ $item }}</span>
                                    @endforeach

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Please select your amount of
                                    licensed work experience below.</label>
                                <div class="col-md-6">


                                    <span class="badge bg-label-primary mb-2">{{ $clinician->experience ?? 'N/A' }}</span>


                                </div>
                            </div>
                        </form> --}}
                        <h4 class="bg-label-primary fw-bolder p-2 rounded text-center text-uppercase">Clinician Info</h4>
                        <form action="{{ route('backend.clinicians.update', ['clinician' => $clinician->id]) }}"
                            method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->name }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Email</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->email }}</p>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Address</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Mobile</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->phone }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Zip Code</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->zip_code ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Referred BY</label>
                                <div class="col-md-6">
                                    <p>{{ $clinician->referred_by ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Qualification</label>
                                <div class="col-md-6">
                                    {{-- <p>{{ $clinician->qualification_type ?? 'N/A' }}</p> --}}
                                    <input type="text" class="form-control" name="qualification_type"
                                        value="{{ $clinician->qualification_type ?? '' }}">

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">What types of shifts are you
                                    interested
                                    in? (Select all that interests you)</label>
                                <div class="col-md-6">

                                    @foreach (json_decode($clinician->shifts) ?? [] as $item)
                                        <span class="badge bg-label-primary mb-2">{{ $item }}</span>
                                    @endforeach

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-md-6 col-form-label" for="basic-default-name">Please select your amount of
                                    licensed work experience below.</label>
                                <div class="col-md-6">


                                    <span class="badge bg-label-primary mb-2">{{ $clinician->experience ?? 'N/A' }}</span>


                                </div>
                            </div>

                            <button class="btn btn-primary"> Submit</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <h4 class="bg-label-primary fw-bolder p-2 rounded text-center text-uppercase">Clinician Documents
                        </h4>
                        <div class="p-4 table-responsive text-nowrap">
                            <table class="table" id="dataTableSize">
                                <thead>
                                    <tr>
                                        <th>Sr. no</th>
                                        <th>Document Title</th>
                                        <th>Document Type</th>
                                        <th>Document Notes</th>
                                        <th>Document File</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- </form> --}}
            </div>
            <!-- /Account -->
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
                    info: "Showing documents _START_ to _END_ of _TOTAL_",
                    lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select> documents'
                },
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('clinician-documents.dataTable') }}',
                    data: {
                        userID: "{{ $clinician->id }}"
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
                        "data": "title",
                        "className": "text-center",
                        "defaultContent": "",
                    },
                    {
                        "data": "document_type.name",
                        "orderable": false,
                        "searchable": false,
                        "className": "text-center",
                        "defaultContent": "",
                    },
                    {
                        "data": "notes",
                        "className": "text-center",
                        "defaultContent": "",
                    },
                    {
                        "data": "file",
                        "className": "text-center",
                        "defaultContent": "",
                    },

                ],
                columnDefs: [

                ],
                drawCallback: function() {

                }
            })
        });
    </script>
@endsection
