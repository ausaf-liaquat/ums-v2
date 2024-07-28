@extends('layouts.guest')

@section('content')
    <!-- Session Status -->

    @if (session('status'))
        <div class='font-medium text-sm text-green-600 dark:text-green-400'>
            {{ session('status') }}
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
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" autofocus />
                                <ul class= 'text-sm text-red-600 dark:text-red-400 space-y-1'>
                                    @foreach ((array) $errors->get('email') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mb-3 form-password-toggle">

                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>

                                </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                                </div>
                                <ul class= 'text-sm text-red-600 dark:text-red-400 space-y-1'>
                                    @foreach ((array) $errors->get('password') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mb-3 form-password-toggle">

                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password Confirmation</label>

                                </div>

                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password_confirmation" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>

                                </div>
                                <ul class= 'text-sm text-red-600 dark:text-red-400 space-y-1'>
                                    @foreach ((array) $errors->get('password_confirmation') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Reset Password</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection


{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
