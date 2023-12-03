@extends('auth')

@section('dashboard')
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
                                    <a href="{{route('courseCreate', $p->id)}}">
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
