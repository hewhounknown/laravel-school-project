{{-- <x-guest-layout> --}}
@extends('school.layout.app')

@section('content')
    <div class="row justify-content-center"">
        <div class="card col-sm-6 m-5 p-2">
            <div class="mb-2 text-sm text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-2" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="m-5">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required
                        autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
{{-- </x-guest-layout> --}}
