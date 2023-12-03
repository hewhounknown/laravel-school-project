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
                        <label for="category" class="form-label">Choose category</label>
                        <select name="categroy" id="" class="form-select">
                            @foreach ($category as $cat)
                                <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="image">
                            <img id="img" src="{{asset('img/add_image.png')}}" alt="profile picture" class="rounded d-block mb-2"  style="width:20rem; hieght: 38rem;">
                        </label>
                        <input type="file" name="image" id="image" class="form-control d-none" onchange="readURL(this)">

                    </div>

                    <div class="col-md-6 mt-3">
                        <div class="mb-3">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
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
