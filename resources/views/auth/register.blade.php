@extends('layouts.guest')
@section('title')
    Register
@endsection
@section('css')
    <style>
        .authentication-wrapper.authentication-basic .authentication-inner {
            max-width: none;
        }
    </style>
@endsection
@section('content')
    <!-- Session Status -->

    @if (session('status'))
        <div class='font-medium text-sm text-green-600 dark:text-green-400'>
            {{ session('status') }}
        </div>
    @endif

    <div class="container-xxl">
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
                        <h4 class="mb-2">Welcome to Unique med services!👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
                          @csrf

                          <div class="mb-3">
                              <label for="facility_name">Facility Name </label>
                              <input type="text" placeholder="Enter facility name" class="form-control"
                                  name="facility_name" id="facility_name" value="{{ old('facility_name') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="unit">Unit</label>
                              <input type="text" class="form-control" placeholder="Enter unit" name="unit"
                                  id="unit" value="{{ old('unit') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="address">Address</label>
                              <textarea name="address" id="address" class="form-control" cols="30" rows="3" required>{{ old('address') }}</textarea>
                          </div>

                          <div class="mb-3">
                              <label for="phone">Mobile Number</label>
                              <input type="text" class="form-control" name="phone"
                                  placeholder="Enter number e.g. 1XXXXXXXXXX" id="phone" value="{{ old('phone') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="state" class="form-label">State </label>
                              <input type="text" name="state" placeholder="Enter State" class="form-control" value="{{ old('state') }}">
                          </div>

                          <div class="mb-3">
                              <label for="city" class="form-label">City </label>
                              <input type="text" name="city" placeholder="Enter City" class="form-control" value="{{ old('city') }}">
                          </div>

                          <div class="mb-3">
                              <label for="zip_code">Zip Code</label>
                              <input type="text" class="form-control" name="zip_code"
                                  placeholder="Enter your zip code" id="zip_code" value="{{ old('zip_code') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email"
                                  placeholder="Enter your email" id="email" value="{{ old('email') }}" required>
                          </div>

                          <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    required aria-describedby="password"
                                    data-parsley-errors-container="#password-error"
                                    data-parsley-minlength="8"
                                    data-parsley-minlength-message="Password must be at least 8 characters long." />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                             <div id="password-error" class="text-sm text-red-600 dark:text-red-400 space-y-1"></div>
                            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                @foreach ((array) $errors->get('password') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password_confirmation">Password Confirmation</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirmPassword" class="form-control"
                                    name="password_confirmation" aria-describedby="password_confirmation"
                                     data-parsley-errors-container="#confirm-password-error"
                                    required data-parsley-equalto="#password"
                                    data-parsley-equalto-message="Passwords do not match." />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            <div id="confirm-password-error" class="text-sm text-red-600 dark:text-red-400 space-y-1"></div>
                            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                @foreach ((array) $errors->get('password_confirmation') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>


                          <div class="mb-3">
                              <label for="referred_by">Referred By </label>
                              <input type="text" class="form-control" name="referred_by"
                                  placeholder="Enter referred by" id="referred_by" value="{{ old('referred_by') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="clinician_type" class="form-label"><b>What type of clinicians do you need?</b> (select all that apply)</label>
                              <select name="clinician_type[]" id="clinician_type" class="form-control clinicianType" multiple required>
                                  @foreach($clinicianTypes ?? [] as $type)
                                      <option value="{{ $type->id }}" {{ collect(old('clinician_type'))->contains($type->id) ? 'selected' : '' }}>
                                          {{ $type->name }}
                                      </option>
                                  @endforeach
                              </select>
                              <div id="clinician_type-error"></div>
                          </div>

                          <div class="mb-3">
                              <label for="passcode">Verbal Passcode</label>
                              <input type="text" class="form-control" name="passcode"
                                  placeholder="Enter verbal passcode" id="passcode" value="{{ old('passcode') }}" required>
                          </div>

                          <div class="mb-3">
                              <label for="facility_unit">How many units does your facility need covered?</label>
                              <input type="text" class="form-control" name="facility_unit"
                                  placeholder="Enter units" id="facility_unit" value="{{ old('facility_unit') }}" required>
                          </div>

                          <div class="mb-3 text-center">
                              @php
                                  $contents = DB::table('frontend_contents')->where('frontend_page_id', 5)->get();
                              @endphp
                              <b>
                                  Please review and agree to our
                                  @foreach ($contents as $content)
                                      , <a href="{{ Storage::disk('cms')->url($content->content_file) }}" target="_blank">{{ $content->content_title }}</a>
                                  @endforeach
                              </b>
                          </div>

                          <div class="mb-3">
                              <div class="form-check gap-3">
                                  <input class="form-check-input" type="checkbox" name="terms_agreed" value="1" id="defaultCheck2"
                                      {{ old('terms_agreed') ? 'checked' : '' }} required>
                                  <label class="form-check-label" for="defaultCheck2">
                                      I have read and I agree to Unique Med Services Staffing Privacy Policy,
                                      UMS Facility Agreement and SMS Terms of Services
                                  </label>
                              </div>
                          </div>

                          @error('g-recaptcha-response')
                              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                          @enderror

                          {!! RecaptchaV3::field('registered') !!}

                          <div class="mb-3">
                              <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                          </div>
                      </form>


                        <p class="text-center">
                            <span>Already registered?</span>
                            <a href="{{ route('login') }}">
                                <span>LOGIN</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
        $(document).ready(function() {
            clinicianTypeSelect2()
            stateSelect2()
            citySelect2()

            $('#formAuthentication').parsley()
        });
        FilePond.registerPlugin(FilePondPluginImagePreview);

        FilePond.create(
            document.querySelector('.filepond'), {
                instantUpload: false, // Disable instant upload
                allowMultiple: false, // Allow multiple
                storeAsFile: true,
            }
        );

        function clinicianTypeSelect2() {
            $('.clinicianType').select2({
                placeholder: 'Select clinician types',
                ajax: {
                    url: "{{ route('clinician-types.select2') }}",
                    delay: 250,
                    data: function(params) {
                        var query = {
                            q: params.term,
                        }

                        return query;
                    }
                }
            })
        }

        function stateSelect2() {
            $('.state').select2({
                width: '100%',
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
                width: '100%',

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

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
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
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
