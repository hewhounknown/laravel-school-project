@extends('school.layout.app')

@section('title', $program->name)

@section('content')

    <h1>{{$program->name}}</h1>

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row my-5 fs-4">
        <div class="col">
            @foreach ($categories as $cat)
                <a id="{{$cat->id}}" class="category badge text-black-50 border btn inline">{{$cat->category_name}}</a>
            @endforeach
        </div>
    </div>


        <div id="listOfCourses">
            <div class="container mb-5">
                <div id="availableCourses" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                    @foreach ($categories as $cat)
                        @if($cat->courses->isNotEmpty())
                            @foreach ($cat->courses as $c)
                                @if ($c->course_status == true)
                                    <div class="col mx-auto">
                                        <div class="card h-100">
                                            @if ($c->course_image == null)
                                                <img src="{{asset('img/default.png')}}" class="card-img-top img-fluid"  style=""  alt="...">
                                            @else
                                                <img src="{{asset('storage/course/'.$c->course_image)}}" class="card-img-top img-fluid" style="" alt="..." >
                                            @endif
                                            <div class="card-body" style="">
                                                <h5 class="card-title">{{$c->course_name}}</h5>
                                                <p class="card-text">{{$c->course_description}}</p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="{{route('course.detail', $c->id)}}" class="btn btn-primary">View</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    </div>
                </div>
        </div>

@endsection

@section('J_Script')
    <script>
        $(document).ready(function(){
            $('.category').on('click', function(){
                let catId = $(this).attr('id');
                console.log(catId);

                let courseEnrollRoute = "{{ route('course.enroll', ['id'=>':id']) }}";
                let courseDetailRoute = "{{ route('course.detail', ['id'=>':id']) }}"
                $.ajax({
                    url : 'http://localhost:8000/programmes/courses/filter',
                    type : 'GET',
                    data : {'categoryId' : catId},
                    success: function(response){
                        console.log(response.length);
                        $list = '';
                        if (response.length != 0) {
                            console.log(response);
                            $list = `<div class="container mb-5">
                                        <div id="avaliableCourses" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">`;
                            response.forEach(course => {
                                console.log(course);
                                $list += `<div class="col mx-auto">
                                            <div class="card h-100">`;
                                                if (course.course_image == null) {
                                                    $list += `<img src="{{asset('img/default.png')}}" class="card-img-top img-fluid"  style=""  alt="...">`;
                                                } else{
                                                    $list += `<img src="{{asset('storage/course/')}}./${course.course_image}" class="card-img-top img-fluid" style="" alt="..." >`;
                                                }
                                                $list += `<div class="card-body" style="">
                                                            <h5 class="card-title">${course.course_name}</h5>
                                                            <p class="card-text">${course.course_description}</p>
                                                        </div>
                                                        <div class="card-footer">
                                                            <a href="${courseDetailRoute.replace(':id', course.id)}" class="btn btn-primary">View</a>
                                                        </div>
                                                    </div>
                                                </div>`;
                            });
                            $list += `</div>
                                </div>`;
                        } else {
                            $list = 'There are no avaliable courses';
                        }
                        $('#listOfCourses').html($list);
                    }
                });
            });
        });
    </script>
@endsection

