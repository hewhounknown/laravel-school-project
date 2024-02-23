@extends('admin.layout.app')

@section('content')
    <h4>Courses Manage </h4>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row justify-content-end">
        <div class="col-3 text-center">
            <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#courseModal">
                <i class="fa-solid fa-folder-plus"></i>
            </div>
        </div>
    </div>

    {{-- Courses Create modal start --}}
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 730px;">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" method="POST" action="{{route('admin.course.create')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <select name="programSelected" id="programSelected" class="form-select mb-2">
                                <option value="">select program</option>
                                @foreach ($programs as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                                @endforeach
                            </select>

                            <div id="cats" class="my-2">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-2">
                                <label for="image">
                                    <img id="img" src="{{asset('img/add_image.png')}}" alt="profile picture" class="rounded"  style="width:230px; hieght: 180px;">
                                </label>
                                <input type="file" name="courseImage" id="image" class="form-control" onchange="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="" class="form-label">Course Name</label>
                                <input type="text" name="courseName" id="" class="form-control mb-2">
                            </div>

                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    {{-- Courses Create modal end --}}


    @if (count($newCourses)>0)
    <div id="newCourses" class=" p-3 m-2">
        @foreach ($newCourses as $new)
            @if (count($new->topics) < 3)
            <div class="card  my-1" style="height: 120px">
                <div class="row bg-success-subtle text-emphasis-success g-0">
                    <div class="col-3">
                        @if ($new->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                        @else
                        <img src="{{asset('storage/course/'.$new->course_image)}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                        @endif
                    </div>
                    <div class="col-7 p-2">
                        <div class="row">
                            <div class="col-sm-3"><strong>Name</strong></div>
                            <div class="col-sm-9">{{_($new->course_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"><strong>Category</strong></div>
                            <div class="col-sm-9">{{_($new->category->category_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"><strong>By</strong></div>
                            <div class="col-sm-9">{{_($new->teacher->name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"><strong>Date</strong></div>
                            <div class="col-sm-9">{{_($new->created_at->format('d/m/y'))}}</div>
                        </div>
                    </div>
                    <div class="col-2 text-center align-self-center">
                        <a href="{{route('admin.course.detail', $new->id)}}" class="btn btn-outline-success btn-lg">
                            <i class="fa-solid fa-info"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach

        @foreach ($newCourses as $new)
        @if (count($new->topics) >= 3)
        <div class="card  my-1" style="height: 120px">
            <div class="row bg-info-subtle text-emphasis-info g-0">
                <div class="col-3">
                    @if ($new->course_image == null)
                    <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                    @else
                    <img src="{{asset('storage/course/'.$new->course_image)}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                    @endif
                </div>
                <div class="col-7 p-2">
                    <div class="row">
                        <div class="col-sm-3"><strong>Name</strong></div>
                        <div class="col-sm-9">{{_($new->course_name)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Category</strong></div>
                        <div class="col-sm-9">{{_($new->category->category_name)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>By</strong></div>
                        <div class="col-sm-9">{{_($new->teacher->name)}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Date</strong></div>
                        <div class="col-sm-9">{{_($new->created_at->format('d/m/y'))}}</div>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    <a href="" class="btn btn-outline-success btn-lg">
                        <i class="fa-solid fa-info"></i>
                    </a>
                    <a href="{{route('admin.course.public', $new->id)}}" class="btn btn-outline-info btn-lg">
                        <i class="fa-solid fa-check"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    @endforeach
    </div>
    @endif

    @if (count($courses)>0)

    <div class="mx-5 my-3 text-center">
        <form class="input-group">
            <input id="searchCourse" class="form-control w-75" type="text" placeholder="Search">
            <button type="button" class=" btn btn-secondary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
        </form>
    </div>

    <div id="avaliableCourses" class="m-2" style="overflow-x: auto;">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Program</th>
                    <th>By Teacher</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>
                        @if ($course->course_image == null)
                            <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                        @else
                            <img src="{{asset('storage/course/'.$course->course_image)}}" class="img-fluid" style="width: 170px; height: 120px" alt="">
                        @endif
                    </td>
                    <td>{{$course->course_name}}</td>
                    <td>{{$course->category->category_name}}</td>
                    <td>{{$course->category->program->name}}</td>
                    <td>{{$course->teacher->name}}</td>
                    <td>{{$course->created_at->format('d/m/y')}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

@endsection

@section('J_Script')
    <script>
        $(document).ready(function(){
            $('#programSelected').on('change', function(){
                let programId = $(this).val();
                //console.log(programId);

                $.ajax({
                    url : 'http://localhost:8000/admin/take/categories',
                    type : 'GET',
                    data : {'selectProgramId' : programId},
                    success: function(cats){
                        $catsList = '<label class="d-block">choose Category :</label>';
                        //console.log(cats);
                        cats.forEach(cat => {
                            $catsList += `
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="catId" id="cat${cat.id}" value="${cat.id}">
                                    <label class="form-check-label" for="cat">
                                      ${cat.category_name}
                                    </label>
                                </div>`;
                        });
                        $('#cats').html($catsList);
                    }
                })
            });

            $('#searchCourse').on('keyup', function(){
                let searchItem = $(this).val();
                //console.log(searchItem);

                $.ajax({
                    url : 'http://localhost:8000/admin/search/course',
                    type: 'GET',
                    data: {'searchData' : searchItem},
                    success: function(courses){
                        console.log(courses);
                        $table = '';
                        if(courses.length > 0){
                            $table = `<table class="table table-success table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Program</th>
                                                <th>By Teacher</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                        courses.forEach(course=> {
                            if(course.course_status == true){
                                $table += `<tr>
                                                <td>`;
                                                    if(course.course_image == null){
                                                        $table += `<img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 170px; height: 120px" alt="">`;
                                                    } else{
                                                        $table += `<img src="{{asset('storage/course/')}}/${course.course_image}" class="img-fluid" style="width: 170px; height: 120px" alt="">`;
                                                    }
                                    $table += `</td>
                                                <td>${course.course_name}</td>
                                                <td>${course.category.category_name}</td>
                                                <td>${course.category.program.name}</td>
                                                <td>${course.teacher.name}</td>
                                                <td>${new Date(course.created_at).toLocaleDateString('en-GB')}</td>
                                            </tr>`;
                            }
                        });
                        $table += `</tbody>
                            </table>`;
                        } else{
                            $table = `<h5 class="text-center text-muted m-3">not found...</h5>`;
                        }
                        $('#avaliableCourses').html($table);
                    }
                });
            });
        });
    </script>
@endsection
{{--  --}}
