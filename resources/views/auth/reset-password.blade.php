{{-- <x-guest-layout> --}}
@extends('school.layout.app')

@section('content')
    <div class="row justify-content-center">
        <form method="POST" action="{{ route('password.store') }}" class="col-sm-6 card m-5 p-4">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email"
                    :value="old('email', $request - > email)" required autofocus autocomplete="username" />
                @error('email')
                    <small class="text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" />
                <@error('password') <small class="text-danger"> {{ $message }} </small>
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
                <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
            </div>
        </form>

    </div>
@endsection
{{-- </x-guest-layout> --}}
