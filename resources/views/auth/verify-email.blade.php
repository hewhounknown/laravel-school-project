@extends('school.layout.app')

@section('title', 'Email Verify')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6 card m-5 p-4">
            <div class="mb-4 text-sm text-secondary">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-success">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            @endif

            <div class="mt-4 d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link">Log Out</button>
                </form>
            </div>

        </div>
    </div>
@endsection
