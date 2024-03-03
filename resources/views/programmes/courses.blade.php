@extends('layout.app')

@section('title', $program->name)

@section('content')

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

    @foreach ($categories as $cat)
        <div id="listOfCourses">
            @if ($cat->courses->isNotEmpty())
                <div class="container mb-5">
                    <div id="avaliableCourses" class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
                        @foreach ($cat->courses as $c)
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
                                    <a href="{{route('course.detail', $c->id)}}" class="btn btn-primary">View</a>
                                    {{-- @if ($c->enrolls->isEmpty())
                                    <a href="{{route('course.enroll', $c->id)}}" class="btn btn-primary">Enroll</a>
                                    @else
                                        @foreach ($c->enrolls as $e)
                                            @if ($e->status == false)
                                            <a href="{{route('course.enroll', $c->id)}}" class="btn btn-primary">Enroll</a>
                                            @else
                                            <a href="{{route('course.detail', $c->id)}}" class="btn btn-primary">View</a>
                                            @endif
                                        @endforeach
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endforeach

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
                        //console.log(response);
                        $list = '';
                        if (response && response.length > 0) {
                            console.log(response);
                            $list = `<div class="container mb-5">
                                        <div id="avaliableCourses" class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">`;
                            response.forEach(course => {
                                $list += `<div class="col-md-3 mx-5 my-3">
                                            <div class="card " style="width: 20rem;">`;
                                                if (course.image == null) {
                                                    $list += `<img src="{{asset('img/default.png')}}" class="card-img-top"  style="height: 10rem"  alt="...">`;
                                                } else{
                                                    $list += `<img src="{{asset('storage/course/')}}./${course.course.image}" class="card-img-top" style="height: 10rem" alt="..." >`;
                                                }
                                                $list += `<div class="card-body" style="height: 9rem">
                                                            <h5 class="card-title">{{$c->course_name}}</h5>
                                                            <p class="card-text">{{$c->course_description}}</p>
                                                        </div>
                                                        <div class="card-footer">`;
                                                            if (course.enrolls.length === 0) {
                                                                $list += `<a href="${courseEnrollRoute.replace(':id',course.id)}" class="btn btn-primary">Enroll</a>`;
                                                            } else {
                                                                course.enrolls.forEach(enroll => {
                                                                    if (enroll.status == false) {
                                                                        $list += `<a href="${courseEnrollRoute.replace(':id', course.id)}" class="btn btn-primary">Enroll</a>`;
                                                                    } else {
                                                                       $list += `<a href="${courseDetailRoute.replace(':id', course.id)}" class="btn btn-primary">View</a>`;
                                                                    }
                                                                });
                                                            }
                                        $list += `</div>
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

