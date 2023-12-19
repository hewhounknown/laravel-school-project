@extends('programmes.categories')

@section('courses')
    <div class="row my-5 fs-4">
        <div class="col">
            @foreach ($category as $c)
                <a data-value="{{$c->category_name}}" onclick="getValue(this)" class="badge text-black-50 border btn inline languages">{{$c->category_name}}</a>
            @endforeach
        </div>
    </div>

    <div class="container mb-5">
        <div id="listOfCourses" class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
            @foreach ($courses as $c)
            <div class="col-md-3 mx-5 my-3">
                <div class="card " style="width: 20rem;">
                    @if ($c->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="card-img-top"  style="height: 10rem"  alt="...">
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


    <script>
        getValue = (category) => {
            const Choice = category.innerText;
            const coursesList = document.getElementById('listOfCourses');

           const courses = @json($courses);
            let avaliableCourses = courses.filter(c => c.category_name === Choice);
            //console.log(avaliableCourses);

            let coursesToShow = "";
            let image = "";
            if(avaliableCourses.length > 0) {
                //console.log(avaliableCourses);
                for (let i = 0; i < avaliableCourses.length; i++) {
                    //console.log(avaliableCourses[i].course_image);

                    if(avaliableCourses[i].course_image == null){
                        console.log('lee pl');
                        image = `<img src="{{asset('img/default.png')}}" class="card-img-top" style="height: 10rem" alt="...">`;
                    } else{
                        image = `<img src="{{asset('storage/course/${avaliableCourses[i].course_image}')}}" class="card-img-top" style="height: 10rem" alt="...">`
                    }
                    //console.log(image);
                    coursesToShow += `<div class="col-3 mb-3">
                                        <div class="card courses" style="width: 18rem;">
                                            ${image}
                                            <div class="card-body" style="height: 9rem">
                                                <h5 class="card-title">${avaliableCourses[i].course_name}</h5>
                                                <p class="card-text">${avaliableCourses[i].course_description}</p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="course/detail/name=${avaliableCourses[i].course_name}" class="btn btn-primary">View</a>
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

    {{-- <script src="{{asset('school/js/courses.js')}}"></script> --}}
@endsection

