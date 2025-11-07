@extends('backend.layout.app')
@section('title')
    FAQs
@endsection
@section('css')
    <style>
        .accordion-header+.accordion-collapse .accordion-body {
            padding-top: 20px !important;
        }

        .faq-section {
            border-left: 4px solid #696cff;
            padding-left: 1rem;
            margin-bottom: 2rem;
        }

        .accordion-button {
            font-weight: 500;
            padding: 1rem 1.25rem;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background-color: rgba(105, 108, 255, 0.1);
            color: #696cff;
            box-shadow: none;
        }

        .accordion-body {
            padding: 1rem 1rem 1rem 1.25rem;
            background-color: #f8f9fa;
            border-top: 1px solid #e3e6f0;
        }

        .faq-item {
            margin-bottom: 0.5rem;
            border-radius: 0.375rem;
            overflow: hidden;
            border: 1px solid #e3e6f0;
        }

        .accordion-button:focus {
            border-color: #696cff;
            box-shadow: 0 0 0 0.2rem rgba(105, 108, 255, 0.25);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e3e6f0;
            padding: 1.5rem;
        }

        .card-title {
            color: #566a7f;
            fontWeight: 600;
        }

        .faq-section h5 {
            font-weight: 600;
            color: #566a7f;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f8f9fa;
        }

        .accordion-body ol,
        .accordion-body ul {
            margin-bottom: 0;
        }

        .accordion-body li {
            margin-bottom: 0.25rem;
        }
        ul{
          list-style: none;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">FAQ</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">Frequently Asked Questions</h4>
                        <div class="card-actions">
                            <div class="input-group input-group-merge" style="width: 300px;">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" id="faq-search" placeholder="Search FAQs...">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Account Management Section -->
                        <div class="faq-section mb-4 mt-4">
                            <h5 class="text-primary mb-3"><i class="bx bx-user me-2"></i>Account Management</h5>
                            <div class="accordion" id="accountAccordion">
                                <!-- Question 1 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#account1">
                                            How does DNR negatively affect your organization?
                                        </button>
                                    </h2>
                                    <div id="account1" class="accordion-collapse collapse"
                                        data-bs-parent="#accountAccordion">
                                        <div class="accordion-body">
                                            <em>Information about how DNR (Do not return) affects your organization would be
                                                detailed here soon.</em>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#account2">
                                            How to add credit/debit card to facility account?
                                        </button>
                                    </h2>
                                    <div id="account2" class="accordion-collapse collapse"
                                        data-bs-parent="#accountAccordion">
                                        <div class="accordion-body">
                                            <ul class="mb-0">
                                                <li>Go to Unique Med Services</li>
                                                <li>Click LOGIN in the upper right of the web page</li>
                                                <li>Click Payment Method to the left of page</li>
                                                <li>Click Add button</li>
                                                <li>Fill out credit card information</li>
                                                <li>Click Save Changes button</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#account3">
                                            How to add money to your account balance?
                                        </button>
                                    </h2>
                                    <div id="account3" class="accordion-collapse collapse"
                                        data-bs-parent="#accountAccordion">
                                        <div class="accordion-body">
                                            <ul class="mb-0">
                                                <li>Go to Unique Med Services</li>
                                                <li>Click LOGIN in the upper right of the web page</li>
                                                <li>Click Funds to the left of page</li>
                                                <li>Click Add button</li>
                                                <li>Fill out amount information and select payment method</li>
                                                <li>Click Save Changes button</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Billing & Payments Section -->
                        <div class="faq-section mb-4">
                            <h5 class="text-primary mb-3"><i class="bx bx-credit-card me-2"></i>Billing & Payments</h5>
                            <div class="accordion" id="billingAccordion">
                                <!-- Question 4 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#billing4">
                                            When will the facility be charged for services?
                                        </button>
                                    </h2>
                                    <div id="billing4" class="accordion-collapse collapse"
                                        data-bs-parent="#billingAccordion">
                                        <div class="accordion-body">
                                            The facility will be charged <strong>immediately after posting a
                                                shift(s)</strong>.
                                            The total amount will be charged from the facility balance.
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 5 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#billing5">
                                            How many hours in advance can I cancel a clinician booked shift without being
                                            charged?
                                        </button>
                                    </h2>
                                    <div id="billing5" class="accordion-collapse collapse"
                                        data-bs-parent="#billingAccordion">
                                        <div class="accordion-body">
                                            Facilities need to cancel the shift <strong>2 or more hours before shift
                                                starts</strong> to avoid being
                                            charged 2 hours of clinician pay and service fee.
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 6 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#billing6">
                                            Are there any additional fees when I post a shift?
                                        </button>
                                    </h2>
                                    <div id="billing6" class="accordion-collapse collapse"
                                        data-bs-parent="#billingAccordion">
                                        <div class="accordion-body">
                                            There will be a <strong>$400 holding fee</strong> if clinicians have to stay
                                            after hours for the following:
                                            <ul class="mt-2 mb-0">
                                                <li>Patient emergencies</li>
                                                <li>Wait for another clinician relief</li>
                                                <li>Patient charting</li>
                                                <li>Other emergencies</li>
                                                <li>After the clinician clocks out, the difference of the holding fee will
                                                    be refunded back to
                                                    facility balance in 2-5 business days.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shift Management Section -->
                        <div class="faq-section mb-4">
                            <h5 class="text-primary mb-3"><i class="bx bx-calendar me-2"></i>Shift Management</h5>
                            <div class="accordion" id="shiftAccordion">
                                <!-- Question 7 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#shift7">
                                            How many shifts can I post?
                                        </button>
                                    </h2>
                                    <div id="shift7" class="accordion-collapse collapse"
                                        data-bs-parent="#shiftAccordion">
                                        <div class="accordion-body">
                                            Facilities can post as many shifts as long as their <strong>account balance can
                                                cover this cost</strong>.
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 8 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#shift8">
                                            What happens when no clinician picks up?
                                        </button>
                                    </h2>
                                    <div id="shift8" class="accordion-collapse collapse"
                                        data-bs-parent="#shiftAccordion">
                                        <div class="accordion-body">
                                            The amount charged from the facility account balance will be <strong>refunded
                                                back</strong> to the
                                            facility account balance within 2 to 5 business days.

                                        </div>
                                    </div>
                                </div>

                                <!-- Question 9 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#shift9">
                                            What happens when a clinician cancels the shift?
                                        </button>
                                    </h2>
                                    <div id="shift9" class="accordion-collapse collapse"
                                        data-bs-parent="#shiftAccordion">
                                        <div class="accordion-body">
                                            Possibly another clinician may pick it up. Or the amount charged from the
                                            facility account
                                            balance will be <strong>refunded back</strong> to the facility account balance
                                            within 2 to 5
                                            business days.

                                        </div>
                                    </div>
                                </div>

                                <!-- Question 10 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#shift10">
                                            How to post shifts?
                                        </button>
                                    </h2>
                                    <div id="shift10" class="accordion-collapse collapse"
                                        data-bs-parent="#shiftAccordion">
                                        <div class="accordion-body">
                                            <ul class="mb-0">
                                                <li>Go to Unique Med Services</li>
                                                <li>Click LOGIN in the upper right of the web page</li>
                                                <li>Click 3 lines in the upper right of the web page</li>
                                                <li>Click Dashboard</li>
                                                <li>Click Shift to the left side</li>
                                                <li>Click Add button right side of page</li>
                                                <li>Fill in information including note</li>
                                                <li>Click Post Shift</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 11 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#shift11">
                                            What does URGENT CALL mean?
                                        </button>
                                    </h2>
                                    <div id="shift11" class="accordion-collapse collapse"
                                        data-bs-parent="#shiftAccordion">
                                        <div class="accordion-body">
                                            Occasionally facilities may have shifts that need to be filled last minute,
                                            which are labeled URGENT CALL. When shifts are labeled URGENT CALL, the facility
                                            agrees to pay for the whole shift if the health professional clocks in within an
                                            hour after accepting the shift.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- No Results Message -->
                        <div id="no-results" class="text-center py-5 d-none">
                            <i class="bx bx-search-alt bx-lg text-muted mb-3"></i>
                            <h5 class="text-muted">No FAQs found</h5>
                            <p class="text-muted">Try searching with different keywords</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('faq-search');
            const faqItems = document.querySelectorAll('.faq-item');
            const noResults = document.getElementById('no-results');
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            // Search functionality
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase().trim();
                let visibleCount = 0;

                faqItems.forEach(item => {
                    const question = item.querySelector('.accordion-button').textContent
                        .toLowerCase();
                    const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Show/hide no results message
                noResults.classList.toggle('d-none', visibleCount > 0 || searchTerm === '');

                // Auto-expand matching items
                if (searchTerm) {
                    accordionHeaders.forEach(header => {
                        const item = header.closest('.faq-item');
                        if (item.style.display !== 'none') {
                            const button = header.querySelector('.accordion-button');
                            if (button.classList.contains('collapsed')) {
                                const target = button.getAttribute('data-bs-target');
                                const collapse = document.querySelector(target);
                                if (collapse) {
                                    new bootstrap.Collapse(collapse, {
                                        show: true
                                    });
                                }
                            }
                        }
                    });
                }
            });

            // Add smooth scrolling for better UX
            accordionHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const button = this.querySelector('.accordion-button');
                    if (button.classList.contains('collapsed')) {
                        setTimeout(() => {
                            this.scrollIntoView({
                                behavior: 'smooth',
                                block: 'nearest'
                            });
                        }, 300);
                    }
                });
            });
        });
    </script>
@endsection
