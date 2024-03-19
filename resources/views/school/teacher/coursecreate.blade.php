@extends('school.layout.app')

@section('title', 'course create')

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container">
        {{-- <div class="row border"> --}}
            <form enctype="multipart/form-data" action="{{route('courseCreate')}}" method="post">
                @csrf
                <input type="hidden" name="teacher" value="{{Auth::user()->name}}">
                <div class="row border justify-content-around p-3 mt-5 rounded">
                    <h4 class="default text-center">create course here!</h4> <hr>
                    <div class="col-12 mt-3">
                        <label for="category" class="form-label">Choose category</label>
                        <select name="category" id="" class="form-select">
                            @foreach ($category as $cat)
                                <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="image">
                            <img id="img" src="{{asset('img/add_image.png')}}" alt="profile picture" class="rounded d-block mb-2"  style="width:20rem; hieght: 38rem;">
                        </label>
                        <input type="file" name="image" id="image" class="form-control" onchange="readURL(this)">
                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="col text-center mt-3">
                        <button type="submit" class="btn btn-outline-dark w-50">Create</button>
                    </div>
                </div>
            </form>
        {{-- </div> --}}
    </div>

    <script>
        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                //let img = document.getElementById('img');

                reader.onload = e => $('#img').attr('src', e.target.result);

                reader.readAsDataURL(input.files[0]);
                //console.log(reader);
            }
        }
    </script>
@endsection
