@extends('layout.app')

@section('title', 'course detail')

@section('content')
    <div class="container mt-5 ">
        <div class="row align-items-center justify-content-center shadow-sm p-3 rounded position-relative ">
            <div class="col-md-7 mb-2">
                <h4>{{__($course->course_description)}}</h4> <hr> <br>
                <h2 class="fs-1 text-dark">{{__($course->course_name)}}</h2>
            </div>
            <div class="col-md-5">
                <div class="text-center">
                    <img src="{{asset('storage/course/'.$course->course_image)}}"  alt="course image" style="width: 23rem; hieght: 15rem;">
                </div>
            </div>
        </div>
    </div>
@endsection
