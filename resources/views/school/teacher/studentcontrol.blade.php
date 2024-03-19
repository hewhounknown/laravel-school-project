@extends('school.layout.app')

@section('title', 'student lists')

@section('content')
@php $rowNumber = 1; @endphp

    <h1>Student lists</h1>

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mt-3">
        <div class="row">
            <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lists as $l)
                        @foreach ($l['student'] as $student)
                            @foreach ($l['course'] as $course)
                                    @foreach ($l['enroll'] as $enroll)
                                        @if ($enroll->status == false)
                                        <tr>
                                            <th scope="row">{{__($rowNumber++)}}</th>
                                            <td>{{__($student->name)}}</td>
                                            <td>{{__($course->course_name)}}</td>
                                            <td>
                                                <a class="btn btn-outline-primary" href="{{route('student.accept', ['studentId'=>$student->id, 'courseId'=>$course->id])}}">
                                                    Accept
                                                </a>
                                                <a class="btn btn-outline-danger" href="http://">
                                                    Cancle
                                                </a>
                                            </td>
                                        </tr>
                                        @else
                                        <tr>
                                            <th scope="row">{{__($rowNumber++)}}</th>
                                            <td>{{__($student->name)}}</td>
                                            <td>{{__($course->course_name)}}</td>
                                            <td>
                                                <a href="{{route('student.kick',['studentId'=>$student->id, 'courseId'=>$course->id])}}" class="btn btn-outline-danger">
                                                    Kick
                                                </a>
                                                <a href="" class="btn btn-outline-warning">
                                                    Ban
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
              </table>
        </div>
    </div>

    {{-- @for ($i=0; $i<count($lists); $i++)
    {{$lists[$i]['enroll']}}
    @endfor --}}
@endsection

 {{-- <tr>
                                    <th scope="row">{{'..'}}</th>
                                    <td>{{__($data->name)}}</td>
                                    <td>{{__($data->course_name)}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Default button group">
                                            <a href="{{route('student.accept', ['studentId'=>$data['student']->id, 'courseId'=>$data['course']->id])}}">
                                                <button type="button" class="btn btn-outline-primary">
                                                Accept
                                                </button>
                                            </a>
                                            <a href="http://">
                                                <button type="button" class="btn btn-outline-danger">
                                                Cancle
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr> --}}
