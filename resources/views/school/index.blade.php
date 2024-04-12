@extends('school.layout.app')

@section('title', 'school')

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg>

                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget
                            metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg>

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget
                            metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"
                    preserveAspectRatio="xMidYMid slice" role="img" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                </svg>

                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>One more for good measure.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget
                            metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> <br> <br> <br>

    <div class="row my-5 justify-content-around p-2" style="">
        <h4>New >>></h4>
        @foreach ($newCourses as $course)
            <div class="col-md-3 my-2">
                <div class="card">
                    @if ($course->course_image == null)
                        <img src="{{ asset('img/default.png') }}" class="card-img-top img-fluid" alt="...">
                    @else
                        <img src="{{ asset('storage/course/' . $course->course_image) }}" class="card-img-top img-fluid"
                            alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}
                            <span class="badge text-bg-secondary">{{ $course->category->category_name }}</span>
                        </h5>
                        <p class="card-text">
                            {{ $course->course_description }}
                        </p>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="row my-5 justify-content-around p-2" style="">
        <h4>Popular >>></h4>
        @foreach ($popularCourses as $course)
            <div class="col-md-4 my-2">
                <div class="card">
                    @if ($course->course_image == null)
                        <img src="{{ asset('img/default.png') }}" class="card-img-top img-fluid" alt="...">
                    @else
                        <img src="{{ asset('storage/course/' . $course->course_image) }}" class="card-img-top img-fluid"
                            alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->course_name }}
                            <span class="badge text-bg-secondary">{{ $course->category->category_name }}</span>
                        </h5>
                        <p class="card-text">
                            {{ $course->course_description }}
                        </p>
                        <a href="{{ route('course.detail', $course->id) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="container">
        <div class="row my-5 justify-content-evenly" style="height: 400px;">
            <div class="col-md-4 d-sm-block">
                <h3>Lorem, ipsum dolor sit amet consectetur</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus tempore ad nobis quisquam natus sed
                    impedit, quod ipsum neque consequatur culpa non eveniet eos recusandae. Eaque aspernatur modi nemo
                    vel.Sit harum suscipit minus asperiores animi quos commodi officiis voluptas reiciendis obcaecati, quas,
                    quaerat illo facilis molestiae. Expedita alias accusantium modi officia. Delectus, laborum repellendus
                    qui nulla laudantium provident iste!</p>
                <a href="" class="w-25 btn btn-outline-primary float-end">
                    <span>more...</span>
                </a>
            </div>
            <div class="col-md-4 d-sm-block">
                <div>
                    <img src="{{ asset('img/default.png') }}" alt="" style="height: 400px;"
                        class="w-100 rounded shadow">
                </div>
            </div>
        </div>

        <div class="row my-5 justify-content-evenly " style="height: 400px;">
            <div class="col-md-4 d-sm-block">
                <div>
                    <img src="{{ asset('img/default.png') }}" alt="" style="height: 400px;"
                        class="w-100 rounded shadow">
                </div>
            </div>
            <div class="col-md-4 d-sm-block">
                <h3>Lorem, ipsum dolor sit amet consectetur</h3>
                <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus tempore ad nobis quisquam natus sed
                    impedit, quod ipsum neque consequatur culpa non eveniet eos recusandae. Eaque aspernatur modi nemo
                    vel.Sit harum suscipit minus asperiores animi quos commodi officiis voluptas reiciendis obcaecati, quas,
                    quaerat illo facilis molestiae. Expedita alias accusantium modi officia. Delectus, laborum repellendus
                    qui nulla laudantium provident iste!</p>
                <a href="" class="w-25 btn btn-outline-primary float-end">
                    <span>more...</span>
                </a>
            </div>
        </div>
    </div>

@endsection
