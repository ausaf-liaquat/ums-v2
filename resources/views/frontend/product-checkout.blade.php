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

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="p-20 shadow-md border-purple-500 border-2 rounded-2xl">
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
                        </div>


                    </div>
                    <div class="p-20 ">
                        <div class="about-right pb-5 pt-lg-5 text-lg-start text-center">
                            <h3 class="mt-md-3 text-black font-extrabold uppercase">Product Details</h3>
                            <div class="mt-md-5 service_details text-purple-600">
                                <p>{{ $product->title }}</p>
                                <p>{{ $product->address }}</p>
                                <p>
                                    {{ $product->zip_code }} {{ $product?->state?->name ?? '' }}
                                    {{ $product?->city?->name ?? '' }}
                                </p>


                                <br>
                                <h4>Payment Details</h4>
                                <p>Total: ${{ number_format($product->price) }}</p>
                                <br>
                                <button type="submit"
                                    class="text-black bg-yellow-300 hover:bg-yellow-300 focus:outline-none focus:ring-4 focus:ring-ybg-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mb-2 dark:bg-yellow-300 dark:hover:bg-yellow-300 dark:focus:ring-ybg-yellow-300">Pay
                                    Now <i class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>
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
