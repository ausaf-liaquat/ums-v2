@extends('frontend.layouts.app')

@section('title')
    Contact Us |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Contact Us</h1>
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
                        Contact Us
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto max-w-[85rem]  pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Contact Us
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="flex flex-col text-center w-full mb-12">
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn
                    asymmetrical gentrify.</p>
            </div>
            @session('success')
                <div class="p-4 w-1/2 mx-auto mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                    role="alert">
                    {{ session()->get('success') }}.
                </div>
            @endsession


            <div class="grid grid-cols-1 p-5 md:w-2/3  md:grid-cols-4 mx-auto gap-2">
                <div>
                    <div
                        class="bg-white rounded-lg shadow-lg p-6 flex h-full flex-col items-center hover:shadow-md hover:shadow-purple-500">
                        <div class="bg-green-100 p-4 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h2a1 1 0 011 1v6a1 1 0 001 1h10a1 1 0 001-1v-6a1 1 0 011-1h2M10 10v-1a3 3 0 013-3V6a3 3 0 013 3v1M7 13h10" />
                            </svg>
                        </div>
                        <div class=" font-bolder text-gray-900 mb-2">9415291867</div>
                        <div class="text-gray-500">Text Us 9am-5pm (Mountain Standard Time)

                        </div>
                    </div>
                </div>
                <div>
                    <div
                        class="bg-white rounded-lg shadow-lg p-6 flex h-full flex-col items-center hover:shadow-md hover:shadow-purple-700">
                        <div class="bg-purple-100 p-4 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 12H8m8 0a4 4 0 01-8 0 4 4 0 018 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 10h2a1 1 0 011 1v6a1 1 0 001 1h10a1 1 0 001-1v-6a1 1 0 011-1h2M7 13h10" />
                            </svg>
                        </div>
                        <div class=" font-bolder text-gray-900 mb-2">info@uniquemedsvcs.com</div>
                        <div class="text-gray-500"> Email Us 24/7</div>
                    </div>
                </div>
                <div>
                    <div
                        class="bg-white rounded-lg shadow-lg p-6 flex h-full flex-col items-center hover:shadow-md hover:shadow-purple-700">
                        <div class="bg-blue-100 p-4 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                            </svg>
                        </div>
                        <div class=" font-bolder text-gray-900 mb-2">9 AM to 5 PM</div>
                        <div class="text-gray-500">Open Hours</div>
                    </div>
                </div>
                <div>
                    <div
                        class="bg-white rounded-lg shadow-lg p-6 flex h-full flex-col items-center hover:shadow-md hover:shadow-purple-700">
                        <div class="bg-red-100 p-4 rounded-full mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16z" />
                            </svg>
                        </div>
                        <div class=" font-bolder text-gray-900 mb-2">514 Americas Way PMB 22605 Box Elder, SD 57719</div>
                        <div class="text-gray-500">Our Location</div>
                    </div>
                </div>
            </div>

              <form action="{{ route('contact-us.store') }}" class="p-5" method="post">
                @csrf
                <div class="md:w-2/3 mx-auto shadow-lg rounded-lg p-5 hover:shadow-md hover:shadow-purple-700">
                    <div class="flex flex-wrap -m-2">
                        <!-- Name Input -->
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out {{ $errors->has('name') ? 'border-red-500' : '' }}"
                                    placeholder="Enter your name" required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out {{ $errors->has('email') ? 'border-red-500' : '' }}"
                                    placeholder="Enter your email" required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number Input -->
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="phoneNumber" class="block mb-2 text-sm font-medium text-gray-600">Phone
                                    no</label>
                                <input type="tel" id="phoneNumber" name="contact_no" value="{{ old('contact_no') }}"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out {{ $errors->has('contact_no') ? 'border-red-500' : '' }}"
                                    placeholder="Enter your phone" required>
                                @error('contact_no')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Contact Type Dropdown -->
                        <div class="p-2 w-1/2">
                            <div class="relative">
                                <label for="type" class="block mb-2 text-sm font-medium text-gray-600">Contact
                                    Type</label>
                                <select name="type"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out {{ $errors->has('type') ? 'border-red-500' : '' }}">
                                    <option value="" disabled selected>Select Contact Type</option>
                                    <option value="Staffing" {{ old('type') == 'Staffing' ? 'selected' : '' }}>Staffing
                                    </option>
                                    <option value="Online Course" {{ old('type') == 'Online Course' ? 'selected' : '' }}>
                                        Online Course</option>
                                    <option value="Medical Supplies"
                                        {{ old('type') == 'Medical Supplies' ? 'selected' : '' }}>Medical Supplies</option>
                                    <option value="Medical Uniforms"
                                        {{ old('type') == 'Medical Uniforms' ? 'selected' : '' }}>Medical Uniforms</option>
                                    <option value="Medical coding and billing"
                                        {{ old('type') == 'Medical coding and billing' ? 'selected' : '' }}>Medical coding
                                        and billing</option>
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Message Textarea -->
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                                <textarea id="message" name="message"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out {{ $errors->has('message') ? 'border-red-500' : '' }}"
                                    placeholder="Enter your message" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @error('g-recaptcha-response')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        {!! RecaptchaV3::field('contact_us') !!}

                        <!-- Submit Button -->
                        <div class="p-2 w-full">
                            <button type="submit"
                                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection

@section('script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
