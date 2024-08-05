@extends('frontend.layouts.app')

@section('title')
    {{ $product->title ?? '' }} |
@endsection

@section('css')
    <style>
        .nav-for-slider .swiper-slide {
            height: auto;
            width: auto;
            cursor: pointer;

        }

        .swiper-wrapper {
            height: auto;
        }

        .nav-for-slider .swiper-slide img {
            border: 2px solid transparent;
            border-radius: 10px;

        }

        .nav-for-slider .swiper-slide-thumb-active img {

            border-color: rgb(79 70 229);
        }
    </style>
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">
                {{ $product->title ?? '' }} </h1>
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
                        {{ $product->title ?? '' }}
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto max-w-[85rem] flex flex-wrap pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Medical Supplies
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <form action="{{ route('product.buy', ['product' => $product->id]) }}" method="post">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16">
                        <div
                            class="pro-detail w-full flex flex-col justify-center order-last lg:order-none max-lg:max-w-[608px] max-lg:mx-auto">
                            <p class="font-medium text-lg text-indigo-600 mb-4">Services &nbsp; / &nbsp; Medical Supplies
                            </p>
                            <h2 class="mb-2 font-manrope font-bold text-3xl leading-10 text-gray-900">
                                {{ $product->title ?? '' }}
                            </h2>
                            <div class="flex flex-col sm:flex-row sm:items-center mb-6">
                                <h6
                                    class="font-manrope font-semibold text-2xl leading-9 text-gray-900 pr-5 sm:border-r border-gray-200 mr-5">
                                    ${{ number_format($product->price, 2) }}</h6>
                                {{-- <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_12029_1640)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#FBBF24" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_12029_1640">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_8480_66029)">
                                            <path
                                                d="M9.10326 2.31699C9.47008 1.57374 10.5299 1.57374 10.8967 2.31699L12.7063 5.98347C12.8519 6.27862 13.1335 6.48319 13.4592 6.53051L17.5054 7.11846C18.3256 7.23765 18.6531 8.24562 18.0596 8.82416L15.1318 11.6781C14.8961 11.9079 14.7885 12.2389 14.8442 12.5632L15.5353 16.5931C15.6754 17.41 14.818 18.033 14.0844 17.6473L10.4653 15.7446C10.174 15.5915 9.82598 15.5915 9.53466 15.7446L5.91562 17.6473C5.18199 18.033 4.32456 17.41 4.46467 16.5931L5.15585 12.5632C5.21148 12.2389 5.10393 11.9079 4.86825 11.6781L1.94038 8.82416C1.34687 8.24562 1.67438 7.23765 2.4946 7.11846L6.54081 6.53051C6.86652 6.48319 7.14808 6.27862 7.29374 5.98347L9.10326 2.31699Z"
                                                fill="#F3F4F6" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_8480_66029">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </div>
                                <span class="pl-2 font-normal leading-7 text-gray-500 text-sm ">1624 review</span>
                            </div> --}}

                            </div>
                            <p class="text-gray-500 text-base font-normal mb-8 ">
                                {{ $product->description }}
                            </p>
                            <div class="block w-full">
                                <p class="font-medium text-lg leading-8 text-gray-900 mb-4">COLOR</p>
                                <div class="text">
                                    <div class="grid grid-cols-1 gap-4 text-center sm:grid-cols-3">
                                        @foreach ($product->colors as $key => $item)
                                            <div>
                                                <label for="color{{ $key }}"
                                                    class="block w-full cursor-pointer rounded-lg border border-gray-200 p-3 text-gray-600 hover:border-purple-600  has-[:checked]:border-purple-600 has-[:checked]:bg-purple-600 has-[:checked]:text-white"
                                                    tabindex="0">
                                                    <input class="sr-only" id="color{{ $key }}" type="radio"
                                                        value="{{ $item->id }}" tabindex="-1" name="color"
                                                        required />

                                                    <span class="text-sm"> {{ $item->name }} </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="block w-full mt-6 mb-6">
                                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">SIZE</p>
                                        <div class="grid grid-cols-1 gap-4 text-center sm:grid-cols-3">
                                            @foreach ($product->sizes as $key => $item)
                                                <div>
                                                    <label for="size{{ $key }}"
                                                        class="block w-full cursor-pointer rounded-lg border border-gray-200 p-3 text-gray-600 hover:border-purple-600 has-[:checked]:border-purple-600 has-[:checked]:bg-purple-600 has-[:checked]:text-white"
                                                        tabindex="0">
                                                        <input class="sr-only" value="{{ $item->id }}"
                                                            id="size{{ $key }}" type="radio" tabindex="-1"
                                                            name="size" required />

                                                        <span class="text-sm"> {{ $item->name }} </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                                        <p class="font-medium text-lg leading-8 text-gray-900 mb-4">QUANTITY</p>

                                        <div class="w-full">
                                            <div class="relative flex items-center max-w-[11rem]">
                                                <button type="button" id="decrement-button"
                                                    data-input-counter-decrement="bedrooms-input"
                                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 18 2">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                    </svg>
                                                </button>
                                                <input type="text" id="bedrooms-input" data-input-counter
                                                    data-input-counter-min="1" aria-describedby="helper-text-explanation"
                                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 font-medium text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block pb-6 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    name="quantity" placeholder="" value="3" required />
                                                <div
                                                    class="absolute bottom-1 start-1/2 pl-16 -translate-x-1/2 rtl:translate-x-1/2 flex items-center text-xs text-gray-400 space-x-1 rtl:space-x-reverse">
                                                    <svg class="w-2.5 h-2.5 text-gray-400" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 20 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M3 8v10a1 1 0 0 0 1 1h4v-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5h4a1 1 0 0 0 1-1V8M1 10l9-9 9 9" />
                                                    </svg>
                                                    <span>ITEMS</span>
                                                </div>
                                                <button type="button" id="increment-button"
                                                    data-input-counter-increment="bedrooms-input"
                                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 18 18">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="flex items-center gap-3">
                                        {{-- <button
                                        class="group transition-all duration-500 p-4 rounded-full bg-indigo-50 hover:bg-indigo-100 hover:shadow-sm hover:shadow-indigo-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                            viewBox="0 0 26 26" fill="none">
                                            <path
                                                d="M4.47084 14.3196L13.0281 22.7501L21.9599 13.9506M13.0034 5.07888C15.4786 2.64037 19.5008 2.64037 21.976 5.07888C24.4511 7.5254 24.4511 11.4799 21.9841 13.9265M12.9956 5.07888C10.5204 2.64037 6.49824 2.64037 4.02307 5.07888C1.54789 7.51738 1.54789 11.4799 4.02307 13.9184M4.02307 13.9184L4.04407 13.939M4.02307 13.9184L4.46274 14.3115"
                                                stroke="#4F46E5" stroke-width="1.6" stroke-miterlimit="10"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </button> --}}
                                        <button type="submit"
                                            class="text-center w-full px-5 py-4 rounded-[100px] bg-purple-600 flex items-center justify-center font-semibold text-lg text-white shadow-sm transition-all duration-500 hover:bg-purple-700 hover:shadow-purple-400">
                                            Buy Now
                                        </button>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="">
                            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                class="swiper main-slide-carousel product-prev mb-6">
                                <div class="swiper-wrapper">
                                    @foreach (json_decode($product->image) as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::disk('cms')->url($item) }}"
                                                alt="Yellow Travel Bag image" class="mx-auto rounded-2xl">
                                        </div>
                                    @endforeach

                                    {{-- <div class="swiper-slide">
                                    <img src="https://pagedone.io/asset/uploads/1711514857.png"
                                        alt="Yellow Travel Bag image" class="mx-auto rounded-2xl">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://pagedone.io/asset/uploads/1711514875.png"
                                        alt="Yellow Travel Bag image" class="mx-auto rounded-2xl">
                                </div>
                                <div class="swiper-slide">
                                    <img src="https://pagedone.io/asset/uploads/1711514892.png"
                                        alt="Yellow Travel Bag image" class="mx-auto rounded-2xl">
                                </div> --}}
                                </div>

                            </div>
                            <div thumbsSlider="" class="swiper nav-for-slider product-thumb max-w-[608px] mx-auto">
                                <div class="swiper-wrapper">
                                    @foreach (json_decode($product->image) as $item)
                                        <div class="swiper-slide">
                                            <img src="{{ Storage::disk('cms')->url($item) }}" alt="Travel Bag image"
                                                class=" cursor-pointer border-2 border-gray-50 transition-all duration-500 hover:border-indigo-600 slide:border-indigo-600">
                                        </div>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var swiper_thumbs = new Swiper(".nav-for-slider", {
            loop: true,
            spaceBetween: 20,
            slidesPerView: 5,
        });
        var swiper = new Swiper(".main-slide-carousel", {
            slidesPerView: 1,
            thumbs: {
                swiper: swiper_thumbs,
            },
        });
    </script>
@endsection
<!-- Change the colour #f8fafc to match the previous section colour -->
