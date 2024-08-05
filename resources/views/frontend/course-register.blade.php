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
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                {{ $course->name }}
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient mb-4 w-64 opacity-25 my-0 py-0 rounded-t"></div>


                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div>
                        <div class="pb-5 pt-lg-5 text-lg-start text-center">
                            <h3 class="mt-md-3 text-black font-extrabold uppercase">Select a Date and Time</h3>

                            {{-- <input class="form-control calendarPick " type="hidden"
                                placeholder="Select Date.."> --}}
                            <div class="flex justify-center">
                                <div>
                                    <input type="date" class="form-control" name="date" id="calendarPick"
                                        value="" required readonly style="display: none;">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class=" pb-5 pt-lg-5 text-lg-start text-center">
                            <h3 class="mt-md-3 text-black font-extrabold uppercase">Availability</h3>
                            <div class="mt-md-5 availability grid grid-cols-2 md:grid-cols-2 gap-4 place-items-center">

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="about-right pb-5 pt-lg-5 text-lg-start text-center">
                            <h3 class="mt-md-3 text-black font-extrabold uppercase">Course Details</h3>
                            <div class="mt-md-5 service_details">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
        integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"
        integrity="sha512-K/oyQtMXpxI4+K0W7H25UopjM8pzq0yrVdFdG21Fh5dBe91I40pDd9A4lzNlHPHBIP2cwZuoxaUSX0GJSObvGA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            let course_id = "{{ $course->id }}"
            let course_price = parseFloat("{{ $course->price }}")
            let course_name = "{{ $course->name }}"
            let course_zip_code = "{{ $course->zip_code }}"
            let course_city = "{{ $course->city?->name }}"
            let course_state = "{{ $course->state?->name }}"
            let course_slug = "{{ $course->slug }}"

            // Define your event data
            var dates = {!! json_encode($databaseDates) !!};
            console.log(dates, 'fds');
            flatpickr('#calendarPick', {
                inline: true,
                altInput: true,
                // altFormat: "F j, Y",
                // dateFormat: "Y-m-d",
                minDate: "today",
                // defaultDate: "{{ now() }}"
                // enableTime: false,
                // noCalendar: false,
                // inline: true,
                dateFormat: "Y-m-d",
                // altInput: true,
                // altFormat: "Y-m-d",
                // enable: dates,
                altInputClass: "invisible",

                onDayCreate: function(dateObj, dStr, fp, dayElem) {

                    var month = (dayElem.dateObj.getMonth() + 1).toString().padStart(2, '0');
                    var day = (dayElem
                        .dateObj.getDate()).toString().padStart(2, '0');
                    var formattedDate = dayElem.dateObj.getFullYear() + '-' + month + '-' + day;
                    var timezoneOffset = dayElem.dateObj.getTimezoneOffset() *
                        60000; // Convert minutes to milliseconds
                    var adjustedDate = new Date(dayElem.dateObj.getTime() - timezoneOffset);
                    if (dates.includes(formattedDate)) {
                        dayElem.innerHTML += "<span class='event'></span>";
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    // console.log(selectedDates,dateStr,'hfghfgh');
                    // Make a request to your API using Axios
                    const dateS = new Date(dateStr);

                    const options = {
                        month: 'long',
                        day: 'numeric',
                        year: 'numeric'
                    };
                    const formattedDate = dateS.toLocaleDateString('en-US', options);
                    axios.get('{{ route('course.get-dates') }}', {
                            params: {
                                date: dateStr,
                                course_id: course_id
                            }
                        })
                        .then(function(res) {

                            // Handle the response from the server
                            if (res.data.event) {
                                let btnStatus = '';
                                let timeHtml = ''
                                let servicesDetails = ''
                                let msg = ''
                                res.data.event.forEach(element => {
                                    let time = element.datetime.split(' ')[1];
                                    let slots = element.slot
                                    timeHtml += `
                                   <div>
                                     <div class="mt-4 w-48 cursor-pointer" style="
                                        border: 1px solid #9f19f8;
                                        background: #f5f8f9;
                                        color: #9e19f7;
                                        padding: 8px;
                                        text-align: center;
                                        font-weight: 600;
                                      "  >
                                          ${convertTo12HourFormat(time)}
                                      </div>
                                    </div>
                                  `;
                                    let bookedSlots = element.user_courses_count
                                    var checkoutRoute =
                                        '{{ route('course.checkout', ['slug' => ':slug', 'course_schedule' => ':course_schedule']) }}';
                                    checkoutRoute = checkoutRoute.replace(':slug',
                                        course_slug);
                                    checkoutRoute = checkoutRoute.replace(
                                        ':course_schedule', element.id);
                                    if (slots === bookedSlots) {
                                        msg =
                                            `<p class="text-danger"><i class="fas fa-danger"></i> Slots for this course has been full</p>`

                                    } else {
                                        btnStatus =
                                            ` <a href="${checkoutRoute}" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium mb-5 rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2" style="border-radius:0px;">Next</a>`
                                    }
                                    servicesDetails += `
                                        <p class="mt-5">${course_name}</p>
                                        <p>${element.course.description}</p>
                                        <p>${element.course.address}</p>
                                        <p>${formattedDate} at ${convertTo12HourFormat(time)}</p>
                                        <p>${course_price.toLocaleString('en-US', {
                                            style: 'currency',
                                            currency: 'USD',
                                            minimumFractionDigits: 0,
                                            maximumFractionDigits: 0
                                            })}</p>
                                        <br>
                                        ${msg}
                                      ${btnStatus}
                                    `

                                });
                                $('.service_details').empty().fadeIn().append(servicesDetails);
                                $('.availability').empty().fadeIn().append(timeHtml)
                            } else {
                                $('.availability').empty().fadeIn().append(`
                                    <p class="mt-4 ">
                                      No availability
                                    </p>
                                  `);
                                $('.service_details').empty().fadeIn().append(`
                              <p>${course_name}</p>
                              <p>${course_price.toLocaleString('en-US', {
                              style: 'currency',
                              currency: 'USD',
                              minimumFractionDigits: 0,
                              maximumFractionDigits: 0
                              })}</p>
                              <br>
                              <a class="btn btn-primary w-75 disabled" style="border-radius:0px;">Next</a>
                          `);
                            }

                        })
                        .catch(function(error) {
                            console.error(error);
                        });

                },

            });

            // function checkDateInDatabase(date, databaseDates) {
            //     const formattedDate = date.toISOString().split('T')[0];
            //     console.log(databaseDates, formattedDate);
            //     // Perform your logic to check if the date exists in the databaseDates array
            //     return databaseDates.includes(formattedDate);
            // }
            function convertTo12HourFormat(time24) {
                const [hours, minutes] = time24.split(':');
                let period = 'AM';
                let hours12 = parseInt(hours, 10);

                if (hours12 >= 12) {
                    period = 'PM';
                    if (hours12 > 12) {
                        hours12 -= 12;
                    }
                } else if (hours12 === 0) {
                    hours12 = 12;
                }

                return `${hours12}:${minutes} ${period}`;
            }
        })
    </script>
@endsection
