<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .nav-j{
           justify-content: center;
        }
     </style>
</head>

<body>

        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="{{route('home')}}">School</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-lg-flex d-sm-block" id="navbarNavAltMarkup">
                    <ul class="navbar-nav w-50 justify-content-evenly fs-4">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Programmes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('languages')}}">Languages</a></li>
                                <li><a class="dropdown-item" href="school">IT</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Opportunities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Library</a>
                        </li>
                    </ul>
                    <div class="d-lg-flex d-sm-block ms-lg-auto align-items-center justify-content-end">
                        <a href="#" class="nav-link d-inline-flex ">About us |</a>
                        <form class="d-inline-flex  mx-2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
           </div>

    </nav>
    {{-- </div> --}}

    {{-- <div class="container-fluid text-center" > --}}
        {{-- <div id="myCarousel" class="carousel slide" data-slide="carousel" data-ride="carousel">
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
          </div> --}}
          @yield('content')
    {{-- </div> --}}
    {{-- style="height: 300px;" width: 80%" --}}




    {{-- bootstrap link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
