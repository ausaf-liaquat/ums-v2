@extends('layouts.guest')
@section('title')
    Verify Email
@endsection
@section('content')
    <!-- Session Status -->

    @if (session('status') == 'verification-link-sent')
        <div class='font-medium text-sm text-green-600 dark:text-green-400'>
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="container-fluid">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <img class="w-px-50" src="{{ asset('img/logo-1-dark.png') }}" alt="">
                                <span class="  text-black fw-bolder ms-2">UNIQUE MED SERVICES</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Unique med services! 👋</h4>
                        <p class="mb-4">Thanks for signing up! Before getting started, could you verify your email address
                            by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly
                            send you another.</p>

                        <form id="formAuthentication" class="mb-3" method="POST"
                            action="{{ route('verification.send') }}">
                            @csrf

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Resend Verification
                                    Email</button>
                            </div>
                        </form>

                        <div iv class="mb-3">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-outline-secondary d-grid w-100">Log
                                    Out</button>
                            </form>
                            <div class="mt-3">
                                <a href="{{ route('home') }}">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl"></i> Back to home
                                </a>

                            </div>
                        </div>
                        <!-- /Register -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout> --}}
