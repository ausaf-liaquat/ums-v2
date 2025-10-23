@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Shift
@endsection

@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
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
                                <small class="text-muted d-block">Facility Total Balance</small>
                                <div class="d-flex align-items-center">
                                    <h6 class="mb-0 me-1">${{ balanceData($shift->user_id ?? '')['currentBalance'] }}</h6>
                                    <small class="text-success fw-semibold">
                                        <i class="bx bx-chevron-up"></i>
                                        {{ balanceData($shift->user_id ?? '')['percentageIncrease'] }}
                                    </small>
                                    <input type="hidden" id="current_balance" name="current_balance"
                                        value="{{ balanceData($shift->user_id ?? '')['currentBalance'] }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Facility Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Facility Name"
                                value="{{ $shift->title ?? '' }}" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="shift_location" class="form-label">Shift Location <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="shift_location" value="{{ $shift->shift_location ?? '' }}"
                                class="form-control" placeholder="Enter Shift Location" required>
                            {{-- <select id="location-select" name="shift_location" class="form-select"
                                data-parsley-errors-container="shift_location-error" required>
                                @if ($isEdit)
                                    <option value="{{ $shift ? $shift->shift_location : '' }}" selected>
                                        {{ $shift ? $shift->shift_location : '' }}</option>
                                @endif

                            </select> --}}
                            <input type="hidden" id="complete-address" name="complete_address">
                            <div id="shift_location-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Clinician Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-select" name="clinician_type" id="clinician_type" required
                                {{ $isEdit ? 'readonly' : '' }}>
                                <option value="">Please Select</option>
                                <option value="CNA" {{ $isEdit && $shift->clinician_type == 'CNA' ? 'selected' : '' }}>
                                    CNA
                                </option>
                                {{-- <option value="PST" {{ $isEdit && $shift->clinician_type == 'PST' ? 'selected' : '' }}>
                                    PST
                                </option> --}}
                                <option value="Medication Technician"
                                    {{ $isEdit && $shift->clinician_type == 'Medication Technician' ? 'selected' : '' }}>
                                    Medication Technician</option>
                                <option value="PCT" {{ $isEdit && $shift->clinician_type == 'PCT' ? 'selected' : '' }}>
                                    PCT
                                </option>
                                <option value="PT" {{ $isEdit && $shift->clinician_type == 'PT' ? 'selected' : '' }}>
                                    PT
                                </option>
                                <option value="OT" {{ $isEdit && $shift->clinician_type == 'OT' ? 'selected' : '' }}>OT
                                </option>
                                <option value="RT" {{ $isEdit && $shift->clinician_type == 'RT' ? 'selected' : '' }}>RT
                                </option>
                                <option value="EKG Technician"
                                    {{ $isEdit && $shift->clinician_type == 'EKG Technician' ? 'selected' : '' }}>EKG
                                    Technician</option>
                                <option value="LPN" {{ $isEdit && $shift->clinician_type == 'LPN' ? 'selected' : '' }}>
                                    LPN</option>
                                <option value="RN" {{ $isEdit && $shift->clinician_type == 'RN' ? 'selected' : '' }}>RN
                                </option>
                                <option value="LVN"
                                    {{ $isEdit && $shift->clinician_type == 'LVN' ? 'selected' : '' }}>LVN
                                </option>
                                <option value="ARNP" {{ $isEdit && $shift->clinician_type == 'ARNP' ? 'selected' : '' }}>
                                    ARNP</option>
                            </select>
                            {{-- <select id="mf_clinician_type" name="mf_clinician_type_id"
                                data-parsley-errors-container="clinician_type-error" class="form-select" required>
                                @if ($isEdit)
                                    <option value="{{ $shift ? $shift->mf_clinician_type_id : '' }}" selected>
                                        {{ $shift ? $shift?->clinician_type?->name : '' }}</option>
                                @endif

                            </select>
                            <div id="clinician_type-error"></div> --}}
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="shift_date" class="form-label">Shift Date <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="date" value="{{ $shift->date ?? '' }}"
                                id="shift_date" required {{ $isEdit ? 'disabled' : '' }} />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="course_name" class="form-label">Shift Hours <span
                                    class="text-danger">*</span></label>
                            {{-- @if ($isEdit)
                                <input type="text" class="form-control shift_hour" placeholder="" name="shift_hour"
                                    value="{{ $shift->shift_hour }}" required readonly>
                            @else --}}
                            <select class="form-control form-select shift_hour" name="shift_hour" required
                                {{ $isEdit ? 'readonly' : '' }}>
                                <option value="">Please Select</option>
                                <option value="5:45a-6:15p(12hrs)"
                                    {{ $isEdit && $shift->shift_hour == '5:45a-6:15p(12hrs)' ? 'selected' : '' }}>
                                    5:45a-6:15p(12hrs)</option>
                                <option value="5:45p-6:15a(12hrs)"
                                    {{ $isEdit && $shift->shift_hour == '5:45p-6:15a(12hrs)' ? 'selected' : '' }}>
                                    5:45p-6:15a(12hrs)</option>
                                <option value="6a-2p(7.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '6a-2p(7.5hrs)' ? 'selected' : '' }}>
                                    6a-2p(7.5hrs)</option>
                                <option value="6a-6p(11.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '6a-6p(11.5hrs)' ? 'selected' : '' }}>
                                    6a-6p(11.5hrs)</option>
                                <option value="6:45a-3:15p(8.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '6:45a-3:15p(8.5hrs)' ? 'selected' : '' }}>
                                    6:45a-3:15p(8.5hrs)</option>
                                <option value="6:45a-7:15p(12.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '6:45a-7:15p(12.5hrs)' ? 'selected' : '' }}>
                                    6:45a-7:15p(12.5hrs)</option>
                                <option value="6:45p-7:15a(12.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '6:45p-7:15a(12.5hrs)' ? 'selected' : '' }}>
                                    6:45p-7:15a(12.5hrs)</option>
                                <option value="7a-3p(8hrs)"
                                    {{ $isEdit && $shift->shift_hour == '7a-3p(8hrs)' ? 'selected' : '' }}>7a-3p(8hrs)
                                </option>
                                <option value="7a-7p(12hrs)"
                                    {{ $isEdit && $shift->shift_hour == '7a-7p(12hrs)' ? 'selected' : '' }}>
                                    7a-7p(12hrs)</option>
                                <option value="7p-7a(12hrs)"
                                    {{ $isEdit && $shift->shift_hour == '7p-7a(12hrs)' ? 'selected' : '' }}>
                                    7p-7a(12hrs)</option>
                                <option value="9:45p-6:15a(8hrs)"
                                    {{ $isEdit && $shift->shift_hour == '9:45p-6:15a(8hrs)' ? 'selected' : '' }}>
                                    9:45p-6:15a(8hrs)</option>
                                <option value="10:45p-7:15a(8.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '10:45p-7:15a(8.5hrs)' ? 'selected' : '' }}>
                                    10:45p-7:15a(8.5hrs)</option>
                                <option value="10p-6a(7.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '10p-6a(7.5hrs)' ? 'selected' : '' }}>
                                    10p-6a(7.5hrs)</option>
                                <option value="11p-7a(8.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '11p-7a(8.5hrs)' ? 'selected' : '' }}>
                                    11p-7a(8.5hrs)</option>
                                <option value="1:45p-10:15p(8hrs)"
                                    {{ $isEdit && $shift->shift_hour == '1:45p-10:15p(8hrs)' ? 'selected' : '' }}>
                                    1:45p-10:15p(8hrs)</option>
                                <option value="2:45p-11:15p(8.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '2:45p-11:15p(8.5hrs)' ? 'selected' : '' }}>
                                    2:45p-11:15p(8.5hrs)</option>
                                <option value="2p-10p(7.5hrs)"
                                    {{ $isEdit && $shift->shift_hour == '2p-10p(7.5hrs)' ? 'selected' : '' }}>
                                    2p-10p(7.5hrs)</option>
                                <option value="3p-11p(8hrs)"
                                    {{ $isEdit && $shift->shift_hour == '3p-11p(8hrs)' ? 'selected' : '' }}>
                                    3p-11p(8hrs)</option>
                            </select>
                            <input type="hidden" class="form-control actual_shift_hour" placeholder=""
                                name="actual_shift_hour" value="{{ $shift->actual_shift_hour ?? '' }}" required readonly>
                            {{-- @endif --}}

                            {{-- <select id="mf_shift_hour" name="shift_hour_id" data-parsley-errors-container="shift-hour-error"
                                class="form-select" {{ $isEdit ? 'disabled' : '' }} required>
                                <option value="">Please select shit hour</option>

                                @foreach ($shiftHours as $shiftHour)
                                    <option value="{{ $shiftHour->id }}"
                                        data-total-hour="{{ $shiftHour->shift_total_hours }}"
                                        {{ $isEdit && $shift->mf_shift_hour_id == $shiftHour->id ? 'Selected' : '' }}>
                                        {{ $shiftHour->name }}
                                    </option>
                                @endforeach

                            </select> --}}
                            <div id="shift-hour-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="mf_shift_type_id" class="form-label">Shift Note<span class="text-danger">*</span>
                            </label><span class="float-end"><b>SELECT TYPE OF SHIFT</b></span>

                            <select id="mf_shift_type" name="mf_shift_type_id[]"
                                data-parsley-errors-container="shift_type-error" multiple class="form-select" required>
                                {{-- @if ($isEdit)
                                    @foreach ($shift->mfshift_types as $types)
                                        <option value="{{ $types->types->id }}" selected>{{ $types->types->name }}
                                        </option>
                                    @endforeach
                                @endif --}}

                                <option value="AM"
                                    {{ $isEdit && json_decode($shift->shift_note) != null && in_array('AM', json_decode($shift->shift_note)) ? 'selected' : '' }}>
                                    AM</option>
                                <option value="PM"
                                    {{ $isEdit && json_decode($shift->shift_note) != null && in_array('PM', json_decode($shift->shift_note)) ? 'selected' : '' }}>
                                    PM</option>
                                <option value="NOC"
                                    {{ $isEdit && json_decode($shift->shift_note) != null && in_array('NOC', json_decode($shift->shift_note)) ? 'selected' : '' }}>
                                    NOC</option>
                                <option value="URGENT CALL"
                                    {{ $isEdit && json_decode($shift->shift_note) != null && in_array('URGENT CALL', json_decode($shift->shift_note)) ? 'selected' : '' }}>
                                    URGENT CALL</option>
                            </select>
                            <div id="shift_type-error"></div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="rate_per_hour" class="form-label">Rate per hour <span
                                    class="text-danger">*</span></label>

                            <div class="input-group input-group-merge ">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control rph" placeholder="Rate per hour"
                                    min="0" aria-label="Amount (to the nearest dollar)" min="0"
                                    value="{{ $shift->rate_per_hour ?? '' }}"
                                    data-parsley-errors-container="#amount-error" name="rate_per_hour" id="rate_per_hour"
                                    step="0.01" {{ $isEdit ? 'readonly' : '' }} required>
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
                            <label for="mf_shift_type_id" class="form-label">Additional Comments <span
                                    class="text-danger">*</span></label>

                            <textarea name="additional_comment" id="additional_comment" class="form-control" cols="30" rows="1"
                                required>{{ $shift->additional_comments ?? '' }}</textarea>
                        </div>
                    </div>
                    {{-- <div class="customer_records_dynamic"></div> --}} <div class="mt-5">
                        <button type="submit" id="submitButton" class="btn btn-primary me-2">Post Shift</button>

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
            const isEdit = @json($isEdit);
            let form = $('#formSize').parsley()
            $('#clinician_type').select2({
                placeholder: 'Select clinician type'
            });
            $('.shift_hour').select2({
                placeholder: 'Select shift hour'
            });
            // Minimum rate mapping per clinician type
            const minRates = {
                'CNA': 25,
                'MEDICATION TECHNICIAN': 25,
                'PCT': 25,
                'PT': 40,
                'OT': 40,
                'RT': 50,
                'EKG TECHNICIAN': 35,
                'LPN': 45,
                'LVN': 45,
                'RN': 55,
                'ARNP': 65
            };

            // When clinician type changes
            $(document).on('change', '#clinician_type', function() {
                const type = $(this).val()?.toUpperCase() || '';
                const minRate = minRates[type] || 0;

                const $rateInput = $('#rate_per_hour');

                if (minRate > 0) {
                    $rateInput.attr('min', minRate);
                    $rateInput.attr('placeholder', `Minimum $${minRate}`);
                } else {
                    $rateInput.removeAttr('min');
                    $rateInput.attr('placeholder', 'Rate per hour');
                }

                // Reset value if below min
                const current = parseFloat($rateInput.val() || 0);
                // if (current < minRate) {
                $rateInput.val(minRate);
                // }

                $('.rph').trigger('input');
            });

            // Enforce live validation while typing
            $(document).on('input', '#rate_per_hour', function() {
                const type = $('#clinician_type').val()?.toUpperCase() || '';
                const minRate = minRates[type] || 0;
                const val = parseFloat($(this).val());
                const $errorContainer = $('#amount-error');

                // Clear previous message
                $errorContainer.html('');

                // Show message only if below min rate
                if (!isNaN(val) && val < minRate) {
                    $errorContainer.html(
                        `<small class="text-danger">Minimum rate for ${type || 'this type'} is $${minRate}/hr.</small>`
                    );
                }
            });
            clinicianSelect2()
            locationSelect2()
            shiftHourSelect2()
            shiftTypeSelect2()

            const fp = flatpickr("#shift_date", {
                dateFormat: "Y-m-d",
                minDate: "today",
                disableMobile: true,
                allowInput: true,
            });

            // ✅ If editing, disable user interaction
            if (isEdit) {
                fp.input.readOnly = true;
                fp.input.classList.add('bg-light'); // optional styling
                fp.destroy(); // prevents calendar popup
            }

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
            // $(document).on('input', '#rate_per_hour', function() {

            //     let rate_per_hour = $('#rate_per_hour').val();

            //     let hours = parseFloat($("#mf_shift_hour").find(":selected").data("total-hour"));

            //     let total_clinician_pay = 0;
            //     let total_service_charge = 0;
            //     let total = 0;
            //     total_clinician_pay = rate_per_hour * hours;
            //     total_service_charge = hours * 5;
            //     total = parseFloat(total_clinician_pay + total_service_charge)
            //     $('#total_amount').html(`$${total}`)
            //     $('#total_amount_input').val(total);
            //     console.log(total_clinician_pay, total_service_charge, total);
            // });
            // $(document).on('change', '#mf_shift_hour', function(e) {
            //     e.preventDefault();

            //     let rate_per_hour = $('#rate_per_hour').val();
            //     let hours = parseFloat($("#mf_shift_hour").find(":selected").data("total-hour"));

            //     let total_clinician_pay = 0;
            //     let total_service_charge = 0;
            //     let total = 0;
            //     total_clinician_pay = rate_per_hour * hours;
            //     total_service_charge = hours * 5;
            //     total = parseFloat(total_clinician_pay + total_service_charge)
            //     $('#total_amount').html(`$${total}`);
            //     $('#total_amount_input').val(total);
            //     console.log(total_clinician_pay, total_service_charge, total);
            // });
            // $(document).on('input', '.rph', function() {
            //     let shift_hour = $(".shift_hour").val();
            //     let rate_per_hour = $('.rph').val();
            //     let regex = /\((\d+(?:\.\d+)?)hrs\)/;
            //     let match = regex.exec(shift_hour);
            //     let hours = parseFloat(match[1]);

            //     console.log(match, hours, rate_per_hour, shift_hour);


            //     let total_clinician_pay = 0;
            //     let total_service_charge = 0;
            //     let total = 0;
            //     total_clinician_pay = parseFloat(rate_per_hour) * hours;
            //     total_service_charge = hours * 5;
            //     total = total_clinician_pay + total_service_charge
            //     $('#total_amount').html(`$${total}`)
            //     $('#total_amount_input').val(total);
            //     console.log(parseFloat(rate_per_hour), hours, rate_per_hour * hours + 5);
            // });
            $(document).on('input', '.rph', function() {
                let shift_hour = $(".shift_hour").val();
                let rate_per_hour = parseFloat($('.rph').val());
                let regex = /\((\d+(?:\.\d+)?)hrs\)/;

                if (!shift_hour || isNaN(rate_per_hour)) {
                    $('#total_amount').html(`$0.00`);
                    $('#total_amount_input').val(0);
                    return;
                }
                let match = regex.exec(shift_hour);
                let hours = parseFloat(match[1]) || 0;

                const service_fee_per_hour = 3; // configurable
                const holding_fee = 400; // configurable

                let total_clinician_pay = rate_per_hour * hours;
                let total_service_charge = hours * service_fee_per_hour;
                let total = total_clinician_pay + total_service_charge + holding_fee;

                $('.actual_shift_hour').val(hours);
                $('#total_amount').html(`$${total.toFixed(2)}`);
                $('#total_amount_input').val(total);
            });
            $(document).on('change', '.shift_hour', function(e) {
                e.preventDefault();

                $('.rph').trigger('input');
                // let shift_hour = $(".shift_hour").val();
                // let rate_per_hour = $('.rph').val();
                // let regex = /\((\d+(?:\.\d+)?)hrs\)/;
                // let match = regex.exec(shift_hour);
                // let hours = parseFloat(match[1]);

                // let total_clinician_pay = 0;
                // let total_service_charge = 0;
                // let total = 0;
                // total_clinician_pay = parseFloat(rate_per_hour) * hours;
                // total_service_charge = hours * 5;
                // total = total_clinician_pay + total_service_charge
                // $('#total_amount').html(`$${total}`);
                // $('#total_amount_input').val(total);
                // console.log(parseFloat(rate_per_hour), hours, rate_per_hour * hours + 5);
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
                // ajax: {
                //     url: "{{ route('shift-types.select2') }}",
                //     delay: 250,
                //     data: function(params) {
                //         var query = {
                //             q: params.term,
                //         }

                //         return query;
                //     }
                // }
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
