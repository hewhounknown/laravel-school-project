@extends('app')

@section('title', 'languages')

@section('content')
    <div class="container-fluid" style="">
        {{-- <div class="row bg-danger" style=" height:auto;
        background: url({{asset('img/p3.jpg')}});
        background-repeat: no-repeat; background-size: 100%"> --}}
        <div
        class="bg-image p-5 shadow-1-strong rounded mb-5 text-white"
        style="background: url({{asset('img/globe.png')}});  width:100wh; height:60vh;
               background-color: #E6E6FA; background-position: bottom 50px right 30px; background-repeat: no-repeat;">
            <div class="row">
                <div class="mt-5 col-6 text-dark align-self-center">
                    <h2>Languages...</h2>
                    <h5 class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus vel, officiis cupiditate quod saepe est laborum ducimus earum, ex dicta consequatur perspiciatis reprehenderit hic, animi expedita fugit quae! Rem, aliquam.</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
