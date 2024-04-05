{{-- <x-guest-layout> --}}
<!-- Session Status -->
{{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
@extends('school.layout.app')

@section('title', 'Login')

@section('content')
    <div class="p-5">
        <form method="POST" action="{{ route('login') }}" class="card m-5 p-4">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="current-password" />
                @error('password')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
            </div>

            <div class="d-flex justify-content-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button type="submit" class="btn btn-primary ms-3">{{ __('Log in') }}</button>
            </div>
        </form>
    </div>
@endsection
{{-- </x-guest-layout> --}}
