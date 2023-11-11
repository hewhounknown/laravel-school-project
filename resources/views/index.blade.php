@extends('app')

@section('title', 'school')

@section('content')
    <div id="myCarousel" class="carousel slide" data-slide="carousel" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item">
                <img class="d-block w-100" style="height: 300px;" src="{{asset('img/p2.jpg')}}" alt="First slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block w-100" style="height: 300px;" src="{{asset('img/p2.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" style="height: 300px;" src="{{asset('img/p3.jpg')}}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> <br> <br> <br>

    <div class="container">
        <div class="row my-5 justify-content-around" style="height: 400px;">
            <div class="col">
                <div class="card">
                    <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
        </div>

        <div class="row my-5 justify-content-evenly" style="height: 400px;">
            <div class="col-4 d-sm-block">
                <h3>Lorem, ipsum dolor sit amet consectetur</h3> <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus tempore ad nobis quisquam natus sed impedit, quod ipsum neque consequatur culpa non eveniet eos recusandae. Eaque aspernatur modi nemo vel.Sit harum suscipit minus asperiores animi quos commodi officiis voluptas reiciendis obcaecati, quas, quaerat illo facilis molestiae. Expedita alias accusantium modi officia. Delectus, laborum repellendus qui nulla laudantium provident iste!</p>
                <a href="" class="w-25 btn btn-outline-primary float-end">
                    <span>more...</span>
                </a>
            </div>
            <div class="col-4 d-sm-block">
                <div>
                    <img src="{{asset('img/default.png')}}" alt="" style="height: 400px;" class="w-100 rounded shadow">
                </div>
            </div>
        </div>

        <div class="row my-5 justify-content-evenly " style="height: 400px;">
            <div class="col-4 d-sm-block">
                <div>
                    <img src="{{asset('img/default.png')}}" alt="" style="height: 400px;" class="w-100 rounded shadow">
                </div>
            </div>
            <div class="col-4 d-sm-block">
                <h3>Lorem, ipsum dolor sit amet consectetur</h3> <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus tempore ad nobis quisquam natus sed impedit, quod ipsum neque consequatur culpa non eveniet eos recusandae. Eaque aspernatur modi nemo vel.Sit harum suscipit minus asperiores animi quos commodi officiis voluptas reiciendis obcaecati, quas, quaerat illo facilis molestiae. Expedita alias accusantium modi officia. Delectus, laborum repellendus qui nulla laudantium provident iste!</p>
                <a href="" class="w-25 btn btn-outline-primary float-end">
                    <span>more...</span>
                </a>
            </div>
        </div>
    </div>

@endsection
