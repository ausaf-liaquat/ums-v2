@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'View' : 'Add' }} Facility
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.facilities') }}">Facility</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'View' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'View' : 'Add' }} Facility</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formColor"
                    action="{{ $isEdit ? route('backend.facilities.update', ['facility' => $facility->id]) : route('backend.facilities.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->name }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->email }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Unit</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->unit }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Address</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->address }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Mobile</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->mobile }}</p>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">State</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->state->name }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">City</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->city->name }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Zip Code</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->zip_code ?? 'N/A' }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Referred BY</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->referred_by }}</p>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name"><b>WHAT TYPE OF CLINICIANS DO YOU NEED?</b> (SELECT ALL THAT APPLY)</label>
                      <div class="col-sm-10">
                        @foreach ($facility->facility->facility_clinician_types as $facility_clinician_type)
                          <span class="badge bg-label-primary">{{ $facility_clinician_type->clinician_type->name }}</span> <br>
                        @endforeach

                      </div>
                    </div>
                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">Passcode</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->passcode }}</p>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label class="col-sm-2 col-form-label" for="basic-default-name">How many units does your facility need covered?</label>
                      <div class="col-sm-10">
                        <p>{{ $facility->facility->how_many_unit_need }}</p>
                      </div>
                    </div>

                    {{-- <div class="mt-5">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>

                    </div> --}}
                </form>
            </div>
            <!-- /Account -->
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            let form = $('#formColor').parsley()
        });
    </script>
@endsection
