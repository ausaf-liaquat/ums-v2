<nav id="header" class="fixed w-full z-30 top-0 text-white">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
        <div class="pl-4 flex items-center">
            <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                href="#">
                <img class="w-24" id="logoAuto" src="{{ asset('img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="block lg:hidden pr-4">
            <button id="nav-toggle"
                class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent lg:text-white md:text-black p-4 lg:p-0 z-20"
            id="nav-content">
            <ul class="list-reset lg:flex justify-end flex-1 items-center">
                <li class="mr-3">
                    <a class="inline-block py-2 px-4  font-bold no-underline" href="#">Home</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                        href="#">Services</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                        href="#">Careers</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                        href="#">About</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                        href="#">Contact Us </a>
                </li>
            </ul>
            @guest
                <a href="{{ route('register') }}" id="navAccount"
                    class="mx-auto lg:mx-2  hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">Register</a>
                <a href="{{ route('login') }}" id="navAccount"
                    class="mx-auto lg:mx-2  hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">Login</a>
            @endguest
            @auth
            <a href="{{ route('backend.dashboard') }}" id="navAccount"
            class="mx-auto lg:mx-2  hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">Dashboard</a>
            @endauth
            <button data-popover-target="popover-company-profile" type="button" id="navAction"
                class="mx-auto lg:mx-2 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">Start
                Today</button>

            <div data-popover id="popover-company-profile" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-80 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                <div class="p-3">
                    <div class="flex">
                        <div class="toggle-box rounded-lg w-96">
                            <!-- Nursing Professionals Section -->
                            <div class="bg-blue-100 p-4 rounded-lg mb-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('img/nursing.svg') }}" alt="Nursing Professionals"
                                        class="w-16 h-16 mr-4">
                                    <div>
                                        <h3 class="text-gray-700 text-lg">Nursing Professionals</h3>
                                        <button class="mt-2 bg-purple-500 text-white py-1 px-4 rounded">Join Our
                                            Team</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Nursing Facilities Section -->
                            <div class="bg-blue-100 p-4 rounded-lg">
                                <div class="flex items-center">
                                    <img src="{{ asset('img/facility.jpg') }}" alt="Nursing Facilities"
                                        class="w-16 h-16 mr-4">
                                    <div>
                                        <h3 class="text-gray-700 text-lg">Nursing Facilities</h3>
                                        <button class="mt-2 bg-purple-500 text-white py-1 px-4 rounded">Talk To
                                            Us</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-popper-arrow></div>
            </div>

            <!-- Box -->
        </div>
    </div>
    <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
</nav>
