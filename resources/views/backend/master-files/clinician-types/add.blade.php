@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Clinician Types
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.clinician-types') }}">Clinician Types</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Clinician Types</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formClinicianType"
                    action="{{ $isEdit ? route('backend.clinician-types.update', ['clinician_type' => $clinician_type->id]) : route('backend.clinician-types.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ $clinician_type->name ?? '' }}" placeholder="Enter name" autofocus="" required>
                        </div>

                    </div>
                    <div class="mt-5">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>

                    </div>
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

            let form = $('#formClinicianType').parsley()
        });
    </script>
@endsection