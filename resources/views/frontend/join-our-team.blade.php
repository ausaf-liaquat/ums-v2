@extends('frontend.layouts.app')

@section('title')
    Join Our Team |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem] mt-16  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Join Our Team</h1>
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
                        Join Our Team
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
                Our Join Our Team
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
        </div>
        <div class="container mx-auto max-w-[85rem] grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 pb-12 px-3">

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
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Ready to have a flexible nursing career?
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <p class="text-gray-700 mb-6 mx-auto p-5">Time to take control of your career and life. Start your UMA staffing
                application and you’ll be ready to have a great nursing career. </p>




        </div>
        <figure class="max-w-screen-md mx-auto text-center">
            <svg class="w-10 h-10 mx-auto mb-3 text-gray-400 dark:text-gray-600" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 14">
                <path
                    d="M6 0H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3H2a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Zm10 0h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4v1a3 3 0 0 1-3 3h-1a1 1 0 0 0 0 2h1a5.006 5.006 0 0 0 5-5V2a2 2 0 0 0-2-2Z" />
            </svg>
            <blockquote>
                <p class="text-2xl italic font-medium text-gray-900 p-5 dark:text-white">"UMA staffing has help me take
                    control of my career, time and life"</p>
            </blockquote>

        </figure>
    </section>
    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
