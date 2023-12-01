<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- Bootstrap core CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
     integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
     integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
     crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
     integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
     crossorigin="anonymous"></script>


    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

        /* GLOBAL STYLES
        --------------------------------------------- */
        /* Padding below the footer and lighter body text */

        body {
          padding-top: 3rem;
          padding-bottom: 3rem;
          color: #5a5a5a;
        }


        /* CUSTOMIZE THE CAROUSEL
        -------------------------------------------- */

        /* Carousel base class */
        .carousel {
          margin-bottom: 4rem;
        }

        /* Since positioning the image, we need to help out the caption */
        .carousel-caption {
          bottom: 3rem;
          z-index: 10;
        }

        /* Declare heights because of positioning of img element */
        .carousel-item {
          height: 32rem;
        }

        .carousel-item>img {
          position: absolute;
          top: 0;
          left: 0;
          min-width: 100%;
          height: 32rem;
        }


        /* MARKETING CONTENT
    -------------------------------------------------- */

        /* Center align the text within the three columns below the carousel */
        .marketing .col-lg-4 {
          margin-bottom: 1.5rem;
          text-align: center;
        }

        .marketing h2 {
          font-weight: 400;
        }

        .marketing .col-lg-4 p {
          margin-right: .75rem;
          margin-left: .75rem;
        }


        /* Featurettes
    ------------------------- */

        .featurette-divider {
          margin: 5rem 0;
          /* Space out the Bootstrap <hr> more */
        }

        /* Thin out the marketing headings */
        .featurette-heading {
          font-weight: 300;
          line-height: 1;
          letter-spacing: -.05rem;
        }


        /* RESPONSIVE CSS
    -------------------------------------------------- */

        @media (min-width: 40em) {

          /* Bump up size of carousel content */
          .carousel-caption p {
            margin-bottom: 1.25rem;
            font-size: 1.25rem;
            line-height: 1.4;
          }

          .featurette-heading {
            font-size: 50px;
          }
        }

        @media (min-width: 62em) {
          .featurette-heading {
            margin-top: 7rem;
          }
        }
      </style>

      <!-- Custom styles for this template -->
      <link href="carousel.css" rel="stylesheet">
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-md bg-body-tertiary  mx-1">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="{{route('home')}}">School</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
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
                    <div class="d-block ms-lg-auto align-items-center justify-content-end">
                        <a href="#" class="nav-link d-md-inline">About us |</a>
                        <form class="d-inline-flex  mx-2" role="search">
                        <input class="form-control me-2 " type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="mx-2">
                        <li class="nav-item dropdown d-inline-flex btn">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @guest
                                <div class="">
                                    <a href="{{route('register')}}" class="dropdown-item">{{__('Register')}}</a>
                                </div>
                                <div class="">
                                    <a href="{{route('login')}}" class="dropdown-item">{{__('Login')}}</a>
                                </div>
                                @else
                                <div class="">
                                    <a href="{{route('profile')}}" class="dropdown-item">{{Auth::user()->name}}</a>
                                </div>
                                <div class="">
                                    <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                        {{__('Logout')}}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                                @endguest
                            </div>
                        </li>
                    </div>
                </div>
           </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>






    {{-- bootstrap link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
