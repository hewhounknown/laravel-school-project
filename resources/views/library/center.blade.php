@extends('layout.app')

@section('title', 'library')

@section('content')
    <h1>Library</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container my-4">
        <div class="row">
            <div class="col-md mt-2">
                <form class="input-group">
                    <input id="search" class="form-control p-3 w-75" type="text" placeholder="What are you looking for..." aria-label="Add your item here...">
                    <button type="button" class="w-25 btn btn-secondary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                </form>
            </div>
            <div class="col-md mt-2">
                @guest
                <div class="text-center">
                    <a href="{{route('login')}}"  class="w-100 p-3  btn btn-outline-success rounded">
                       Firstly, You need to login here &nbsp; &nbsp; <i class="fa-solid fa-arrow-right-to-bracket fa-lg"></i>
                    </a>
                </div>
                @else
                <div class="text-center">
                    <button  class="w-100 p-3  btn btn-outline-info rounded" data-bs-toggle="modal" data-bs-target="#bookAdd">
                        <i class="fa fa-book" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
                @endguest
            </div>
        </div>

        <div id="bookAdd" class="modal" tabindex="-1">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" action="{{route('book.add')}}" method="post">
                    @csrf
                    <div class="modal-body">
                            <div class="mt-2">
                                <label for="coverImg">Cover Image</label>
                                <img id="coverImg" src="{{asset('img/default.png')}}" alt="profile picture" class="rounded d-block mb-2"  style="width:27rem; hieght: 35rem;">
                                <input type="file" name="bookCover" id="bookCover" class="form-control d-none" onchange="readURL(this)">
                            </div>
                            <div class="mt-2">
                                <label for="bookName">Book Name</label>
                                <input type="text" name="bookName" id="bookName" class="form-control">
                            </div>
                            <div class="mt-2">
                                <label for="authorName">Author Name</label>
                                <input type="text" name="authorName" id="authorName" class="form-control">
                            </div>
                            <div class="mt-2">
                                <label for="book">Add your book here</label>
                                <input type="file" name="book" id="book" class="form-control">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                        <button type="submit" class="btn btn-primary w-25"><i class="fa fa-check" aria-hidden="true"></i></button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
    {{-- book lists start --}}
    <div class="container mt-3">
        <div class="row">
            @foreach ($books as $book)
            <div class="col-6 col-md-3">
                <a href="{{route('book.view', $book->id)}}" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        @if ($book->cover == null)
                        <img src="{{asset('img/default.png')}}" class="card-img-top" style="width:15rem; height: 10rem" alt="...">
                        @else
                        <img src="{{asset('storage/library/cover/'.$book->cover)}}" class="card-img-top" style="width:15rem; height: 10rem" alt="..." >
                        @endif
                        <div class="card-body">
                         <h6>{{$book->book_name}}</h6>
                         <p>by {{$book->author_name}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    {{-- book lists end --}}

    <script>
        document.getElementById('coverImg').addEventListener('click', e =>{
            document.getElementById('bookCover').click();
        })

        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();
                //let img = document.getElementById('img');

                reader.onload = e => $('#coverImg').attr('src', e.target.result);

                reader.readAsDataURL(input.files[0]);
                //console.log(reader);
            }
        }
    </script>

@endsection
