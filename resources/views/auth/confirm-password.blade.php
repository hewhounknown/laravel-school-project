@extends('school.layout.app')

@section('title', 'password confirm')

@section('content')
    <div class="row justify-content-center">
        <div class="card col-sm-6 m-5 p-4">
            <div class="mb-4 text-sm text-secondary">
                This is a secure area of the application. Please confirm your password before continuing.
            </div>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                </div>
            </form>

        </div>
    </div>
@endsection
