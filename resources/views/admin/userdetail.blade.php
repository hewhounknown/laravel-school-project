@extends('admin.layout.app')

@section('content')
    {{-- <h4 class="text-info">{{$user->name}}'s Profile</h4> --}}

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card m-2 shadow-sm position-relative">
        @if ($user->account_status == 'suspend')
        <div class="alert alert-danger align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> This account is suspended!!
        </div>
        @endif
        <div class="row p-2">
            <div class="col-sm-4 text-center">
                @if ($user->image != null)
                <img src="{{asset('storage/uploads/'.$user->image)}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                @else
                <img src="{{asset('img/default.png')}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                @endif
            </div>
            <div class="col-sm-8 p-2 mt-2">
                <div>
                    @if ($user->role == 'student')
                        <h3> {{$user->name}} | <i class="fa-solid fa-user"></i> </h3>
                    @elseif ($user->role == 'teacher')
                        <h3> {{$user->name}} | <i class="fa-solid fa-chalkboard-user"></i> </h3>
                    @else
                        <h3> {{$user->name}} | <i class="fa-solid fa-user-tie"></i> </h3>
                    @endif
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>  <small>{{$user->email}}</small>
                </div>
                <div>
                    @if ($user->address != null)
                    <i class="fa-solid fa-location-dot"></i> <small>{{$user->address}}</small>
                    @endif
                </div>
                <div>
                    @if ($user->phone != null)
                    <i class="fa-solid fa-mobile"></i> <small>{{$user->phone}}</small>
                    @endif
                </div>
            </div>
        </div>
        <span class="position-absolute top-0 end-0" style="width: auto;">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#controlModal">
                <i class="fa-solid fa-bars fa-xl"></i>
            </button>
        </span>

        {{-- control modal start --}}
        <div class="modal fade" id="controlModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Control</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row justify-content-between p-2">
                    <div class="col-4">
                        <button class="btn btn-outline-dark w-100" type="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                           Change Role
                        </button>
                        <ul class="dropdown-menu">
                            @if ($user->role == 'student')
                                <li><a class="dropdown-item" href="{{route('admin.user.role',['id'=>$user->id, 'role'=>'teacher'])}}">Teacher</a></li>
                                <li><a class="dropdown-item" href="{{route('admin.user.role',['id'=>$user->id, 'role'=>'admin'])}}">Admin</a></li>
                            @elseif ($user->role == 'teacher')
                                <li><a class="dropdown-item" href="{{route('admin.user.role',['id'=>$user->id, 'role'=>'student'])}}">Student</a></li>
                                <li><a class="dropdown-item" href="{{route('admin.user.role',['id'=>$user->id, 'role'=>'admin'])}}">Admin</a></li>
                            @else
                                <li><a class="dropdown-item" href="#">You can't change </a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-4">
                        @if ($user->account_status == 'active')
                            <a href="{{route('admin.user.status',['id'=>$user->id, 'status'=>'suspend'])}}" type="button" class="btn btn-outline-warning w-100" onclick="return confirm('Are you sure, ban this account?')">
                                    <i class="fa-solid fa-ban"></i>
                            </a>
                        @else
                            <a href="{{route('admin.user.status',['id'=>$user->id, 'status'=>'active'])}}" type="button" class="btn btn-outline-info w-100">
                                <i class="fa-solid fa-lightbulb"></i>
                            </a>
                        @endif
                    </div>
                  </div>
                </div>
                {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
              </div>
            </div>
          </div>

        {{-- control modal end --}}
    </div>

    @if ($user->courses->isNotEmpty())
    <h5 class="pb-2 m-2 border-bottom border-dark">Your Courses</h5>
        @foreach ($user->courses as $course)
            @if (count($course->topics)<3)
            <div class="card  mx-2 my-3" style="min-height: 150px">
                <div class="row bg-warning-subtle text-emphasis-warning g-0">
                    <div class="col-sm-3 col-12">
                        @if ($course->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 100%; height: 150px" alt="">
                        @else
                        <img src="{{asset('storage/course/'.$course->course_image)}}" class="img-fluid" style="width: 100%; height: 150px" alt="">
                        @endif
                    </div>
                    <div class="col-sm-7 col-12 p-2">
                        <div class="row">
                            <div class="col-3"><strong>Name</strong></div>
                            <div class="col-9">{{_($course->course_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Category</strong></div>
                            <div class="col-9">{{_($course->category->category_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Program</strong></div>
                            <div class="col-9">{{_($course->category->program->name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Date</strong></div>
                            <div class="col-9">{{_($course->created_at->format('d/m/y'))}}</div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-12 mb-2 text-center align-self-center">
                        <a href="{{route('admin.course.detail', $course->id)}}" class="btn btn-outline-warning btn-lg">
                            <i class="fa-solid fa-info"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        @endforeach

        @foreach ($user->courses as $course)
            @if (count($course->topics)>=3)
            <div class="card  mx-2 my-3" style="min-height: 150px">
                <div class="row bg-info-subtle text-emphasis-info g-0">
                    <div class="col-sm-3 col-12">
                        @if ($course->course_image == null)
                        <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 100%; height: 150px" alt="">
                        @else
                        <img src="{{asset('storage/course/'.$course->course_image)}}" class="img-fluid" style="width: 100%; height: 150px" alt="">
                        @endif
                    </div>
                    <div class="col-sm-7 col-12 p-2">
                        <div class="row">
                            <div class="col-3"><strong>Name</strong></div>
                            <div class="col-9">{{_($course->course_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Category</strong></div>
                            <div class="col-9">{{_($course->category->category_name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>By</strong></div>
                            <div class="col-9">{{_($course->teacher->name)}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Date</strong></div>
                            <div class="col-9">{{_($course->created_at->format('d/m/y'))}}</div>
                        </div>
                    </div>
                    <div class="col-sm-2 col-12 mb-2 text-center align-self-center">
                        <a href="{{route('admin.course.detail', $course->id)}}" class="btn btn-outline-success btn-lg">
                            <i class="fa-solid fa-info"></i>
                        </a>

                        @if ($course->course_status == true)
                        <a href="{{route('admin.course.unpublic', $course->id)}}" class="btn btn-outline-secondary btn-lg">
                            <i class="fa-regular fa-face-smile"></i>
                        </a>
                        @else
                        <a href="{{route('admin.course.public', $course->id)}}" class="btn btn-outline-primary btn-lg">
                            <i class="fa-regular fa-face-frown"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif

        @endforeach
    @endif
@endsection
