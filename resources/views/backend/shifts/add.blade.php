@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Shift
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.shifts') }}">Shifts</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Shifts</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize"
                    action="{{ $isEdit ? route('backend.shifts.update', ['shift' => $shift->id]) : route('backend.shifts.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="d-flex pb-5">
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
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Facility Name</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Facility Name"
                                value="{{ $shift->title ?? '' }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="shift_location" class="form-label">Shift Location</label>
                            <select id="location-select" name="shift_location" class="form-select"
                                data-parsley-errors-container="shift_location-error" required>
                                @if ($isEdit)
                                    <option value="{{ $shift ? $shift->address : '' }}" selected>
                                        {{ $shift ? $shift->address : '' }}</option>
                                @endif

                            </select>
                            <input type="hidden" id="complete-address" name="complete_address">
                            <div id="shift_location-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Clinician Type</label>
                            <select id="mf_clinician_type" name="mf_clinician_type_id"
                                data-parsley-errors-container="clinician_type-error" class="form-select" required>
                                @if ($isEdit)
                                    <option value="{{ $shift ? $shift->mf_clinician_type_id : '' }}" selected>
                                        {{ $shift ? $shift->clinician_type->name : '' }}</option>
                                @endif

                            </select>
                            <div id="clinician_type-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="shift_date" class="form-label">Shift Date</label>
                            <input class="form-control" type="date" name="date" value="{{ $shift->date ?? '' }}"
                                id="shift_date" required />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Shift Hours</label>
                            <select id="mf_shift_hour" name="shift_hour_id" data-parsley-errors-container="shift-hour-error"
                                class="form-select" {{ $isEdit ? 'disabled' : '' }}  required>
                                <option value="">Please select shit hour</option>

                                @foreach ($shiftHours as $shiftHour)
                                    <option value="{{ $shiftHour->id }}"
                                        data-total-hour="{{ $shiftHour->shift_total_hours }}"
                                        {{ $isEdit && $shift->mf_shift_hour_id == $shiftHour->id ? 'Selected' : '' }}>
                                        {{ $shiftHour->name }}
                                    </option>
                                @endforeach
                                {{-- <option value="{{ $shift ? $shift->shift_location : '' }}" selected>
                                {{ $shift ? $shift->shift_location : '' }}</option> --}}
                            </select>
                            <div id="shift-hour-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="mf_shift_type_id" class="form-label">Shift Note </label><span
                                class="float-end"><b>What types of shifts are you
                                    interested in?</b>(Select all that interests you)</span>

                            <select id="mf_shift_type" name="mf_shift_type_id[]"
                                data-parsley-errors-container="shift_type-error" multiple class="form-select" required>
                                @if ($isEdit)
                                    @foreach ($shift->mfshift_types as $types)
                                        <option value="{{ $types->types->id }}" selected>{{ $types->types->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div id="shift_type-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="rate_per_hour" class="form-label">Rate per hour</label>

                            <div class="input-group input-group-merge ">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" placeholder="Rate per hour" min="0"
                                    aria-label="Amount (to the nearest dollar)" min="0"
                                    value="{{ $shift->rate_per_hour ?? '' }}" data-parsley-errors-container="#amount-error"
                                    name="rate_per_hour" id="rate_per_hour" step="0.01" {{ $isEdit ? 'readonly' : '' }}  required>
                                <span class="input-group-text">.00</span>
                            </div>
                            <div id="amount-error"></div>

                        </div>
                        <div class="col-md-6" style="padding-top: 13px;">
                            <label class="form-label">Total Amount</label>

                            <p id="total_amount"></p>
                            <input type="hidden" name="total_amount" id="total_amount_input"
                                value="{{ $isEdit && $shift ? $shift->total_amount : null }}">
                        </div>


                        <div class="col-md-12 mb-2">
                            <label for="mf_shift_type_id" class="form-label">Additional Comments</label>

                            <textarea name="additional_comment" id="additional_comment" class="form-control" cols="30" rows="1">{{ $shift->additional_comments ?? '' }}</textarea>
                        </div>
                    </div>
                    {{-- <div class="customer_records_dynamic"></div> --}} <div class="mt-5">
                        <button type="submit" id="submitButton" class="btn btn-primary me-2">Save changes</button>

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
            clinicianSelect2()
            locationSelect2()
            shiftHourSelect2()
            shiftTypeSelect2()

            let form = $('#formSize').parsley()

            $('#submitButton').on('click', function(e) {
                if (form.isValid()) {
                    var $button = $(this);

                    // Disable the button to prevent double-click
                    $button.prop('disabled', true);

                    // Optional: Add a loading indicator (spinner)
                    $button.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                    );

                    // Optionally, you can prevent the form from submitting immediately if needed
                    // e.preventDefault();

                    // If you need to manually submit the form, you can do so here
                    $('#formSize').submit();
                }
            });
            $(document).on('input', '#rate_per_hour', function() {

                let rate_per_hour = $('#rate_per_hour').val();

                let hours = parseFloat($("#mf_shift_hour").find(":selected").data("total-hour"));

                let total_clinician_pay = 0;
                let total_service_charge = 0;
                let total = 0;
                total_clinician_pay = rate_per_hour * hours;
                total_service_charge = hours * 5;
                total = parseFloat(total_clinician_pay + total_service_charge)
                $('#total_amount').html(`$${total}`)
                $('#total_amount_input').val(total);
                console.log(total_clinician_pay, total_service_charge, total);
            });
            $(document).on('change', '#mf_shift_hour', function(e) {
                e.preventDefault();

                let rate_per_hour = $('#rate_per_hour').val();
                let hours = parseFloat($("#mf_shift_hour").find(":selected").data("total-hour"));

                let total_clinician_pay = 0;
                let total_service_charge = 0;
                let total = 0;
                total_clinician_pay = rate_per_hour * hours;
                total_service_charge = hours * 5;
                total = parseFloat(total_clinician_pay + total_service_charge)
                $('#total_amount').html(`$${total}`);
                $('#total_amount_input').val(total);
                console.log(total_clinician_pay, total_service_charge, total);
            });

            @if ($isEdit)
              $('#rate_per_hour').trigger('input')
            @endif
        });

        function clinicianSelect2() {
            $('#mf_clinician_type').select2({
                placeholder: 'Select clinician type',
                ajax: {
                    url: "{{ route('clinician-types.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                        }

                        return query;
                    }
                }
            })
        }

        function shiftHourSelect2() {
            $('#mf_shift_hour').select2()
        }

        function shiftTypeSelect2() {
            $('#mf_shift_type').select2({
                placeholder: 'Select shift type',
                ajax: {
                    url: "{{ route('shift-types.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                        }

                        return query;
                    }
                }
            })
        }

        function locationSelect2() {
            // $(document).on('change', '#location-select', function() {
            $('#location-select').select2({
                ajax: {
                    url: '{{ route('shifts.autocomplete') }}',
                    dataType: 'json',
                    delay: 550,
                    data: function(params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.results
                        };
                    },
                    cache: true,
                },
                minimumInputLength: 3,
            }).on('select2:select', function(event) {
                var data = event.params.data;
                $('#complete-address').val(data.completeAddress);
            });
            // });
        }
    </script>
@endsection
