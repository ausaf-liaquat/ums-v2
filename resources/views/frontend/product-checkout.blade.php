@extends('frontend.layouts.app')

@section('title')
    Product Checkout |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Product Checkout</h1>
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
                        Product Checkout
                    </li>
                </ol>
            </div>
        </div>


    </section>

    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto max-w-[85rem] pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Product Checkout
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <form class="mx-auto" id="formCourse" method="POST" action="{{ route('product.checkout.store') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="grid p-5 grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="rounded-xl bg-white p-4 ring ring-indigo-50 sm:p-6 lg:p-8">
                        <h3 class="text-lg mb-4 font-bold text-gray-900 sm:text-xl">
                            Personal Details
                        </h3>
                        <div class="mb-5">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                            <input type="text" id="base-input" name="first_name" placeholder="Enter first name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" id="base-input" name="last_name" placeholder="Enter last name" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" id="base-input" name="email" placeholder="Enter email" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="number" id="base-input" name="phone" placeholder="Enter phone" required
                                onkeyup='if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")'
                                onkeypress='if (/\s/g.test(this.value)) this.value = this.value.replace(/\s/g,"")'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-5">
                            {{-- @if ($course->type == 1) --}}
                            <div class="col-md-6 mb-sm-7 mb-4">
                                <label for="message"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Message</label>
                                <textarea id="message" name="message" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Leave a message..." required></textarea>
                            </div>
                            {{-- @endif --}}
                        </div>

                        <div class="mb-5">
                            {{-- @if ($course->type == 1) --}}
                            <div class="col-md-6 mb-sm-7 mb-4">
                                <label for="address"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                                <textarea id="address" name="address" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Leave a address..." required></textarea>
                            </div>
                            {{-- @endif --}}
                        </div>
                        <div class="mb-5">
                            <label for="base-input"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Zip
                                Code</label>
                            <input type="text" id="base-input" name="zip_code" placeholder="Enter zip code" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>
                        <div class="row">
                            {{-- @if ($course->type == 1) --}}
                            <div class="col-md-6 mb-sm-7 mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">State:

                                </label>
                                <select name="state_id" id="state_id"
                                    class=" border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 state"
                                    data-parsley-errors-container="#state-error" required>

                                </select>
                                <div id="state-error"></div>
                            </div>
                            {{-- @endif --}}

                            <div class="col-md-6 mb-sm-7 mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City:

                                </label>
                                <select name="city_id" id="city_id"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 city"
                                    data-parsley-errors-container="#city-error" required>

                                </select>
                                <div id="city-error"></div>
                            </div>

                            <button type="submit" class="rounded-lg mt-4 py-2.5 px-6 text-center w-full text-white bg-indigo-600 font-semibold text-lg transition-all duration-500 hover:bg-indigo-700">Next</button>
                        </div>


                    </div>
                    <div class="about-right pb-5 pt-lg-5 text-lg-start text-center ">
                        <a href="#" class="block rounded-lg p-4 shadow-md shadow-indigo-100">
                            <img alt=""
                                src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                                class="h-56 w-full rounded-md object-cover" />

                            <div class="mt-2">
                                <dl>
                                    <div>
                                        <dt class="sr-only">Price</dt>

                                        <dd class=" text-gray-500">${{ number_format($product->price) }}</dd>
                                    </div>

                                    <div>
                                        <dt class="sr-only">Address</dt>

                                        <dd class="font-medium text-gray-900">{{ $product->title }}</dd>
                                    </div>
                                </dl>

                                <div class="mt-6 flex items-center gap-8 text-xs">

                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

            stateSelect2()
            citySelect2()
            let form = $('#formCourse').parsley()

        })

        function stateSelect2() {
            $('.state').select2({
                placeholder: 'Select state',
                ajax: {
                    url: "{{ route('states.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: 233
                        }

                        return query;
                    }
                }
            })
        }

        function citySelect2() {
            $('.city').select2({
                placeholder: 'Select city',
                ajax: {
                    url: "{{ route('cities.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                            country_id: 233,
                            state_id: $('.state').val()
                        }

                        return query;
                    }
                }
            })
        }
    </script>
@endsection
