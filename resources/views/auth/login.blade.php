@extends('layouts.guest')
@section('title')
    Login
@endsection
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

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
                            @csrf

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
                                @if (Route::has('password.request'))
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">Password</label>
                                        <a href="{{ route('password.request') }}">
                                            <small>Forgot Password?</small>
                                        </a>
                                    </div>
                                @endif
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
                            <div class="mb-3">
                                <div class="form-check gap-3">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="{{ route('register') }}">
                                <span>Create an account</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
