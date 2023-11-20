@extends('app')

@section('title',$courses->title)

@section('content')
    <div class="container-fluid" style="width:100wh; height:270px;">
        <div
            class="bg-image p-5 shadow-1-strong rounded mb-5 text-white"
            style="background: url({{asset('img/'. $courses->photo_path)}}); background-size: 820px 270px;
                background-color: #E6E6FA; background-position: bottom right; background-repeat: no-repeat;">
                <div class="row">
                    <div class="mt-5 col-6 text-dark align-self-center">
                        <h2>{{$courses->title}}</h2>
                        <h5 class="mt-5">{{$courses->description}}</h5>
                    </div>
                </div>
            </div>
        </div>
@endsection
