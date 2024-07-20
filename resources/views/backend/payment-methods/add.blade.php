@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Payment Methods
@endsection

@section('css')
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.payment-methods') }}">Payment Methods</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Payment Methods</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formClinicianType"
                    action="{{ $isEdit ? route('backend.payment-methods.update', ['payment_method' => $payment_method->id]) : route('backend.payment-methods.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Stripe Elements Placeholder -->

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Cardholder Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="card-holder-name" name="first"
                                value="{{ $payment_method->first ?? null }}" placeholder="Card holder name" required>
                        </div>
                        {{-- <div class="col-sm-3">
                        <input type="text" class="form-control" id="last" name="last"
                        value="{{ $payment_method->last ?? null }}" placeholder="Last">
                      </div>
                      <div class="col-sm-3">
                        <input type="text" class="form-control" name="middle" id="middle"
                        value="{{ $payment_method->middle ?? null }}" placeholder="Middle">
                      </div> --}}
                    </div>
                    <div id="card-element"></div>
                    {{-- <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Card Type:</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="card_type">
                                <option selected>Please Select</option>
                                <option value="Discover"
                                    {{ ($payment_method->card_type ?? null) == 'Discover' ? 'selected' : '' }}>Discover
                                </option>
                                <option value="Amex"
                                    {{ ($payment_method->card_type ?? null) == 'Amex' ? 'selected' : '' }}>Amex
                                </option>
                                <option value="Visa"
                                    {{ ($payment_method->card_type ?? null) == 'Visa' ? 'selected' : '' }}>Visa
                                </option>
                                <option value="Mastercard"
                                    {{ ($payment_method->card_type ?? null) == 'Mastercard' ? 'selected' : '' }}>
                                    Mastercard
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Card Number:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Card Number" id="cardNumber"
                                name="card_number" value="{{ $payment_method->card_number ?? null }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Expiration Date:</label>
                        <div class="col-md-4">
                            <select class="form-select" name="exp_month">
                                <option value="01"
                                    {{ ($payment_method->exp_month ?? null) == '01' ? 'selected' : null }}>
                                    January </option>
                                <option value="02"
                                    {{ ($payment_method->exp_month ?? null) == '02' ? 'selected' : null }}>
                                    February </option>
                                <option value="03"
                                    {{ ($payment_method->exp_month ?? null) == '03' ? 'selected' : null }}>
                                    March </option>
                                <option value="04"
                                    {{ ($payment_method->exp_month ?? null) == '04' ? 'selected' : null }}> April
                                </option>
                                <option value="05"
                                    {{ ($payment_method->exp_month ?? null) == '05' ? 'selected' : null }}> May
                                </option>
                                <option value="06"
                                    {{ ($payment_method->exp_month ?? null) == '06' ? 'selected' : null }}> June
                                </option>
                                <option value="07"
                                    {{ ($payment_method->exp_month ?? null) == '07' ? 'selected' : null }}> July
                                </option>
                                <option value="08"
                                    {{ ($payment_method->exp_month ?? null) == '08' ? 'selected' : null }}> August
                                </option>
                                <option value="09"
                                    {{ ($payment_method->exp_month ?? null) == '09' ? 'selected' : null }}> September
                                </option>
                                <option value="10"
                                    {{ ($payment_method->exp_month ?? null) == '10' ? 'selected' : null }}> October
                                </option>
                                <option value="11"
                                    {{ ($payment_method->exp_month ?? null) == '11' ? 'selected' : null }}> November
                                </option>
                                <option value="12"
                                    {{ ($payment_method->exp_month ?? null) == '12' ? 'selected' : null }}> December
                                </option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <select class="form-select" name="exp_year" id="yearpicker">

                                <option value="2024"
                                    {{ ($payment_method->exp_year ?? null) == '2024' ? 'selected' : null }}>2024
                                </option>
                                <option value="2025"
                                    {{ ($payment_method->exp_year ?? null) == '2025' ? 'selected' : null }}>2025
                                </option>
                                <option value="2026"
                                    {{ ($payment_method->exp_year ?? null) == '2026' ? 'selected' : null }}>2026
                                </option>
                                <option value="2027"
                                    {{ ($payment_method->exp_year ?? null) == '2027' ? 'selected' : null }}>2027
                                </option>
                                <option value="2028"
                                    {{ ($payment_method->exp_year ?? null) == '2028' ? 'selected' : null }}>2028
                                </option>
                                <option value="2029"
                                    {{ ($payment_method->exp_year ?? null) == '2029' ? 'selected' : null }}>2029
                                </option>
                                <option value="2030"
                                    {{ ($payment_method->exp_year ?? null) == '2030' ? 'selected' : null }}>2030
                                </option>
                                <option value="2031"
                                    {{ ($payment_method->exp_year ?? null) == '2031' ? 'selected' : null }}>2031
                                </option>
                                <option value="2032"
                                    {{ ($payment_method->exp_year ?? null) == '2032' ? 'selected' : null }}>2032
                                </option>
                                <option value="2033"
                                    {{ ($payment_method->exp_year ?? null) == '2033' ? 'selected' : null }}>2033
                                </option>
                                <option value="2034"
                                    {{ ($payment_method->exp_year ?? null) == '2034' ? 'selected' : null }}>2034
                                </option>
                                <option value="2035"
                                    {{ ($payment_method->exp_year ?? null) == '2035' ? 'selected' : null }}>2035
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Security code:</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Security Code" name="security_code"
                                value="{{ $payment_method->security_code ?? null }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name">Billing Address:</label>
                        <div class="col-md-5">
                            <textarea class="form-control" name="billing_address_1" id="billing_address_1" cols="30" rows="3"> {{ $payment_method->billing_address_1 ?? null }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <textarea class="form-control" name="billing_address_2" id="billing_address_2" cols="30" rows="3"> {{ $payment_method->billing_address_2 ?? null }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name"></label>
                        <div class="col-md-3">
                            <select name="country_id" id="country_id" class="form-control country"
                                data-parsley-errors-container="#country-error" required>
                                @if ($isEdit)
                                    <option value="{{ $payment_method->country_id }}" selected>
                                        {{ $payment_method->country->name }}
                                    </option>
                                @endif
                            </select>
                            <div id="country-error"></div>
                        </div>
                        <div class="col-md-3">
                            <select name="state_id" id="state_id" class="form-control state"
                                data-parsley-errors-container="#state-error" required>
                                @if ($isEdit)
                                    <option value="{{ $payment_method->state_id }}" selected>
                                        {{ $payment_method->state->name }}</option>
                                @endif
                            </select>
                            <div id="state-error"></div>
                        </div>
                        <div class="col-md-3">
                            <select name="city_id" id="city_id" class="form-control city"
                                data-parsley-errors-container="#city-error" required>
                                @if ($isEdit)
                                    <option value="{{ $payment_method->city_id }}" selected>
                                        {{ $payment_method->city->name }}</option>
                                @endif
                            </select>
                            <div id="city-error"></div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="basic-default-name"></label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Zip Code"
                                value="{{ $payment_method->zip_code ?? null }}" name="zip_code">

                        </div>
                    </div> --}}

                    <div class="mt-5">
                        <button id="card-button" class="btn btn-primary me-2">Save changes</button>
                        <div class="spinner-border text-primary" id="loader" role="status"
                            style="vertical-align: middle;display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </form>
            </div>
            <!-- /Account -->
        </div>
        <!--/ Basic Bootstrap Table -->

    </div>
@endsection
@section('script')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const loader = 'auto'
        const clientSecret = '{{ auth()->user()->createSetupIntent()->client_secret }}'
        const elements = stripe.elements({
            clientSecret,
            loader
        });
        const paymentElement = elements.create('card');
        paymentElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        const loaderDiv = document.getElementById('loader');
        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            cardButton.disabled = true; // Disable the button to prevent multiple clicks
            loaderDiv.style.display = 'inline-block'; // Show the loader
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', paymentElement, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            if (error) {
                Swal.fire({
                    icon: "error",
                    title: error.message,
                })
                console.log(error);
                cardButton.disabled = false; // Re-enable the button
                loaderDiv.style.display = 'none'; // Hide the loader
            } else {
                console.log(paymentMethod);
                // The card has been verified successfully...
                const cardType = paymentMethod.card.brand;
                const cardNumber = paymentMethod.card.last4;
                const response = await fetch('{{ route('backend.payment-methods.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        paymentMethod: paymentMethod.id,
                        cardHolderName: cardHolderName.value,
                        cardType: cardType,
                        cardNumber: cardNumber

                    }),
                });

                const result = await response.json();

                if (result.error) {
                    Swal.fire({
                        icon: "error",
                        title: result.error,
                    })


                } else {
                  Swal.fire({
                        icon: "success",
                        title: "Payment method added successfully",
                    })
                    console.log(result.payment);
                    // Payment succeeded, redirect to success page
                    window.location.href = result.redirect_url;
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            countrySelect2()
            stateSelect2()
            citySelect2()
            let form = $('#formClinicianType').parsley()

            $('#cardNumber').on('input', function() {
                let input = $(this);
                let value = input.val().replace(/\D/g, ''); // Remove all non-digit characters

                // Mask the value to format "4444-4444-4444-4444"
                let maskedValue = value.replace(/(\d{4})(?=\d)/g, '$1-');

                input.val(maskedValue);
            });
        });

        function countrySelect2() {
            $('.country').select2({
                placeholder: 'Select Country',
                ajax: {
                    url: "{{ route('countries.select2') }}",
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

        function stateSelect2() {
            $('.state').select2({
                placeholder: 'Select state',
                ajax: {
                    url: "{{ route('states.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: $('.country').val()
                        }

                        return query;
                    }
                }
            })
        }

        function citySelect2() {
            $('.city').select2({
                placeholder: 'Select city',
                ajax: {
                    url: "{{ route('cities.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: $('.country').val(),
                            state_id: $('.state').val()
                        }

                        return query;
                    }
                }
            })
        }

        function maskCreditCardNumber(value) {
            return value.replace(/\d{4}(?=.)/g, '$& ').trim().replace(/.(?=.{4,}$)/g, 'X');
        }
    </script>
@endsection
