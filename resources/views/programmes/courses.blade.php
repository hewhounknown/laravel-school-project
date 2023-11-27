@extends('programmes.categories')

@section('languages')
    <div class="row my-5 fs-4">
        <div class="col">
            @foreach ($languages as $l)
                <a data-value="{{$l->name}}" onclick="getValue(this)" class="badge text-black-50 border btn inline languages">{{$l->name}}</a>
            @endforeach
        </div>
    </div>

    <div class="row mx-3 my-4" id="listOfCourses">
        @foreach ($courses as $c)
        <div class="col-3 mb-3">
            <div class="card courses">
                <img src="{{asset('img/'.$c->photo_path)}}" style="height: 200px;" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{ $c->title }}</h5>
                  <p class="card-text">{{ $c->description }}</p>
                  <a href="{{route('coursesDetail', $c->title)}}" class="btn btn-primary">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    <script>
        getValue = (language) => {
            const languageChoice = language.innerText;
            const coursesList = document.getElementById('listOfCourses');

            const courses = @json($courses);
            let avaliableCourses = courses.filter(c => c.name === languageChoice);
            //console.log(avaliableCourses);

            let coursesToShow = "";
            if(avaliableCourses.length > 0) {
                //console.log(avaliableCourses);
                for (let i = 0; i < avaliableCourses.length; i++) {
                    coursesToShow += `<div class="col-3 mb-3">
                                        <div class="card courses">
                                            <img src="{{asset('img/${avaliableCourses[i].photo_path}')}}" style="height: 200px;" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title">${avaliableCourses[i].title}</h5>
                                                <p class="card-text">${avaliableCourses[i].description}</p>
                                                <a href="languages/class=${avaliableCourses[i].title}" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                      </div>`;
                }
            }
            else {
                coursesToShow = `<h1 class="text-black-50"> There is no avaliable courses... </h1>`;
            }
            coursesList.innerHTML = coursesToShow;
        }
    </script>
    <script src="{{asset('school/js/courses.js')}}"></script>
@endsection

