@extends('backend.layout.app')

@section('title')
    {{ $isEdit ? 'Edit' : 'Add' }} Funds
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Master Files</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('backend.funds') }}">Funds</a>
                </li>
                <li class="breadcrumb-item active">{{ $isEdit ? 'Edit' : 'Add' }}</li>
            </ol>
        </nav>

        <!-- Basic Bootstrap Table -->
        <div class="card mb-4">
            <h5 class="card-header">{{ $isEdit ? 'Edit' : 'Add' }} Funds</h5>
            <!-- Account -->

            <div class="card-body">
                <form id="formSize"
                    action="{{ $isEdit ? route('backend.funds.update', ['course' => $course->id]) : route('backend.funds.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning" role="alert">Enter the amount you would like to add to your
                                account balance. Based on your average usage, a minimum payment of $1000.00 is recommended.
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-64 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/assets/img/icons/unicons/wallet-info.png') }}"
                                                alt="Credit Card" class="rounded">
                                        </div>
                                    </div>
                                    <span>Your Balance</span>
                                    <h3 class="card-title text-nowrap mb-1">${{ auth()->user()->wallet->balanceFloat }}</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> 0%</small>
                                    <input type="hidden" id="current_balance" name="current_balance"
                                        value="{{ auth()->user()->wallet->balanceFloat }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-64 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/assets/img/icons/unicons/cc-primary.png') }}"
                                                alt="Credit Card" class="rounded">
                                        </div>

                                        <div id="amount-error"></div>
                                    </div>
                                    <span>Add Funds </span>

                                    <div class="input-group input-group-merge mt-3">
                                        <span class="input-group-text">$</span>
                                        <input type="text" class="form-control" placeholder="1000" min="0"
                                            aria-label="Amount (to the nearest dollar)"
                                            data-parsley-errors-container="#amount-error" name="payment_amount"
                                            id="payment_amount" step="0.01" required>
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-64 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <i
                                                class='bg-label-success bx fs-3 p-1 rounded text-success bxs-badge-dollar'></i>
                                        </div>
                                    </div>
                                    <span>Balance After Payment</span>
                                    <h3 class="card-title text-nowrap mb-1" id="balance_after_payment">$0</h3>
                                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> <span
                                            id="percentage_change">0%</span></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <select class="form-control form-select" name="payment_method" id="payment_method" required>
                                <option value="">Please select payment method</option>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->first }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    {{-- <div class="customer_records_dynamic"></div> --}} <div class="mt-5">
                        <button type="submit" id="submitButton" class="btn btn-primary me-2">Save changes</button>
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

            let form = $('#formSize').parsley()
            $(document).on('input', '#payment_amount', function() {
                let payment = parseFloat($(this).val());
                let previous_amount = parseFloat($('#current_balance').val());

                // Ensure previous_amount is a valid number
                if (isNaN(previous_amount)) {
                    previous_amount = 0;
                }

                // Ensure payment is a valid number
                if (isNaN(payment)) {
                    payment = 0;
                }

                let total = payment + previous_amount;

                // Format the total to a localized string with two decimal places
                let formattedTotal = total.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

                // Calculate percentage change, handle division by zero
                let percentageChange = (previous_amount === 0) ? 100 : ((payment / previous_amount) * 100)
                    .toFixed(2);

                // Update balance and percentage change in the DOM
                $('#balance_after_payment').empty();
                $('#balance_after_payment').html(`$ ${formattedTotal}`);

                $('#percentage_change').text(`${percentageChange}%`);
            });

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
            $('#payment_method').select2();
        });
    </script>
@endsection
