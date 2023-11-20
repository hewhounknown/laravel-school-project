@extends('programmes.languages')

@section('languages')
    <div class="row my-5 fs-4">
        <div class="col">
            {{-- @foreach ($languages as $l)
            <a href="" class="badge text-black-50 border btn inline languages">{{$l->name}}</a>
            @endforeach --}}
            {{-- <select name="sorting" id="languaes" class="col"> --}}
                {{-- <option value="opt">Choose option...</option> --}}
                @foreach ($languages as $l)
                    <option value="{{$l->name}}" class="badge text-black-50 border btn inline languages">{{$l->name}}</option>
                @endforeach
            {{-- </select> --}}
        </div>
    </div>

    <div class="row mx-3 my-4" id="listOfCourses">
        <div class="col-3 mb-3">
            <div class="card">
                <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @foreach ($courses as $c)
        <div class="col-3 mb-3">
            <div class="card">
                <img src="{{asset('img/'.$c->photo_path)}}" style="height: 200px;" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $c->title }}</h5>
                  <p class="card-text">{{ $c->description }}</p>
                  <a href="{{route('coursesDetail', $c->title)}}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-3 mb-3">
            <div class="card">
                <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-3 mb-3">
            <div class="card">
                <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-3 mb-3">
            <div class="card">
                <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const coursesList = document.getElementById('listOfCourses');
        const languageChoice = Array.from(document.getElementsByClassName('languages'));
        console.log(languageChoice);
    </script>
@endsection

