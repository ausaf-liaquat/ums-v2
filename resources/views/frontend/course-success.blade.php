@extends('frontend.layouts.app')

@section('title')
    Courses |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Courses</h1>
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
                    <li class="inline-flex items-center">
                        <a class="flex items-center text-gray-600 text-xs lg:text-sm" href="{{ route('service') }}">Services
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
                        Courses
                    </li>
                </ol>
            </div>
        </div>


    </section>

    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Courses
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <table class="main w-full" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="content-wrap text-center p-4">
                                <table class="w-full text-black" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="content-block">
                                                <h2 class="text-2xl font-semibold">You have successfully purchased this
                                                    course</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block">
                                                <table class="invoice w-full mx-auto my-4 border-collapse">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2">
                                                                {{ $user->full_name }}<br>
                                                                #{{ $order->order_number }}<br>
                                                                {{ $order->created_at->format('m/d/Y') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    class="invoice-items w-full border-t border-b border-gray-200"
                                                                    cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="py-2">{{ $course->name }}</td>
                                                                            <td class="text-right py-2">
                                                                                ${{ number_format($order->grand_total, 2) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="total">
                                                                            <td class="text-right py-2" width="80%">Total
                                                                            </td>
                                                                            <td class="text-right py-2">
                                                                                ${{ number_format($order->grand_total, 2) }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

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
