@extends('frontend.layouts.app')

@section('title')
@endsection

@section('content')
    <div class="pt-32">
        <div class="container px-3 mx-auto max-w-[87rem] flex flex-wrap flex-col md:flex-row items-center">
            <!--Left Col-->
            <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
                <p class="uppercase tracking-loose w-full">Looking for?</p>
                <h1 class="my-4 text-5xl font-bold leading-tight animate-fadeIn">
                    MEDICAL SERVICES
                </h1>
                <p class="leading-normal text-2xl mb-8 animate-fadeIn">
                    Our company is a one stop shop for all medical facilities nationwide. We provide services to keep your
                    facility running smoothly so you can focus on what is most important, patient care.
                </p>
                <a href="{{ route('service') }}"
                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out animate-fadeIn">
                    Services
                </a>
            </div>
            <!--Right Col-->
            <div class="w-full md:w-3/5 py-6 text-center animate-fadeIn">
                <img class="w-full md:w-4/5 z-50 rounded-lg float-end" src="{{ asset('img/img-5.jpg') }}" />
            </div>
        </div>
    </div>
    <div class="relative -mt-12 lg:-mt-24">
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
    </div>
    <section class="bg-white border-b py-8">

        <div class="flex flex-wrap">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Our Services
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
        </div>
        <div class="container mx-auto max-w-[85rem] grid grid-cols-1 md:grid-cols-3 gap-4 pt-4 pb-12 px-3">

            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img-7.jpg') }})">
                <a href="{{ route('join-our-team') }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                    <div class="absolute inset-0 flex items-end p-4">
                        <div class="w-full p-4 backdrop-blur-md bg-white/50 rounded-lg text-gray-800">
                            <h6 class="text-lg font-bold dark:text-white text-center">STAFFING</h6>
                            {{-- <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p> --}}
                        </div>
                    </div>
                </a>
            </div>

            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img-9.jpg') }})">
                <a href="{{ route('courses') }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                    <div class="absolute inset-0 flex items-end p-4">
                        <div class="w-full p-4 backdrop-blur-md bg-white/50 rounded-lg text-gray-800">
                            <h6 class="text-lg font-bold dark:text-white text-center">COURSES</h6>
                            {{-- <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p> --}}
                        </div>
                    </div>
                </a>
            </div>
            <div class="relative w-full bg-cover md:w-full bg-center rounded-lg h-96 animate-fadeIn"
                style="background-image: url({{ asset('img/img-10.jpg') }})">
                <a href="{{ route('medical-supplies') }}">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#9061f952] rounded-lg"></div>
                    <div class="absolute inset-0 flex items-end p-4">
                        <div class="w-full p-4 backdrop-blur-md bg-white/50 rounded-lg text-gray-800">
                            <h6 class="text-lg font-bold dark:text-white text-center">MEDICAL SUPPLIES</h6>
                            {{-- <p class="text-lg">Lorem ipsum dolor sit amet, consec adipiscing elit.</p> --}}
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section class="bg-white border-b py-8">
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">

            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Courses
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            @php
                $courses = App\Models\Courses\Course::whereStatus(1)->take(4)->get();
            @endphp
            @foreach ($courses as $course)
                <div class=" w-full md:w-1/4 p-6 flex flex-col flex-grow flex-shrink">
                    <div
                        class="relative left-0 top-0 flex-1 bg-white rounded-[2rem] hover:border-2 border-purple-500 overflow-hidden shadow-xl">

                        @if ($course->type == 0)
                            <div
                                class="bg-gray-900 absolute transform -rotate-45 text-center text-white font-semibold py-1 left-[-34px] top-[32px] w-[170px]">
                                OFFLINE
                            </div>
                        @elseif($course->type == 1)
                            <div
                                class="bg-green-500 absolute transform -rotate-45 text-center text-white font-semibold py-1 left-[-34px] top-[32px] w-[170px]">
                                ONLINE
                            </div>
                        @else
                            <div
                                class="bg-red-500 absolute transform -rotate-45 text-center text-white font-semibold py-1 left-[-34px] top-[32px] w-[170px]">
                                OFFLINE / ONLINE
                            </div>
                        @endif


                        <a href="{{ route('courses') }}" class="flex flex-wrap no-underline hover:no-underline">

                            <img class="lg:h-[350px] md:h-[350px] mx-auto"
                                src="{{ Storage::disk('cms')->url($course->image) }}" alt="">

                            <div class="w-full font-bold text-xl mt-5 text-gray-800 px-6 mb-5">
                                {{ Str::limit($course->name, 24) }}
                            </div>
                            {{-- <p class="text-gray-800 text-base px-6 mb-5">
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo
                          posuere et sit amet ligula.
                      </p> --}}

                        </a>
                    </div>
                    {{-- <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-xl p-6">
                        <div class="flex items-center justify-start">
                            <button
                                class="mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                                Action
                            </button>
                        </div>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
