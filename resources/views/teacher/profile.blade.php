@extends('auth')

@section('dashboard')
    <div class="container mb-5">
        <div class="row shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="d-grid col-7 mx-auto">
                <a href="{{route('courseCreate')}}" class="btn btn-outline-primary">create your courses here!</a>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="row shadow-sm justify-content-evenly p-2 bg-body-tertiary rounded">
            <h3 class="default">Your courses</h3>
            @foreach ($courses as $c)
            <div class="col-md-3 mx-2 mb-3">
                <div class="card" style="width: 18rem;">
                    @if ($c->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                    @else
                        <img src="{{asset('image/'.$c->course_image)}}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                      <h5 class="card-title">{{$c->course_name}}</h5>
                      <p class="card-text">{{$c->course_description}}</p>
                      <a href="#" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


@endsection
