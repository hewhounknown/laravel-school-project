@extends('layout.app')

@section('title', Auth::user()->name . "'s profile")

@section('content')
    <div class="container mt-5">
        <div class="row shadow-sm p-3 mb-5 bg-body-tertiary rounded position-relative">
            <div class="col-3">
                <div>
                    @if (Auth::user()->image == null)
                    <img src="{{asset('img/defaultprofile.jpg')}}" alt="profile picture" class="border rounded-circle" style="width: 15rem; hieght: 38rem;">
                    @else
                    <img src="{{asset('storage/uploads/'.Auth::user()->image)}}" alt="profile picture" class="border rounded-circle" style="width: 15rem; hieght: 38rem;">
                    @endif
                </div>
            </div>
            <div class="col border-start border-dark text-bg-light">
                <div>
                    <h3>{{Auth::user()->name}} | {{Auth::user()->role}}</h3>
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>  <small>{{Auth::user()->email}}</small>
                </div>
                <div>
                    @if (Auth::user()->address != null)
                    <i class="fa-solid fa-location-dot"></i> <small>{{Auth::user()->address}}</small>
                    @endif
                </div>
                <div>
                    @if (Auth::user()->phone != null)
                    <i class="fa-solid fa-mobile"></i> <small>{{Auth::user()->phone}}</small>
                    @endif
                </div>
            </div>
            <span class="position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle" style="width: auto;">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editForm">
                    <i class="fa-regular fa-pen-to-square fa-xl"></i>
                </button>
            </span>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="editForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 730px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form id="myForm" enctype="multipart/form-data" method="post" action="{{route('profile')}}">
                        @csrf
                        <div class="row justify-content-evenly">
                            <input type="hidden" name="id" value="{{Auth::user()->id}}">
                            <div class="col-4">
                                @if (Auth::user()->image == null)
                                    <img src="{{asset('img/defaultprofile.jpg')}}" alt="profile picture" class="rounded mx-auto d-block mb-2"  style="width:20rem; hieght: 38rem;">
                                @else
                                    <img src="{{asset('storage/uploads/'.Auth::user()->image)}}" alt="profile picture" class="rounded mx-auto d-block mb-2"  style="width: 15rem; hieght: 38rem;">
                                @endif
                                <div>
                                    {{-- <input type="file" name="image" id="" class="form-control"> --}}
                                    <input type="file" name="image" id="" class="form-control">
                                </div>
                                <div class="mt-3">
                                    <input type="submit" value="Update" class="btn btn-outline-dark form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">{{ __('phone') }}</label>
                                    <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone', Auth::user()->phone) }}" autocomplete="phone">
                                    {{-- @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                                <div class="mb-2">
                                    <label for="address" class="form-label">{{ __('address') }}</label>
                                    <textarea name="address" id="" class="form-control" cols="30" rows="10">{{ old('address',Auth::user()->address) }}</textarea>
                                    {{-- @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
