@extends('frontend.layouts.app')

@section('title')
    Services |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Services</h1>
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
                        Services
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
                Our Services
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
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Services
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-5">
                <div>
                    <figure class="relative max-w-full transition-all duration-300 cursor-pointer filter">
                        <a href="#">
                            <img class="rounded-lg" src="{{ asset('img/img-7.jpg') }}" alt="image description">
                        </a>
                        <figcaption
                            class="absolute px-4 text-lg text-white bottom-6 rounded-e-lg bg-purple-600 font-extrabold">
                            <p>STAFFING</p>
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-full transition-all duration-300 cursor-pointer filter">
                        <a href="{{ route('courses') }}">
                            <img class="rounded-lg" src="{{ asset('img/img-9.jpg') }}" alt="image description">

                            <figcaption
                                class="absolute px-4 text-lg text-white bottom-6 rounded-e-lg bg-purple-600 font-extrabold">
                                <p>COURSES</p>
                            </figcaption>
                        </a>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-full transition-all duration-300 cursor-pointer filter">
                        <a href="#">
                            <img class="rounded-lg" src="{{ asset('img/img-10.jpg') }}" alt="image description">
                        </a>
                        <figcaption
                            class="absolute px-4 text-lg text-white bottom-6 rounded-e-lg bg-purple-600 font-extrabold">
                            <p class="uppercase">Medical Supplies</p>
                        </figcaption>
                    </figure>
                </div>
                <div>
                    <figure class="relative max-w-full transition-all duration-300 cursor-pointer filter">
                        <a href="#">
                            <img class="rounded-lg" src="{{ asset('img/img-11.jpg') }}" alt="image description">
                        </a>
                        <figcaption
                            class="absolute px-4 text-lg text-white bottom-6 rounded-e-lg bg-purple-600 font-extrabold">
                            <p class="uppercase"> Medical Uniform</p>
                        </figcaption>
                    </figure>
                </div>

                <div>
                    <figure class="relative max-w-full transition-all duration-300 cursor-pointer filter">
                        <a href="#">
                            <img class="rounded-lg" src="{{ asset('img/img-12.jpg') }}" alt="image description">
                        </a>
                        <figcaption
                            class="absolute px-4 text-lg text-white bottom-6 rounded-e-lg bg-purple-600 font-extrabold">
                            <p>Medical Coding and billing (Comming Soon)</p>
                        </figcaption>
                    </figure>
                </div>
            </div>

        </div>
    </section>
    <section class=" py-8">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12 ">
            <div class="flex flex-col md:flex-row">
                <!-- First Column -->
                <div class="flex-1 p-4">
                    <div class="animate-fadeIn">
                        <div
                            class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px]">
                            <div
                                class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[72px] rounded-s-lg">
                            </div>
                            <div
                                class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg">
                            </div>
                            <div
                                class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg">
                            </div>
                            <div
                                class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg">
                            </div>
                            <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-800">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/mockup-1-light.png"
                                    class="dark:hidden w-[272px] h-[572px]" alt="">
                                <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/mockup-1-dark.png"
                                    class="hidden dark:block w-[272px] h-[572px]" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="flex-1 p-4">

                    <div class="bg-white h-full p-8 rounded-xl shadow-lg animate-fadeIn">
                        <div class="text-purple-500 font-bold uppercase mb-2">OUR APP</div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">Your Healthcare at Your Fingertips</h1>
                        <p class="text-gray-700 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit
                            tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Curabitur vitae lorem purus. Nunc
                            vel metus id ante semper mattis.</p>


                        <div class="flex items-center mb-6">

                            <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span>Individual configuration</span>
                                </li>
                                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span>No setup, or hidden fees</span>
                                </li>
                                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span>Team size: <span class="font-semibold text-gray-900 dark:text-white">1
                                            developer</span></span>
                                </li>
                                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span>Premium support: <span class="font-semibold text-gray-900 dark:text-white">6
                                            months</span></span>
                                </li>
                                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 16 12">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                    </svg>
                                    <span>Free updates: <span class="font-semibold text-gray-900 dark:text-white">6
                                            months</span></span>
                                </li>
                            </ul>

                        </div>

                        <div class="flex items-center justify-center">
                            <div>
                                <h2 class="text-3xl text-white font-extrabold my-3 text-center">Get the app</h2>
                                <div class="flex flex-col gap-2 p-2 md:flex-row w-full">
                                    <a type="button"
                                        class="flex items-center justify-center w-48 mb-3 text-white bg-black h-14 rounded-xl">
                                        <div class="mr-3">
                                            <svg viewBox="0 0 384 512" width="30">
                                                <path fill="currentColor"
                                                    d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs">
                                                Download on the
                                            </div>
                                            <div class="-mt-1 font-sans text-xl font-semibold">
                                                App Store
                                            </div>
                                        </div>
                                    </a>

                                    <a type="button"
                                        class="flex items-center justify-center w-48 text-white bg-black rounded-lg h-14">
                                        <div class="mr-3">
                                            <svg viewBox="30 336.7 120.9 129.2" width="30">
                                                <path fill="#FFD400"
                                                    d="M119.2,421.2c15.3-8.4,27-14.8,28-15.3c3.2-1.7,6.5-6.2,0-9.7  c-2.1-1.1-13.4-7.3-28-15.3l-20.1,20.2L119.2,421.2z">
                                                </path>
                                                <path fill="#FF3333"
                                                    d="M99.1,401.1l-64.2,64.7c1.5,0.2,3.2-0.2,5.2-1.3  c4.2-2.3,48.8-26.7,79.1-43.3L99.1,401.1L99.1,401.1z">
                                                </path>
                                                <path fill="#48FF48"
                                                    d="M99.1,401.1l20.1-20.2c0,0-74.6-40.7-79.1-43.1  c-1.7-1-3.6-1.3-5.3-1L99.1,401.1z">
                                                </path>
                                                <path fill="#3BCCFF"
                                                    d="M99.1,401.1l-64.3-64.3c-2.6,0.6-4.8,2.9-4.8,7.6  c0,7.5,0,107.5,0,113.8c0,4.3,1.7,7.4,4.9,7.7L99.1,401.1z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs">
                                                GET IT ON
                                            </div>
                                            <div class="-mt-1 font-sans text-xl font-semibold">
                                                Google Play
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="bg-white py-8">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12 ">
            <div class="flex flex-col md:flex-row">
                <!-- First Column -->
                <div class="flex-1 p-4">
                    <div class="animate-fadeIn">
                        <!-- Bottom card -->
                        <div
                            class=" top-10 left-10 bg-cover bg-center w-full h-full bg-gradient-to-br from-[#a826ff] to-[#9f19f840] rounded-lg">
                        </div>

                        <!-- Top card -->
                        {{-- <div class=" bg-white rounded-lg shadow-lg overflow-hidden">
                            <img class="w-full object-cover" src="{{ asset('img/img-4.jpg') }}" alt="Doctors">
                        </div> --}}
                        <!-- card goes here -->
                        <div class="relative">
                            <!-- yellow background -->
                            <div
                                class="absolute -right-4 -bottom-4 bg-gradient-to-br from-[#a826ff] to-[#9f19f840]  h-full w-full rounded-xl">
                            </div>

                            {{-- <div class=" bg-white rounded-lg shadow-lg overflow-hidden">

                          </div> --}}
                            <div class="relative  text-gray-50 rounded-xl  space-y-7">
                                <!-- yellow line -->
                                <img class="w-full rounded-xl object-cover" src="{{ asset('img/img-4.jpg') }}"
                                    alt="Doctors">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="flex-1 p-4">

                    <div class="bg-white h-full p-8 rounded-xl shadow-lg animate-fadeIn">
                        <div class="text-purple-500 font-bold uppercase mb-2">About Us</div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-4">Committed to Health,<br>Committed to You</h1>
                        <p class="text-gray-700 mb-6">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit
                            tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo. Curabitur vitae lorem purus. Nunc
                            vel metus id ante semper mattis.</p>

                        <blockquote class="border-l-4 border-purple-500 pl-4 italic text-gray-700 mb-6">
                            “Healthcare that Has Your Back, and Front, and Sides. Lorem ipsum dolor sit amet, adipiscing
                            elit.”
                        </blockquote>

                        <div class="flex items-center mb-6">
                            <img class="w-12 h-12 rounded-full mr-4" src="{{ asset('assets/assets/img/avatars/5.png') }}"
                                alt="Author">
                            <div>
                                <p class="font-bold text-gray-900">Alan Lawson</p>
                                <p class="text-gray-600">Senior Doctor</p>
                            </div>
                            <img class="ml-auto h-8 rounded-xl" src="{{ asset('assets/assets/img/avatars/5.png') }}"
                                alt="Signature">
                        </div>

                        <a href="#"
                            class="bg-purple-500 text-white font-bold py-2 px-4 rounded hover:bg-purple-600 transition duration-300">Learn
                            More</a>
                    </div>
                </div>
            </div>
        </div>

    </section>




    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
