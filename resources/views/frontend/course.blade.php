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
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Courses
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>


            <div class="grid grid-cols-1 w-full p-4 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($courses as $course)
                    <div>
                        <div class="w-full">
                           
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


                                <a href="{{ route('courses.register', ['slug' => $course->slug]) }}"
                                    class="flex flex-wrap no-underline hover:no-underline">

                                    <img class="h-[350px] mx-auto" src="{{ Storage::disk('cms')->url($course->image) }}"
                                        alt="">

                                    <div class="w-full font-bold text-xl mt-5 text-gray-800 px-6 mb-5">
                                        {{ Str::limit($course->name, 24) }}
                                    </div>

                                    {{-- <p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">
                                      {{ Str::limit($course->description, 31) }}
                                    </p> --}}
                                    {{-- <p class="text-gray-800 text-base px-6 mb-5">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam at ipsum eu nunc commodo
                                        posuere et sit amet ligula.
                                    </p> --}}

                                </a>
                                <div class="flex flex-col items-center pb-10">

                                    <div class="flex">
                                        <a href="{{ route('courses.register', ['slug' => $course->slug]) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-yellow-400 rounded-lg hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-yellow-400 dark:hover:bg-yellow-400 dark:focus:ring-yellow-400">
                                            Register</a>
                                        <a href="{{ route('login') }}"
                                            class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Login</a>
                                    </div>
                                </div>
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
                        {{-- <div
                            class="max-w-sm bg-white border border-gray-200 hover:shadow-md hover:shadow-purple-500 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="rounded-t-lg h-40 w-full" src="{{ Storage::disk('cms')->url($course->image) }}"
                                    alt="" />
                            </a>
                            <div class="p-5 h-44">
                                <a href="#">
                                    <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ Str::limit($course->name, 24) }}</h5>
                                    @if ($course->type == 0)
                                        <span
                                            class="rounded-full bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5  dark:bg-gray-700 dark:text-gray-300">Offline</span>
                                    @elseif($course->type == 1)
                                        <span
                                            class="rounded-full bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5  dark:bg-green-900 dark:text-green-300">Online</span>
                                    @else
                                        <span
                                            class="rounded-full bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5  dark:bg-gray-700 dark:text-gray-300">Offline</span>
                                        / <span
                                            class="rounded-full bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5  dark:bg-green-900 dark:text-green-300">Online</span>
                                    @endif
                                </a>
                                <p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">
                                    {{ Str::limit($course->description, 31) }}
                                </p>
                                <div class="flex flex-col items-center pb-10">

                                    <div class="flex">
                                        <a href="{{ route('courses.register', ['slug' => $course->slug]) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800">
                                            Register</a>
                                        <a href="{{ route('login') }}"
                                            class="py-2 px-4 ms-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Login</a>
                                    </div>
                                </div>
                            </div>

                        </div> --}}

                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
