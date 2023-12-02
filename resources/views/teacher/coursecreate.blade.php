@extends('layout.app')

@section('title', 'course create')

@section('content')
    <h1>course create form</h1>

    <div class="container">
        {{-- <div class="row border"> --}}
            <form action="" method="post">
                @csrf

                <div class="row border justify-content-around p-3">

                    <div class="col-12 mt-3">
                        <select name="" id="" class="form-select">
                            @foreach ($category as $cat)
                                <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-6 mt-3">
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="col-6 mt-3">
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="col-6 mt-3">
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="col-6 mt-3">
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </form>
        {{-- </div> --}}
    </div>
@endsection
