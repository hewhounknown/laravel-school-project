@extends('auth')

@section('dashboard')

    <div class="row">
        <div class="col-3 offset-7">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>

    <div class="container mb-5">
        <div class="row shadow-sm p-3 mb-5 bg-body-tertiary rounded">
            <div class="d-grid col-7 mx-auto">
                <a href="" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#choiceModal">
                    create your courses here!
                </a>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                        <a href="{{route('courseDetail', $c->course_name)}}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>


@endsection
