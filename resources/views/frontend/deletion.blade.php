@extends('frontend.layouts.app')

@section('title')
    Account Deletion |
@endsection

@section('content')
    <div class="pt-34 bg-cover bg-center">

    </div>
    <section class="relative mt-10 bg-center bg-cover min-h-[10rem] lg:min-h-[10rem]">
        <div class="absolute inset-0  bg-gradient-to-t from-[#9061f952] rounded-lg"></div>

        <div class="relative px-4 mx-auto max-w-[90rem]  sm:px-6 lg:flex lg:items-center lg:px-8">
            <h1 class="py-24 lg:py-36 text-white pl-5 text-2xl lg:text-4xl font-semibold uppercase"> Account Deletion
            </h1>
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
                        Account Deletion
                    </li>
                </ol>
            </div>
        </div>


    </section>
    <section class="bg-gray-50 border-b py-12 bg-cover bg-center">
        <div class="container mx-auto max-w-[85rem] px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold text-center text-gray-900 mb-6">
                Account Deletion
            </h1>
            <div class="w-full mb-8">
                <div class="h-1 mx-auto bg-gradient-to-r from-red-500 to-red-600 w-32 rounded"></div>
            </div>

            <p class="text-lg text-gray-700 text-center leading-relaxed mb-8">
                To request account deletion without logging in, please follow the steps below:
            </p>

            <ul class="list-decimal list-inside text-lg text-gray-700 space-y-4 max-w-2xl mx-auto">
                <li>
                    Send an email to <a href="mailto:info@uniquemedsvcs.com"
                        class="text-blue-600 underline">info@uniquemedsvcs.com</a> with the subject line: <strong>Account
                        Deletion Request</strong>.
                </li>
                <li>Include the following information in your email:
                    <ul class="list-disc list-inside text-base text-gray-600 mt-2 ml-4 space-y-2">
                        <li>Your registered email address.</li>
                        <li>Full name associated with the account.</li>
                        <li>Reason for account deletion (optional).</li>
                    </ul>
                </li>
                <li>
                    Our support team will process your request and confirm via email within 5 business days.
                </li>
            </ul>

            <div class="text-center mt-12">
                <p class="text-gray-600">
                    For further assistance, please contact us at
                    <a href="mailto:info@uniquemedsvcs.com" class="text-blue-600 underline">info@uniquemedsvcs.com</a>.
                </p>
            </div>
        </div>
    </section>



    <!-- Change the colour #f8fafc to match the previous section colour -->
@endsection
