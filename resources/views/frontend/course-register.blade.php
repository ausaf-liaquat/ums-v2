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
                {{ $course->name }}
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient mb-4 w-64 opacity-25 my-0 py-0 rounded-t"></div>


                <div class="grid grid-cols-1 md:grid-cols-3 p-4 gap-4">
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
                            <div class="mt-8 availability grid grid-cols-1 md:grid-cols-2 gap-4 place-items-center">

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="about-right pb-5 pt-lg-5 text-lg-start text-center">
                            <h3 class="mt-md-3 text-black font-extrabold uppercase">Course Details</h3>
                            <div class="mt-10 service_details text-purple-600">

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
                                let msg = `
                                <div
                                  class="relative inline-flex rounded-full items-center justify-start py-3 pl-4 pr-12 overflow-hidden font-semibold bg-indigo-50 text-indigo-600 transition-all duration-150 ease-in-out hover:pl-10 hover:pr-6 hover:bg-indigo-100 group">

                                  <span class="absolute right-0 pr-4 duration-200 ease-out group-hover:translate-x-12">
                                    <svg class="w-5 h-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                      height="24" viewBox="0 0 24 24" fill="none">
                                      <path
                                        d="M14.9385 6L20.9999 12.0613M20.9999 12.0613L14.9385 18.1227M20.9999 12.0613L3 12.0613"
                                        stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    </svg>
                                  </span>
                                  <span
                                    class="absolute left-0 pl-2.5 -translate-x-12 group-hover:translate-x-0 ease-out duration-200">
                                    <svg class="w-5 h-5 text-indigo-700" xmlns="http://www.w3.org/2000/svg" width="24"
                                      height="24" viewBox="0 0 24 24" fill="none">
                                      <path
                                        d="M14.9385 6L20.9999 12.0613M20.9999 12.0613L14.9385 18.1227M20.9999 12.0613L3 12.0613"
                                        stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    </svg>
                                  </span>
                                  <span
                                    class="relative w-full text-left transition-colors duration-200 ease-in-out group-hover:text-indigo-700">Next</span>
                                </div>
                                `
                                res.data.event.forEach(element => {
                                    let time = element.datetime.split(' ')[1];
                                    let slots = element.slot
                                    timeHtml += `
                                   <div class="w-full">

                                    <div class="flex justify-center text-purple-600 bg-purple-50 px-3 py-1.5 tracking-wide rounded-lg">
                                      <svg class=" h-6 w-6 mr-2 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>



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
                                        msg = `
                                            <div class="p-4 mb-4 text-sm text-red-500 rounded-xl bg-red-50 font-normal mt-4" role="alert">
                                            <span class="font-semibold mr-2">Danger</span>Slots for this course has been full
                                            </div>
                                            `

                                    }
                                    servicesDetails += `
                                    <a href="${slots === bookedSlots?'#':checkoutRoute}"
                                      class="relative block overflow-hidden rounded-lg mt-4 mb-4 border border-gray-100 p-4 sm:p-6 lg:p-8">
                                      <span
                                      class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>

                                      <div class="sm:flex sm:justify-between sm:gap-4">
                                          <div>
                                              <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
                                                  ${course_name} | ${course_price.toLocaleString('en-US', {
                                                  style: 'currency',
                                                  currency: 'USD',
                                                  minimumFractionDigits: 0,
                                                  maximumFractionDigits: 0
                                                  })}
                                              </h3>


                                          </div>

                                          <div class="hidden sm:block sm:shrink-0">
                                              <img alt="" src="{{ Storage::disk('cms')->url('') }}/${element.course.image}"
                                                  class="size-16 rounded-lg object-cover shadow-sm" />
                                          </div>
                                      </div>

                                      <div class="p-4 mb-4 mt-4 text-sm text-indigo-600 rounded-xl bg-indigo-50 font-normal" role="alert">
                                      <span class="font-semibold mr-2">Description:</span> ${element.course.description}
                                      </div>

                                      <div class="p-4 mb-4 mt-4 text-sm text-indigo-600 rounded-xl bg-indigo-50 font-normal" role="alert">
                                      <span class="font-semibold mr-2">Address:</span> ${element.course.address}
                                      </div>

                                      <div class="p-4 mb-4 text-sm text-amber-500 rounded-xl bg-amber-50 font-normal" role="alert">
                                        <span class="font-semibold mr-2">Schedule At:</span>${formattedDate} at ${convertTo12HourFormat(time)}
                                      </div>

                                      ${msg}
                                    </a>


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
                                 <a href="${slots === bookedSlots?'#':checkoutRoute}"
                                      class="relative block overflow-hidden rounded-lg mt-4 mb-4 border border-gray-100 p-4 sm:p-6 lg:p-8">
                                      <span
                                      class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>

                                      <div class="sm:flex sm:justify-between sm:gap-4">
                                          <div>
                                              <h3 class="text-lg font-bold text-gray-900 sm:text-xl">
                                                  ${course_name} | ${course_price.toLocaleString('en-US', {
                                                  style: 'currency',
                                                  currency: 'USD',
                                                  minimumFractionDigits: 0,
                                                  maximumFractionDigits: 0
                                                  })}
                                              </h3>
                                          </div>

                                          <div class="hidden sm:block sm:shrink-0">
                                              <img alt="" src="{{ Storage::disk('cms')->url('') }}/${element.course.image}"
                                                  class="size-16 rounded-lg object-cover shadow-sm" />
                                          </div>
                                      </div>

                                      <div class="p-4 mb-4 mt-4 text-sm text-indigo-600 rounded-xl bg-indigo-50 font-normal" role="alert">
                                      <span class="font-semibold mr-2">Description:</span> ${element.course.description}
                                      </div>

                                      <div
                                        class="relative inline-flex rounded-full items-center justify-start py-3 pl-4 pr-12 overflow-hidden font-semibold bg-indigo-50 text-indigo-600 transition-all duration-150 ease-in-out hover:pl-10 hover:pr-6 hover:bg-indigo-100 group">

                                        <span class="absolute right-0 pr-4 duration-200 ease-out group-hover:translate-x-12">
                                          <svg class="w-5 h-5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none">
                                            <path
                                              d="M14.9385 6L20.9999 12.0613M20.9999 12.0613L14.9385 18.1227M20.9999 12.0613L3 12.0613"
                                              stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                              stroke-linejoin="round" />
                                          </svg>
                                        </span>
                                        <span
                                          class="absolute left-0 pl-2.5 -translate-x-12 group-hover:translate-x-0 ease-out duration-200">
                                          <svg class="w-5 h-5 text-indigo-700" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none">
                                            <path
                                              d="M14.9385 6L20.9999 12.0613M20.9999 12.0613L14.9385 18.1227M20.9999 12.0613L3 12.0613"
                                              stroke="currentcolor" stroke-width="1.6" stroke-linecap="round"
                                              stroke-linejoin="round" />
                                          </svg>
                                        </span>
                                        <span
                                          class="relative w-full text-left transition-colors duration-200 ease-in-out group-hover:text-indigo-700">Next</span>
                                      </div>
                                    </a>
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
