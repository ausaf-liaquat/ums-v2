@extends('frontend.layouts.app')

@section('title')
    Talk To Us |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem] mt-16  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Talk To Us </h1>
            <div
                class="breadcrum-div absolute top-[12rem] lg:top-[18.5rem] md:top-[11rem] right-0 lg:right-0 md:right-0 bg-white shadow-xl py-2 lg:py-2 md:py-4 px-2 lg:px-3 md:px-5  rounded-full">

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
                        Talk To Us
                    </li>
                </ol>
            </div>
        </div>


    </section>
    {{-- <div class="relative -mt-12 lg:-mt-24">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path
                        d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                        opacity="0.100000001"></path>
                    <path
                        d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                        opacity="0.100000001"></path>
                    <path
                        d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                        id="Path-4" opacity="0.200000003"></path>
                </g>
                <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                    <path
                        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                    </path>
                </g>
            </g>
        </svg>
    </div> --}}
    {{-- <section class="bg-white border-b py-8">

        <div class="flex flex-wrap">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Our Talk
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
        </div>
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 pb-12 px-3">

            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img.jpg') }})">
                <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                <div class="md:absolute bottom-0 left-0 w-full p-4 text-white ">
                    <h6 class="text-lg font-bold dark:text-white">Home Visits</h6>
                    <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p>
                </div>
            </div>
            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img-1.jpg') }})">
                <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                <div class="md:absolute bottom-0 left-0 w-full p-4 text-white ">
                    <h6 class="text-lg font-bold dark:text-white">Home Visits</h6>
                    <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p>
                </div>
            </div>
            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img-2.jpg') }})">
                <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                <div class="md:absolute bottom-0 left-0 w-full p-4 text-white ">
                    <h6 class="text-lg font-bold dark:text-white">Home Visits</h6>
                    <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                        Talk To Us
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
                        facility thrive and improve in patient care. Please talk to us so we can discuss how we
                        can reach your staffing needs.
                    </p>
                </div>
                <div>
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
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Job Type</label>
                            <select name="job_title" id="job_type"
                                class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 state"
                                data-parsley-errors-container="#state-error">
                                <option value="">Select...</option>
                                <option value="Administrative Assistant">Administrative
                                    Assistant</option>
                                <option value="Administrator">Administrator</option>
                                <option value="CEO/President/Owner">CEO/President/Owner</option>
                                <option value="Chief Clinical Officer (CCO)">Chief Clinical
                                    Officer (CCO)</option>
                                <option value="Chief Compliance Officer&nbsp;(CCO)">Chief
                                    Compliance Officer&nbsp;(CCO)</option>
                                <option value="Chief Financial Officer (CFO)">Chief Financial
                                    Officer (CFO)</option>
                                <option value="Chief Nursing Officer (CNO)">Chief Nursing
                                    Officer (CNO)</option>
                                <option value="Chief Operating Officer (COO)">Chief Operating
                                    Officer (COO)</option>
                                <option value="Director of Human Resources">Director of Human
                                    Resources</option>
                                <option value="Director of Nursing">Director of Nursing</option>
                                <option value="Executive Director">Executive Director</option>
                                <option value="Human Resources Manager">Human Resources Manager
                                </option>
                                <option value="Nurse">Nurse </option>
                                <option value="Nursing Assistant">Nursing Assistant</option>
                                <option value="Scheduler">Scheduler</option>
                                <option value="Staffing Coordinator">Staffing Coordinator
                                </option>
                                <option value="Talent Acquisition Specialist">Talent Acquisition
                                    Specialist</option>
                                <option value="Other">Other</option>
                            </select>
                            <div id="state-error"></div>
                        </div>
                        <div class="mb-5">
                            <label for="base-input" class="block mb-2 text-sm font-medium  dark:text-white">Do you work at
                                a single facility or corporate
                                headquarters?</label>
                            <select name="headquarter"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 state"
                                id="" required>
                                <option value="">Select...</option>
                                <option value="I work at a single facility">I work at a single
                                    facility</option>
                                <option value="I work at the corporate headquarters">I work at
                                    the corporate headquarters</option>
                            </select>
                        </div>
                        <button type="submit" type="button"
                            class="mx-auto lg:mx-2 hover:underline font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out bg-white text-gray-800">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
