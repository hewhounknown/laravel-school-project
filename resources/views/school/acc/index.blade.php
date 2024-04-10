@extends('school.layout.app')

@section('content')
    <div class="card m-5 shadow-sm position-relative">
        @if (Auth::user()->account_status == 'suspend')
            <div class="alert alert-danger align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i> This account is suspended!!
            </div>
        @endif
        <div class="row p-2">
            <div class="col-sm-4 text-center border-sm-end border-dark">
                @if (Auth::user()->image != null)
                    <img src="{{ asset('storage/uploads/' . Auth::user()->image) }}" class="rounded-circle img-fluid"
                        style="width: 180px; height: 180px;" alt="">
                @else
                    <img src="{{ asset('img/default.png') }}" class="rounded-circle img-fluid"
                        style="width: 180px; height: 180px;" alt="">
                @endif
            </div>
            <div class="col-sm-8 p-2 mt-2 fs-5">
                <div>
                    @if (Auth::user()->role == 'student')
                        <h3> {{ Auth::user()->name }} | <i class="fa-solid fa-user"></i> </h3>
                    @elseif (Auth::user()->role == 'teacher')
                        <h3> {{ Auth::user()->name }} | <i class="fa-solid fa-chalkboard-user"></i> </h3>
                    @else
                        <h3> {{ Auth::user()->name }} | <i class="fa-solid fa-user-tie"></i> </h3>
                    @endif
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i> <small>{{ Auth::user()->email }}</small>
                </div>
                <div>
                    @if (Auth::user()->address != null)
                        <i class="fa-solid fa-location-dot"></i> <small>{{ Auth::user()->address }}</small>
                    @endif
                </div>
                <div>
                    @if (Auth::user()->phone != null)
                        <i class="fa-solid fa-mobile"></i> <small>{{ Auth::user()->phone }}</small>
                    @endif
                </div>
            </div>
        </div>
        <span class="position-absolute top-0 end-0" style="width: auto;">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#controlModal">
                <i class="fa-solid fa-pen-fancy fa-xl"></i>
            </button>
        </span>

        {{-- control modal start --}}
        <div class="modal fade" id="controlModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Form</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="m-2">
                                <button class="btn  btn-outline-dark w-100" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fa-regular fa-address-card"></i>
                                </button>
                            </div>
                            <div class="m-2">
                                <button class="btn btn-outline-dark w-100" data-bs-toggle="modal"
                                    data-bs-target="#changePasswordModal">
                                    <i class="fa-solid fa-key"></i>
                                </button>
                            </div>
                            <div class="m-2">
                                <a href="" class="btn btn-outline-dark w-100"
                                    onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-270"></i>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 730px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-regular fa-address-card"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('profile') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row justify-content-evenly">
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="col-sm-4">
                                    @if (Auth::user()->image == null)
                                        <img id="img" src="{{ asset('img/defaultprofile.jpg') }}"
                                            alt="profile picture" class="rounded img-fluid mx-auto d-block mb-2"
                                            style="max-width:230px; max-hieght: 140px;">
                                    @else
                                        <img id="img" src="{{ asset('storage/uploads/' . Auth::user()->image) }}"
                                            alt="profile picture" class="rounded img-fluid mx-auto d-block mb-2"
                                            style="max-width:230px; max-hieght: 140px;">
                                    @endif
                                    <div>
                                        {{-- <input type="file" name="image" id="" class="form-control"> --}}
                                        <input type="file" name="image" id="" class="form-control"
                                            onchange="readURL(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', Auth::user()->name) }}" required autocomplete="name"
                                            autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', Auth::user()->email) }}" required
                                            autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="phone" class="form-label">{{ __('phone') }}</label>
                                        <input id="phone" type="text" class="form-control" name="phone"
                                            value="{{ old('phone', Auth::user()->phone) }}" autocomplete="phone">
                                    </div>
                                    <div class="mb-2">
                                        <label for="address" class="form-label">{{ __('address') }}</label>
                                        <textarea name="address" id="" class="form-control" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-key"></i></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('password.change') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    Current Password
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="currentPassword" id="" class="form-control">
                                </div>
                                @error('currentPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    New Password
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="newPassword" id="" class="form-control">
                                </div>
                                @error('newPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    Confirm Password
                                </div>
                                <div class="col-sm-8">
                                    <input type="password" name="confirmPassword" id="" class="form-control">
                                </div>
                                @error('confirmPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row justify-content-center">
                                <button type="submit" class="btn btn-warning w-50">save change</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- control modal end --}}
    </div>

    @yield('section')
@endsection
