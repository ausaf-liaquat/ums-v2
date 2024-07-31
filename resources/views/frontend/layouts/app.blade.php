<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        @yield('title') Unique Med Services
    </title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Replace with your tailwind.css once created-->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <!-- Define your gradient here - use online tools to find a gradient matching your branding-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .gradient {
            background: linear-gradient(90deg, #1c64f2 0%, #a826ff 100%);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @vite(['resources/css/app-frontend.css', 'resources/js/app-frontend.js'])
    <style>
        .event {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 150px;
            bottom: 3px;
            left: calc(50% - 1.5px);
            content: " ";
            display: block;
            background: #9f19f8;
        }

        .event.busy {
            background: #f64747;
        }

        .highlighted-date {
            background-color: yellow;
        }

        /* p {
            color: #9f19f8;
            font-weight: 600;
            line-height: 25.6px;
        } */

        .flatpickr-calendar .flatpickr-innerContainer .flatpickr-rContainer .flatpickr-days .dayContainer .flatpickr-day.selected {
            background: #9f19f8;
            border-color: #9f19f8;
            color: #fff;
        }

        .flatpickr-calendar .flatpickr-innerContainer .flatpickr-rContainer .flatpickr-days .dayContainer .flatpickr-day.today {
            background-color: #eed4ff;
            border-color: #eed4ff;
            color: #9313e7;
        }

        .select2-results__option[aria-selected] {
            cursor: pointer;
            color: purple;
        }

        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none;
            color: blueviolet;
        }
        .parsley-errors-list {
            list-style: none;
            color: #9b0000;
            font-size: small;

        }
    </style>

</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">
    <!--Nav-->
    @include('frontend.includes.header')
    <!--Hero-->

    @yield('content')

    @include('frontend.includes.bottom-section')

    @include('frontend.includes.footer')

    {{-- <div>
        <p class="text-center p-3">Distributed By: <a href="https://themewagon.com/">Themewagon</a></p>
    </div> --}}
    <!-- jQuery if you need it
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  -->

    <script>
        var scrollpos = window.scrollY;
        var header = document.getElementById("header");
        var navcontent = document.getElementById("nav-content");
        var navaction = document.getElementById("navAction");
        var navAccount = document.getElementById("navAccount");
        var brandname = document.getElementById("brandname");
        var toToggle = document.querySelectorAll(".toggleColour");
        var logoAuto = document.getElementById("logoAuto");
        var lightLogo = "{{ asset('img/logo.png') }}";
        var darkLogo = "{{ asset('img/logo-dark.png') }}";

        document.addEventListener("scroll", function() {
            /*Apply classes for slide in bar*/
            scrollpos = window.scrollY;

            if (scrollpos > 10) {
                header.classList.add("backdrop-blur-md");
                header.classList.add("bg-white/30");

                navaction.classList.remove("bg-white");
                navaction.classList.add("gradient");
                navaction.classList.remove("text-gray-800");
                navaction.classList.add("text-white");
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-gray-800");
                    toToggle[i].classList.remove("text-white");
                }
                header.classList.add("shadow");
                navcontent.classList.remove("bg-gray-100");
                navcontent.classList.remove("gradient");
                // navcontent.classList.remove("lg:text-white");
                // navcontent.classList.add("md:text-black");
                navcontent.classList.add("text-purple-500");

                logoAuto.src = darkLogo;
            } else {
                header.classList.remove("backdrop-blur-md");
                header.classList.remove("bg-white/30");
                navaction.classList.remove("gradient");
                navaction.classList.add("bg-white");
                navaction.classList.remove("text-white");
                navaction.classList.add("text-gray-800");
                //Use to switch toggleColour colours
                for (var i = 0; i < toToggle.length; i++) {
                    toToggle[i].classList.add("text-white");
                    toToggle[i].classList.remove("text-gray-800");
                }

                header.classList.remove("shadow");
                navcontent.classList.add("gradient");
                navcontent.classList.add("bg-gray-100");
                // navcontent.classList.remove("");
                navcontent.classList.remove("text-purple-500");
                logoAuto.src = lightLogo;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script>
        /*Toggle dropdown list*/
        /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

        var navMenuDiv = document.getElementById("nav-content");
        var navMenu = document.getElementById("nav-toggle");

        document.onclick = check;

        function check(e) {
            var target = (e && e.target) || (event && event.srcElement);

            //Nav Menu
            if (!checkParent(target, navMenuDiv)) {
                // click NOT on the menu
                if (checkParent(target, navMenu)) {
                    // click on the link
                    if (navMenuDiv.classList.contains("hidden")) {
                        navMenuDiv.classList.remove("hidden");
                    } else {
                        navMenuDiv.classList.add("hidden");
                    }
                } else {
                    // click both outside link and outside menu, hide menu
                    navMenuDiv.classList.add("hidden");
                }
            }
        }

        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('script')

</body>

</html>
