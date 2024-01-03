@extends('layout.app')

@section('title', 'library')

@section('content')
    <h1>Library</h1>

    <div class="container my-4">
        <div class="row">
            <div class="col">
                <form class="input-group">
                    <input class="form-control p-3" type="text" placeholder="What are you looking for..." aria-label="Add your item here...">
                    <button type="button" class="btn btn-secondary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
                </form>
            </div>
            <div class="col">
                <div class="text-center">
                    <button  class="w-100 p-3  btn btn-outline-info rounded" data-bs-toggle="modal" data-bs-target="#bookAdd">
                        <i class="fa fa-book" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true"></i>
                    </button>
                </div>
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
                  <p>Modal body text goes here.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
        </div>
    </div>
    {{-- book lists start --}}
    <div class="container mt-3">
        <div class="row">
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
