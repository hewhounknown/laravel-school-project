<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .nav-j{
           justify-content: center;
        }
     </style>
</head>

<body>
        <nav class="navbar navbar-expand-md bg-body-tertiary sticky-top mx-1">
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

          @yield('content')





    {{-- bootstrap link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
