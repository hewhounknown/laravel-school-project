@extends('admin.layout.app')

@section('content')
    <h4 class="text-info">{{$user->name}}'s Profile</h4>

    <div class="card m-2">
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
    </div>

    @if ($user->courses != null)
        @foreach ($user->courses as $course)
        <div class="card m-2">
            <h3>{{$course->course_name}}</h3>
        </div>
        @endforeach
    @endif
@endsection
