@extends('school.layout.app')

@section('title', 'school')

@section('content')
    <div id="carouselNewCourses" class="carousel slide bg-body-tertiary my-5 d-none d-md-block" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="row ">
                <h4 class="text-warning m-3">New >>></h4>
                <div class="col-1">
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselNewCourses"
                        data-bs-slide="prev" style="left: 0; margin-left: 0px;">
                        <span aria-hidden="true">
                            <i class="fa-solid fa-angle-left fa-xl" style="color: #000000;"></i>
                        </span>
                    </button>
                </div>
                <div class="col-10">
                    @foreach ($newCourses->chunk(4) as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row mx-3">
                                @foreach ($chunk as $course)
                                    <div class="col-3">
                                        <div class="card m-2">
                                            @if ($course->course_image == null)
                                                <img src="{{ asset('img/default.png') }}" class="card-img-top img-fluid"
                                                    alt="..." style="height: 120px">
                                            @else
                                                <img src="{{ asset('storage/course/' . $course->course_image) }}"
                                                    class="card-img-top img-fluid" alt="..." style="height: 120px">
                                            @endif
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $course->course_name }}
                                                    <h6 class="badge text-bg-secondary">
                                                        {{ $course->category->category_name }}</h6>
                                                </h5>
                                                <p class="card-text">
                                                    {{ Str::limit($course->course_description, 20, '...') }}
                                                </p>
                                                <a href="{{ route('course.detail', $course->id) }}"
                                                    class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-1">
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselNewCourses"
                        data-bs-slide="next" style="">
                        <span aria-hidden="true">
                            <i class="fa-solid fa-angle-right fa-xl" style="color: #000000;"></i>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-5 mx-3 justify-content-around p-2 bg-body-tertiary rounded" style="">
        <h4 class="text-info">Popular >>></h4>
        @foreach ($popularCourses as $course)
            <div class="col-md-4 my-2">
                <div class="card">
                    @if ($course->course_image == null)
                        <img src="{{ asset('img/default.png') }}" class="card-img-top img-fluid" alt="..."
                            style="height: 230px;">
                    @else
                        <img src="{{ asset('storage/course/' . $course->course_image) }}" class="card-img-top img-fluid"
                            alt="..." style="height: 230px">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}
                            <h6 class="badge text-bg-secondary">{{ $course->category->category_name }}</h6>
                        </h5>
                        <p class="card-text">
                            {{ Str::limit($course->course_description, 20, '...') }}
                        </p>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row p-2">
        <h5 class="text-success">Our Teachers >></h5>
        @foreach ($teachers as $teacher)
            <div class="col-md-2 m-2 ">
                <a href="{{ route('profile.view', $teacher->id) }}" class="card bg-body-tertiary text-decoration-none">
                    <div class="card-body text-center" style="height: 300px;">
                        @if ($teacher->image == null)
                            <img src="{{ asset('img/defaultprofile.jpg') }}" alt="profile picture"
                                class="img-fluid rounded-circle" style="max-height: 360px; height: 180px;">
                        @else
                            <img src="{{ asset('storage/uploads/' . $teacher->image) }}" alt="profile picture"
                                class="img-fluid rounded-circle" style="max-height: 360px; height: 180px;">
                        @endif
                        <h5 class="mt-2">{{ $teacher->name }}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
