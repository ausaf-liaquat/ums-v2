@extends('frontend.layouts.app')

@section('title')
    Product Success |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase">Product Success</h1>
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
                        Product Success
                    </li>
                </ol>
            </div>
        </div>


    </section>

    <section class="bg-white border-b py-8 bg-cover bg-center">
        <div class="container mx-auto pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                Products
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                <table class="main w-full" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td class="content-wrap text-center p-4">
                                <table class="w-full text-black" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td class="content-block">
                                                <h2 class="text-2xl font-semibold">You have successfully purchased this
                                                    product</h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="content-block">
                                                <table class="invoice w-full mx-auto my-4 border-collapse">
                                                    <tbody>
                                                        <tr>
                                                            <td class="py-2">
                                                                {{ $user->name }}<br>
                                                                #{{ $order->order_number }}<br>
                                                                {{ $order->created_at->format('m/d/Y') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <table
                                                                    class="invoice-items w-full border-t border-b border-gray-200"
                                                                    cellpadding="0" cellspacing="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="py-2">{{ $product->name }}</td>
                                                                            <td class="text-right py-2">
                                                                                ${{ number_format($order->grand_total, 2) }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr class="total">
                                                                            <td class="text-right py-2" width="80%">Total
                                                                            </td>
                                                                            <td class="text-right py-2">
                                                                                ${{ number_format($order->grand_total, 2) }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
    </section>

    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
