{{-- <x-guest-layout> --}}
@extends('school.layout.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('register') }}" class="card col-sm-6 m-5 p-3">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required
                    autofocus autocomplete="name" />
                @error('name')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                    required autocomplete="username" />
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                <input id="phone" class="form-control" type="tel" name="phone" value="{{ old('phone') }}"
                    required autocomplete="userphone" />
                @error('phone')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" />
                @error('password')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required
                    autocomplete="new-password" />
                @error('password_confirmation')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="btn btn-primary ms-4">{{ __('Register') }}</button>
            </div>
        </form>
    </div>
@endsection
{{-- </x-guest-layout> --}}
