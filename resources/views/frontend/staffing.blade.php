@extends('frontend.layouts.app')

@section('title')
    Facilities |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem] mt-16  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Facilities </h1>
            <div
                class="breadcrum-div absolute top-[12rem] lg:top-[18.5rem] md:top-[11rem] right-0 lg:right-12 md:right-12 bg-white shadow-xl py-2 lg:py-2 md:py-4 px-2 lg:px-3 md:px-5  rounded-full">

                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <i
                            class="p-2 text-lg lg:text-xl text-purple-600 border-4 rounded-full fa-solid fa-house bg-primary-800 border-lblue"></i>
                    </li>
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-gray-600 text-xs lg:text-sm" href="{{ route('home') }}">Home
                            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400 dark:text-gray-600"
                                width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                            </svg>
                        </a>
                    </li>

                    <li
                        class="inline-flex items-center text-purple-600 font-bold ml-1 text-xs lg:text-sm text-primary-800 md:ml-2">
                        Facilities
                    </li>
                </ol>
            </div>
        </div>


    </section>
    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Facilities
                    </h1>
                    <div class="w-full mb-4">
                        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                    </div>

                    <p class="text-gray-700 mb-1 mx-auto p-5"> Are you worried about staffing shortage? </p>

                    <p class="text-gray-700 mb-1 mx-auto p-5">Are you worried about patients not getting the
                        care they deserve because of staffing shortage?</p>

                    <p class="text-gray-700 mb-1 mx-auto p-5">UMA staffing are here to help Nurse
                        Manager, Schedulers, Director of Nursing, Administrator and Executives of medical
                        facilities.</p>
                    <p class="text-gray-700 mb-1 mx-auto p-5">
                        UMA staffing is here to improve your staffing as needed. Our team is here to help your
                        facility thrive and improve in patient care. Please Facilities so we can discuss how we
                        can reach your staffing needs.
                    </p>
                </div>
                <div class="p-4">
                    <form method="POST" action="{{ route('talk-to-us.store') }}"
                        class="gradient rounded-lg p-5 text-white">
                        @csrf
                        <h3 class="w-full my-2 text-3xl font-bold leading-tight text-center">
                            Ready to improve your staffing needs?
                        </h3>
                        <p class="p-5">Fill this form below and a representative will contact you shortly to
                            discuss your staffing goals.</p>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">First
                                Name</label>
                            <input type="text" id="base-input" name="first_name" placeholder="Enter first name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Last
                                Name</label>
                            <input type="text" id="base-input" name="last_name" placeholder="Enter last name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Email</label>
                            <input type="email" id="base-input" name="email" placeholder="Enter email" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Phone</label>
                            <input type="number" id="base-input" name="phone" placeholder="Enter phone" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Facility
                                Name</label>
                            <input type="text" id="base-input" name="facility_name" placeholder="Enter facility name"
                                required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Zip
                                Code</label>
                            <input type="text" id="base-input" name="zip_code" placeholder="Enter zip code" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Staffing
                                needs</label>
                            <select name="staffing_needs" id="staffing_needs"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 state"
                                data-parsley-errors-container="#state-error">
                                <option value="">Select...</option>
                                <option value="CNA">CNA</option>
                                <option value="Medication Technician">Medication Technician</option>
                                <option value="PCT">PCT</option>
                                <option value="PT">PT</option>
                                <option value="OT">OT</option>
                                <option value="RT">RT</option>
                                <option value="EKG TECHNICIAN">EKG TECHNICIAN</option>
                                <option value="LPN">LPN</option>
                                <option value="LVN">LVN</option>
                                <option value="RN">RN</option>
                                <option value="ARNP">ARNP</option>
                                <option value="ALL">ALL</option>
                                <option value="OTHER">OTHER</option>
                            </select>
                        </div>
                        <!-- Hidden input for "Other" -->
                        <div class="mb-5" id="other_staffing_need" style="display: none;">
                            <label for="other_input" class="block mb-2 text-sm font-medium dark:text-white">
                                Please specify
                            </label>
                            <input type="text" name="other_staffing_need" id="other_staffing_need_input"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter other staffing need" />
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Facility
                                Type</label>
                            <select name="facility_type" id="facility_type"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 state"
                                id="" required>
                                <option value="">Select Facility Type</option>
                                <option value="Nursing Home">Nursing Home</option>
                                <option value="Rehabilitation">Rehabilitation</option>
                                <option value="Hospice">Hospice</option>
                                <option value="Hospital">Hospital</option>
                                <option value="Skilled nursing">Skilled nursing</option>
                                <option value="Behavioral">Behavioral</option>
                                <option value="ALF">ALF</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <!-- Hidden input for "Other" -->
                        <div class="mb-5" id="other_field" style="display: none;">
                            <label for="other_input" class="block mb-2 text-sm font-medium dark:text-white">
                                Please specify
                            </label>
                            <input type="text" name="other_facility" id="other_input"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter facility type" />
                        </div>
                        <button type="submit" type="button"
                            class="mx-auto lg:mx-2 hover:underline font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out bg-white text-gray-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="bg-gradient-to-br from-purple-50 to-blue-50 py-12">
        <div class="container mx-auto max-w-[85rem] px-4">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">
                    FACILITIES FAQs
                </h2>
                <div class="h-1 mx-auto gradient w-64 opacity-25 rounded-t"></div>
                <p class="mt-6 max-w-2xl mx-auto">
                    Find answers to common questions about our staffing services, pricing, and facility management.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Pricing & Fees Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-dollar-sign text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Pricing & Fees</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    How much is UMS Staffing services?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    <strong class="text-purple-600">$3.00 per hour</strong> service fee per shift.
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    Are there any additional fees when I post a shift?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    There will be a <strong class="text-purple-600">$400 holding fee</strong> for:
                                    <ul class="mt-2 space-y-1">
                                        <li class="flex items-center"><i
                                                class="fas fa-circle text-purple-500 text-xs mr-2"></i>Patient emergencies
                                        </li>
                                        <li class="flex items-center"><i
                                                class="fas fa-circle text-purple-500 text-xs mr-2"></i>Wait for another
                                            clinician relief</li>
                                        <li class="flex items-center"><i
                                                class="fas fa-circle text-purple-500 text-xs mr-2"></i>Patient charting
                                        </li>
                                        <li class="flex items-center"><i
                                                class="fas fa-circle text-purple-500 text-xs mr-2"></i>Other emergencies
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    What does URGENT CALL mean?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    When shifts are labeled <strong class="text-purple-600">URGENT CALL</strong>, the
                                    facility agrees to pay
                                    for the whole shift if the health professional clocks in within an hour after
                                    accepting the shift.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing & Payments Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-credit-card text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Billing & Payments</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    When will the facility be charged for services?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    The facility will be charged <strong class="text-purple-600">immediately after posting a
                                        shift</strong>.
                                    The total amount will be charged from the facility balance.
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    How many hours in advance can I cancel without being charged?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    Facilities need to cancel the shift <strong class="text-purple-600">2 hours before shift
                                        starts</strong>
                                    to avoid being charged 2 hours of clinician pay and service fee.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Shift Management Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar-alt text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Shift Management</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    How many shifts can I post?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    Facilities can post as many shifts as long as their <strong
                                        class="text-purple-600">account balance can
                                        cover the cost</strong>.
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    What happens when no clinician picks up?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    The amount charged from the facility account balance will be <strong
                                        class="text-purple-600">refunded
                                        back</strong> to the facility account balance within 2 to 5 business days.
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    What happens when a clinician cancels the shift?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                   Possibly another clinician may pick it up. Or the amount charged from the facility account balance will be refunded back to the facility account balance.
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Management Section -->
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-purple-100">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user-cog text-white text-lg"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Account Management</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    How to register your facility?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    <ol class="space-y-2">
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">1.</span>Go to Unique Med Services
                                        </li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">2.</span>Click LOGIN in the upper
                                            right</li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">3.</span>Click CREATE AN ACCOUNT
                                        </li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">4.</span>Fill out facility
                                            information</li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">5.</span>Click REGISTER</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="faq-item bg-gray-50 rounded-lg p-4 hover:bg-purple-50 transition duration-200">
                                <button
                                    class="faq-question w-full text-left font-semibold text-gray-700 flex justify-between items-center">
                                    How is the facility FAQ in the facility account?
                                    <i class="fas fa-chevron-down text-purple-600 transition-transform duration-300"></i>
                                </button>
                                <div class="faq-answer mt-3 text-gray-600 hidden">
                                    <ol class="space-y-2">
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">1.</span> Go to <a
                                                class="underline text-purple-600 font-bold mx-2" target="_blank"
                                                href="{{ route('home') }}">
                                                Unique Med Services</a>
                                        </li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">2.</span>Click <a
                                                class="underline text-purple-600 font-bold mx-2" target="_blank"
                                                href="{{ route('login') }}">LOGIN</a> in the upper
                                            right of the web page</li>
                                        <li class="flex items-start"><span
                                                class="text-purple-600 font-bold mr-2">3.</span>Click <a
                                                class="underline text-purple-600 font-bold mx-2" target="_blank"
                                                href="{{ route('backend.faqs') }}">Facility FAQ</a> to the
                                            left of page</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="text-center mt-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl p-8 text-white">
                <h3 class="text-2xl font-bold mb-4">Still Have Questions?</h3>
                <p class="text-purple-100 mb-6 max-w-2xl mx-auto">
                    Our team is here to help you with any questions about our staffing services and how we can support your
                    facility.
                </p>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Form functionality
            $('#facility_type').on('change', function() {
                if ($(this).val() === 'Other') {
                    $('#other_field').slideDown();
                    $('#other_input').attr('required', true);
                } else {
                    $('#other_field').slideUp();
                    $('#other_input').removeAttr('required').val('');
                }
            });

            $('#staffing_needs').on('change', function() {
                if ($(this).val() === 'OTHER') {
                    $('#other_staffing_need').slideDown();
                    $('#other_staffing_need_input').attr('required', true);
                } else {
                    $('#other_staffing_need').slideUp();
                    $('#other_staffing_need_input').removeAttr('required').val('');
                }
            });

            // FAQ functionality
            $('.faq-question').on('click', function() {
                const $answer = $(this).next('.faq-answer');
                const $icon = $(this).find('i');

                // Close all other answers
                $('.faq-answer').not($answer).slideUp(300);
                $('.faq-question i').not($icon).removeClass('fa-chevron-up').addClass('fa-chevron-down');

                // Toggle current answer
                $answer.slideToggle(300);
                $icon.toggleClass('fa-chevron-up fa-chevron-down');

                // Close other items in the same category
                $(this).closest('.faq-item').siblings().find('.faq-answer').slideUp(300);
                $(this).closest('.faq-item').siblings().find('.faq-question i').removeClass('fa-chevron-up')
                    .addClass('fa-chevron-down');
            });

            // Add hover effects
            $('.faq-item').hover(
                function() {
                    $(this).css('transform', 'translateY(-2px)');
                    $(this).css('box-shadow',
                        '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)');
                },
                function() {
                    $(this).css('transform', 'translateY(0)');
                    $(this).css('box-shadow', 'none');
                }
            );
        });
    </script>

    <style>
        .gradient {
            background: linear-gradient(135deg, #9061f9 0%, #6c2bd9 100%);
        }

        .faq-item {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
        }

        .faq-item:hover {
            border-color: #9061f9;
        }

        .faq-question {
            transition: color 0.3s ease;
        }

        .faq-question:hover {
            color: #9061f9;
        }

        .faq-answer {
            border-left: 3px solid transparent;
            padding-left: 1rem;
        }

        .faq-item.active .faq-answer {
            border-left-color: #9061f9;
        }
    </style>
@endsection
