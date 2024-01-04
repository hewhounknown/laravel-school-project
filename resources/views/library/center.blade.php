@extends('layout.app')

@section('title', 'library')

@section('content')
    <h1>Library</h1>

    <div class="container my-4">
        <div class="row">
            <div class="col-md mt-2">
                <form class="input-group">
                    <input class="form-control p-3 w-75" type="text" placeholder="What are you looking for..." aria-label="Add your item here...">
                    <button type="button" class="w-25 btn btn-secondary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                </form>
            </div>
            <div class="col-md mt-2">
                @guest
                <div class="text-center">
                    <a href="{{route('login')}}"  class="w-100 p-3  btn btn-outline-info rounded">
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
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="" method="post">
                        @csrf
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
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                  <button type="button" class="btn btn-primary w-25"><i class="fa fa-check" aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
        </div>
    </div>
    {{-- book lists start --}}
    <div class="container mt-3">
        <div class="row">
            <div class="col-6 col-md-3">
                <a href="{{route('book.view')}}" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3">
                <a href="http://" class="btn">
                    <div class="card" style="max-width: 18rem;">
                        <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    {{-- book lists end --}}


@endsection