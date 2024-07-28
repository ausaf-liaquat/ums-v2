@extends('layouts.guest')

@section('content')
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
                        <p class="mb-4">Forgot your password? No problem. Just let us know your email address and we will
                            email you a password reset link that will allow you to choose a new one.</p>

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('password.email') }}">
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


                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Email Password Reset
                                    Link</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
