@extends('app')

@section('title',$courses->title)

@section('content')
    <div class="container-fluid" style="width:100wh; height:60vh;">
        <div
            class="bg-image p-5 shadow-1-strong rounded mb-5 text-white"
            style="background: url({{asset('img/elementaryicon.png')}});
                background-color: #E6E6FA; background-position: bottom 50px right 30px; background-repeat: no-repeat;">
                <div class="row">
                    <div class="mt-5 col-6 text-dark align-self-center">
                        <h2>{{$courses->title}}</h2>
                        <h5 class="mt-5">{{$courses->description}}</h5>
                    </div>
                </div>
            </div>
        </div>
@endsection
