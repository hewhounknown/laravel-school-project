@extends('layout.app')

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
                    {{-- @for ($i=0; $i< count($list); $i++)
                        <tr>
                            <th scope="row">{{__($i+1)}}</th>
                            <td>{{__($list[$i]['student']->name)}}</td>
                            <td>{{__($list[$i]['course']->course_name)}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Default button group">
                                    <a href="{{route('student.accept', ['studentId'=>$list[$i]['student']->id, 'courseId'=>$list[$i]['course']->id])}}">
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
                        </tr>
                    @endfor --}}
                    @foreach ($lists as $l)
                        @foreach ($l['student'] as $student)
                            @foreach ($l['course'] as $course)
                                 <tr>
                                    <th scope="row">{{__($rowNumber++)}}</th>
                                    <td>{{__($student->name)}}</td>
                                    <td>{{__($course->course_name)}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Default button group">
                                            <a href="{{route('student.accept', ['studentId'=>$student->id, 'courseId'=>$course->id])}}">
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
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
              </table>
        </div>
    </div>
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
