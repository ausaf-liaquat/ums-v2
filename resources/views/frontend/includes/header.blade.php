<nav id="header" class="fixed w-full z-30 top-0">
    <div
        class="w-full container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl flex flex-wrap items-center justify-between py-2">
        <!-- Logo Section -->
        <div class="flex items-center">
            <a class="text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                href="{{ route('home') }}">
                <img class="w-24 lg:w-28 xl:w-32" id="logoAuto" src="{{ asset('img/logo.png') }}" alt="Logo">
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="block lg:hidden">
            <button id="nav-toggle"
                class="flex items-center p-1 text-black hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>

        <!-- Navigation Content -->
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-purple-600 lg:bg-transparent rounded-bl-[2rem] rounded-br-[2rem] lg:rounded-none p-4 lg:p-0 z-20"
            id="nav-content">

            <!-- Navigation Links -->
            <ul
                class="list-reset lg:flex justify-end flex-1 items-center space-y-2 lg:space-y-0 mt-3 lg:mt-0 mb-3 lg:mb-0 text-base lg:text-lg">
                <li class="lg:mr-4 xl:mr-6">
                    <a class="inline-block py-2 px-3 lg:px-4 hover:bg-white hover:rounded-tl-2xl hover:rounded-br-2xl hover:text-black transition-all duration-300 {{ request()->routeIs('home') ? 'font-extrabold' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="lg:mr-4 xl:mr-6">
                    <a class="inline-block py-2 px-3 lg:px-4 hover:bg-white hover:rounded-tl-2xl hover:rounded-br-2xl hover:text-black transition-all duration-300 {{ request()->routeIs('service') ? 'font-extrabold' : '' }}"
                        href="{{ route('service') }}">Services</a>
                </li>
                <li class="lg:mr-4 xl:mr-6">
                    <a class="inline-block py-2 px-3 lg:px-4 hover:bg-white hover:rounded-tl-2xl hover:rounded-br-2xl hover:text-black transition-all duration-300 {{ request()->routeIs('careers') ? 'font-extrabold' : '' }}"
                        href="{{ route('careers') }}">Careers</a>
                </li>
                <li class="lg:mr-4 xl:mr-6">
                    <a class="inline-block py-2 px-3 lg:px-4 hover:bg-white hover:rounded-tl-2xl hover:rounded-br-2xl hover:text-black transition-all duration-300 {{ request()->routeIs('about-us') ? 'font-extrabold' : '' }}"
                        href="{{ route('about-us') }}">About</a>
                </li>
                <li class="lg:mr-4 xl:mr-6">
                    <a class="inline-block py-2 px-3 lg:px-4 hover:bg-white hover:rounded-tl-2xl hover:rounded-br-2xl hover:text-black transition-all duration-300 {{ request()->routeIs('contact-us') ? 'font-extrabold' : '' }}"
                        href="{{ route('contact-us') }}">Contact Us</a>
                </li>
            </ul>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 lg:gap-2 xl:gap-4 items-center mt-4 lg:mt-0 lg:ml-6 xl:ml-8">
                @guest
                    <a href="{{ route('register') }}" id="navAccount"
                        class="w-full sm:w-auto text-center hover:underline bg-white text-gray-800 font-bold rounded-full py-2 lg:py-3 px-4 lg:px-6 xl:px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out text-sm lg:text-base whitespace-nowrap">
                        Register
                    </a>
                    <a href="{{ route('login') }}" id="navAccount"
                        class="w-full sm:w-auto text-center hover:underline bg-white text-gray-800 font-bold rounded-full py-2 lg:py-3 px-4 lg:px-6 xl:px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out text-sm lg:text-base whitespace-nowrap">
                        Login
                    </a>
                @endguest
                @auth
                    <a href="{{ route('backend.dashboard') }}" id="navAccount"
                        class="w-full sm:w-auto text-center hover:underline bg-white text-gray-800 font-bold rounded-full py-2 lg:py-3 px-4 lg:px-6 xl:px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out text-sm lg:text-base whitespace-nowrap">
                        Dashboard
                    </a>
                @endauth
                <button type="button" id="navAction"
                    class="mx-auto hover:underline bg-white text-gray-800 font-bold rounded-full py-2 px-5 md:px-8 lg:px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out whitespace-nowrap flex-shrink-0 text-sm">
                    Start Today
                </button>
                <div class="relative inline-block">
                    <!-- Popover Content -->
                    <div id="popover-content"
                        class="hidden absolute z-50 mt-6 text-sm text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm w-64 lg:w-80 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600 right-0 lg:left-0">
                        <div class="p-3 lg:p-4">
                            <div class="flex">
                                <div class="toggle-box rounded-lg w-full">
                                    <!-- Nursing Professionals Section -->
                                    <div class="bg-blue-100 p-3 lg:p-4 rounded-lg mb-3 lg:mb-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 lg:w-16 lg:h-16 mr-3 lg:mr-4 bg-purple-300 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-gray-700 text-sm lg:text-base">Nursing Professionals
                                                </h3>
                                                <a href="#"
                                                    class="mt-1 lg:mt-2 bg-purple-500 text-white py-1 px-3 lg:px-4 rounded text-sm lg:text-base whitespace-nowrap inline-block">
                                                    Join Our Team
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Nursing Facilities Section -->
                                    <div class="bg-blue-100 p-3 lg:p-4 rounded-lg">
                                        <div class="flex items-center">
                                            <div
                                                class="w-12 h-12 lg:w-16 lg:h-16 mr-3 lg:mr-4 bg-purple-300 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h3 class="text-gray-700 text-sm lg:text-base">Nursing Facilities</h3>
                                                <a href="#"
                                                    class="mt-1 lg:mt-2 bg-purple-500 text-white py-1 px-3 lg:px-4 rounded text-sm lg:text-base whitespace-nowrap inline-block">
                                                    Talk To Us
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Arrow -->
                        {{-- <div
                            class="absolute -top-2 left-1/2 transform -translate-x-1/2 w-4 h-4 rotate-45 bg-white border-t border-l border-gray-200">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
</nav>
