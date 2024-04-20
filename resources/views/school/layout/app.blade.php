<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- for  ckeditor --}}
    <script src="{{ asset('school/js/ckeditor.js') }}"></script>

    @yield('Css')

</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary ">
            <div class="container-fluid">
                <a class="navbar-brand fs-3" href="{{ route('home') }}">School</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        @if ($programs->isEmpty())
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Programmes </a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Programmes
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($programs as $program)
                                        <li><a class="dropdown-item"
                                                href="{{ route('course.list', $program->id) }}">{{ $program->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('library') }}" class="nav-link">
                                Library <i class="fa-solid fa-book-open-reader"></i>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Activities</a>
                        </li>
                    </ul>
                    <div class="ms-md-auto">
                        <ul class="navbar-nav d-flex">
                            @guest
                            @else
                                @if (Auth::user()->role == 'admin')
                                    <li class="nav-item">
                                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                            <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                        </a>
                                    </li>
                                @endif
                            @endguest
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @guest
                                        <div class="">
                                            <a href="{{ route('register') }}" class="dropdown-item">{{ __('Register') }}</a>
                                        </div>
                                        <div class="">
                                            <a href="{{ route('login') }}" class="dropdown-item">{{ __('Login') }}</a>
                                        </div>
                                    @else
                                        <div class="">
                                            <a href="{{ route('profile') }}"
                                                class="dropdown-item">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="">
                                            <a href="" class="dropdown-item"
                                                onclick="event.preventDefault();
                                                                        document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    @endguest
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <main>
        @yield('content')
    </main>






    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('J_Script')
</body>

</html>
