@extends('auth')

@section('dashboard')

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($course != null)
    <div class="container mb-5">
        <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
            <h3 class="default">Your enrolled courses</h3>
            @foreach ($course as $c)
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
                        <a href="{{route('courseDetail', $c->course_name)}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div>
        <h1 class="default">there are no enrolled course</h1>
    </div>
    @endif

@endsection
