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
                        <p class="mb-4">This is a secure area of the application. Please confirm your password before
                            continuing.</p>

                        <form id="formAuthentication" class="mb-3" method="POST"
                            action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" type="password" name="password" required
                                    autocomplete="current-password" />
                                <ul class= 'text-sm text-red-600 dark:text-red-400 space-y-1'>
                                    @foreach ((array) $errors->get('password') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>


                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Confirm</button>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
