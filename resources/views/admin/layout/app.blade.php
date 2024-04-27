<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- fontawesome css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>

    </style>
</head>

<body>
    <div class="container-fluid g-1">
        <nav class="navbar text-center bg-light-subtle pe-2 sticky-top">
            <div class="nav-item  text-primary m-3">
                <a href="http://" class="nav-link">
                    <h3>Admin</h3>
                </a>
            </div>

            <div class="navbar nav">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><i
                            class="fa-solid fa-arrow-right-to-bracket"></i></a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-circle-user"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('admin.profile.view') }}" class="dropdown-item">Profile</a>
                        </li>
                        <li>
                            <div class="">
                                <a href="" class="dropdown-item"
                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </div>
        </nav>

        <div class="row">
            <nav class="col-3 pe-2 bg-light-subtle fs-6">
                <ul style="position: fixed; top: auto; width:23%">
                    <a href="{{ route('admin.dashboard') }}"
                        class="btn w-75 p-2 shadow-sm my-2 me-4 bg-body-tertiary pageBtn">
                        <i class="fa-solid fa-house-flag"></i>
                        <span class="d-none d-lg-inline">Dashboard</span>
                    </a>
                    <a href="{{ route('users.manage') }}"
                        class="btn w-75 p-2 shadow-sm my-2 me-4 bg-body-tertiary pageBtn">
                        <i class="fa-solid fa-people-group"></i>
                        <span class="d-none d-lg-inline">Users</span>
                    </a>
                    <a href="{{ route('library.manage') }}"
                        class="btn w-75 p-2 shadow-sm my-2 me-4 bg-body-tertiary pageBtn">
                        <i class="fa-solid fa-book-open"></i>
                        <span class="d-none d-lg-inline">Library</span>
                    </a>
                    <a href="{{ route('programs.manage') }}"
                        class="btn w-75 p-2 shadow-sm my-2 me-4 bg-body-tertiary pageBtn">
                        <i class="fa-solid fa-list"></i>
                        <span class="d-none d-lg-inline">Programs</span>
                    </a>
                    <a href="{{ route('admin.courses.manage') }}"
                        class="btn w-75 p-2 shadow-sm my-2 me-4 bg-body-tertiary pageBtn">
                        <i class="fa-solid fa-folder"></i>
                        <span class="d-none d-lg-inline">Courses</span>
                    </a>
                </ul>
            </nav>

            <main class="col-9 bg-body-tertiary rounded shadow">


                @yield('content')
            </main>
        </div>
    </div>


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

    {{-- for  ckeditor --}}
    <script src="{{ asset('school/js/ckeditor.js') }}"></script>

    <script>
        $(document).ready(function() {

            function setActiveClass() {
                let currentUrl = window.location.href;

                $('.pageBtn').removeClass('active');

                $('.pageBtn').each(function() {
                    let btnHref = $(this).attr('href');
                    if (btnHref === currentUrl) {
                        $(this).addClass('active');
                    }
                });
            }

            setActiveClass();

            $('.pageBtn').on('click', function(e) {
                e.preventDefault();
                window.location.href = $(this).attr('href');
            });
        });
    </script>

    @yield('J_Script')
</body>

</html>
