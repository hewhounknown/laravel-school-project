@extends('layout.app')

@section('title', Auth::user()->name . "'s profile")

@section('content')

    <div class="container-fluid mt-5">
        <div class="row g-3">
            <div class="col-9">
                {{-- profile start --}}
                <div class="container">
                    <div class="row shadow-sm p-3 mb-5 bg-body-tertiary rounded position-relative">
                        <div class="col-3">
                            <div>
                                @if (Auth::user()->image == null)
                                <img src="{{asset('img/defaultprofile.jpg')}}" alt="profile picture" class="border rounded-circle" style="width: 13rem; hieght: 38rem;">
                                @else
                                <img src="{{asset('storage/uploads/'.Auth::user()->image)}}" alt="profile picture" class="border rounded-circle" style="width: 13rem; hieght: 38rem;">
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
                {{-- profile end --}}
            </div>

            <div class="col">
                <div class="list-group mb-2 text-lg-start">
                    <span class="disabled list-group-item d-none d-lg-block">
                        <h5>CONTROLS</h5>
                    </span>
                    <a href="" class="list-group-item active">
                        <i class="fa-solid fa-house"></i>
                        <span class="d-none d-lg-inline">Dashboard</span>
                    </a>
                    <a href="" class="list-group-item" data-bs-toggle="modal" data-bs-target="#choiceModal">
                        <i class="fa-solid fa-folder-plus"></i>
                        <span class="d-none d-lg-inline">Courses</span>
                    </a>
                    <a href="{{route('student.control')}}" class="list-group-item">
                        <i class="fas fa-users"></i>
                        <span class="d-none d-lg-inline">Students</span> <span class="bandge bg-danger rounded-pill float-end text-white d-none d-lg-inline"> 20 </span>
                    </a>

                    <a href="" class="list-group-item">
                        <i class="fas fa-flag"></i>
                        <span class="d-none d-lg-inline">Reports</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for edit profile -->
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
                                    <img id="img" src="{{asset('img/defaultprofile.jpg')}}" alt="profile picture" class="rounded mx-auto d-block mb-2"  style="width:20rem; hieght: 38rem;">
                                @else
                                    <img id="img" src="{{asset('storage/uploads/'.Auth::user()->image)}}" alt="profile picture" class="rounded mx-auto d-block mb-2"  style="width: 15rem; hieght: 38rem;">
                                @endif
                                <div>
                                    {{-- <input type="file" name="image" id="" class="form-control"> --}}
                                    <input type="file" name="image" id="" class="form-control" onchange="readURL(this)">
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

        <!-- Modal to add course -->
        <div class="modal fade" id="choiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Choose your course's type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-between p-3">
                        @foreach ($program as $p)
                            <div class="col-4 bg-text-light rounded mb-2">
                                    <a href="{{route('courseForm', $p->id)}}">
                                        <button type="submit" class="btn btn-outline-dark w-100" style="height: 5rem;">{{$p->name}}</button>
                                    </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            </div>
        </div>

    <div class="row">
        <div class="col-3 offset-7">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>

    {{-- <div class="container mb-5">
        <div class="row shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="d-grid col-7 mx-auto">
                <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#choiceModal">
                    create your courses here!
                </a>
            </div>
        </div>
    </div> --}}



    <div class="container mb-5">
        <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
            <h3 class="default">Your courses</h3>
            @foreach ($courses as $c)
            <div class="col-md-3 mx-5 my-3">
                <div class="card " style="width: 20rem;">
                    @if ($c->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                    @else
                        <img src="{{asset('storage/course/'.$c->course_image)}}" class="card-img-top" style="height: 10rem" alt="..." >
                    @endif
                    <div class="card-body" style="height: 9rem">
                        <h5 class="card-title">{{$c->course_name}}</h5>
                        <p class="card-text">{{$c->course_description}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('course.detail', $c->id)}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

<script>
    function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                //let img = document.getElementById('img');

                reader.onload = e => $('#img').attr('src', e.target.result);

                reader.readAsDataURL(input.files[0]);
                //console.log(reader);
            }
        }
</script>
@endsection
