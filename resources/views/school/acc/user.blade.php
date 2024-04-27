@extends('school.layout.app');

@section('title', $user->name)

@section('content')
    <div class="card m-2 shadow-sm position-relative">
        @if ($user->account_status == 'suspend')
            <div class="alert alert-danger align-items-center" role="alert">
                <i class="fa-solid fa-triangle-exclamation"></i> This account is suspended!!
            </div>
        @endif
        <div class="row p-2">
            <div class="col-sm-4 text-center">
                @if ($user->image != null)
                    <img src="{{ asset('storage/uploads/' . $user->image) }}" class="rounded-circle img-fluid"
                        style="width: 180px; height: 180px;" alt="">
                @else
                    <img src="{{ asset('img/default.png') }}" class="rounded-circle img-fluid"
                        style="width: 180px; height: 180px;" alt="">
                @endif
            </div>
            <div class="col-sm-8 p-2 mt-2">
                <div>
                    @if ($user->role == 'student')
                        <h3> {{ $user->name }} | <i class="fa-solid fa-user"></i> </h3>
                    @elseif ($user->role == 'teacher')
                        <h3> {{ $user->name }} | <i class="fa-solid fa-chalkboard-user"></i> </h3>
                    @else
                        <h3> {{ $user->name }} | <i class="fa-solid fa-user-tie"></i> </h3>
                    @endif
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i> <small>{{ $user->email }}</small>
                </div>
                <div>
                    @if ($user->address != null)
                        <i class="fa-solid fa-location-dot"></i> <small>{{ $user->address }}</small>
                    @endif
                </div>
                <div>
                    @if ($user->phone != null)
                        <i class="fa-solid fa-mobile"></i> <small>{{ $user->phone }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (count($user->courses) > 0)
        <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
            <h3 class="default">{{ $user->name }}'s courses</h3>
            @foreach ($user->courses as $c)
                <div class="col-md-3 m-2">
                    <div class="card " style="">
                        @if ($c->course_image == null)
                            <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="...">
                        @else
                            <img src="{{ asset('storage/course/' . $c->course_image) }}" class="card-img-top"
                                style="height: 10rem" alt="...">
                        @endif
                        <div class="card-body" style="height: 100px">
                            <h5 class="card-title">{{ $c->course_name }}</h5>
                            <p class="card-text">{{ $c->course_description }}</p>
                        </div>
                        @if ($c->course_status == false)
                            <div class="card-footer bg-warning-subtle text-warning-emphasis">
                                <a href="{{ route('course.detail', $c->id) }}" class="btn btn-warning">View</a>
                            </div>
                        @else
                            <div class="card-footer bg-info-subtle text-info-emphasis">
                                <a href="{{ route('course.detail', $c->id) }}" class="btn btn-primary">View</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($list != null)
        <div class="container my-5">
            <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded m-3">
                <h3 class="default">Your enrolled courses</h3>
                @foreach ($list as $l)
                    @foreach ($l['course'] as $course)
                        <div class="col-md-3 m-2">
                            <div class="card " style="">
                                @if ($course->course_image == null)
                                    <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('storage/course/' . $course->course_image) }}" class="card-img-top"
                                        style="height: 10rem" alt="...">
                                @endif
                                <div class="card-body" style="height: 100px">
                                    <h5 class="card-title">{{ $course->course_name }}</h5>
                                    <p class="card-text">{{ $course->course_description }}</p>
                                </div>
                                <div class="card-footer">
                                    @if ($l['enroll']->status == false)
                                        <a href="//" class="btn btn-outline-dark" data-bs-toggle="modal"
                                            data-bs-target="#enrollModal">pls wait</a>

                                        <div id="enrollModal" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>You can unenroll this {{ $course->course_name }} , Do you
                                                            want to?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancle</button>
                                                        <a href="{{ route('course.unenroll', $course->id) }}"
                                                            type="button" class="btn btn-primary">Unenroll</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('course.detail', $course->id) }}"
                                            class="btn btn-outline-primary">View Courses</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @endif

@endsection
