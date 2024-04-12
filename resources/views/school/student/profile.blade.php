@extends('school.acc.index')

@section('title', Auth::user()->name . "'s profile")

@section('section')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    @if ($list != null)
        <div class="container mb-5">
            <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
                <h3 class="default">Your enrolled courses</h3>

                @foreach ($list as $l)
                    @foreach ($l['course'] as $course)
                        {{-- {{$data}} --}}
                        <div class="col-md-3 mx-5 my-3">
                            <div class="card " style="width: 20rem;">
                                @if ($course->course_image == null)
                                    <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="...">
                                @else
                                    <img src="{{ asset('storage/course/' . $course->course_image) }}" class="card-img-top"
                                        style="height: 10rem" alt="...">
                                @endif
                                <div class="card-body" style="height: 9rem">
                                    <h5 class="card-title">{{ $course->course_name }}
                                        <span class="badge text-bg-secondary">{{ $course->category->category_name }}</span>
                                    </h5>
                                    <p class="card-text">{{ $course->course_description }}</p>
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
                                                        <p>You can unenroll this {{ $course->course_name }} , Do you want
                                                            to?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancle</button>
                                                        <a href="{{ route('course.unenroll', $course->id) }}" type="button"
                                                            class="btn btn-primary">Unenroll</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{ route('courseDetail', $course->id) }}"
                                            class="btn btn-outline-primary">View Courses</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    @else
        <div>
            <h1 class="default">there are no enrolled course</h1>
        </div>
    @endif

@endsection
