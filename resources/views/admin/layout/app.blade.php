<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- fontawesome css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container-fluid g-1">
        {{-- <div class="row"> --}}
            <nav class="navbar text-center bg-light-subtle pe-2 sticky-top">
                <div class="nav-item  text-primary m-3">
                    <a href="http://" class="nav-link">
                        <h3>Admin</h3>
                    </a>
                </div>
            </nav>
        {{-- </div> --}}

        <div class="row">
            <nav class="col-3 pe-2 bg-light-subtle">
                <ul class="list-group">
                    <a href="{{route('admin.dashboard')}}" class="list-group-item">
                        <i class="fa-solid fa-house-flag"></i>
                        <span class="d-none d-lg-inline">Dashboard</span>
                    </a>
                    <a href="{{route('users.manage')}}" class="list-group-item">
                        <i class="fa-solid fa-people-group"></i>
                        <span class="d-none d-lg-inline">Users</span>
                    </a>
                    <a href="{{route('library.manage')}}" class="list-group-item">
                        <i class="fa-solid fa-book-open"></i>
                        <span class="d-none d-lg-inline">Library</span>
                    </a>
                    <a href="{{route('programs.manage')}}" class="list-group-item">
                        <i class="fa-solid fa-list"></i>
                        <span class="d-none d-lg-inline">Programs</span>
                    </a>
                    <a href="{{route('admin.courses.manage')}}" class="list-group-item">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @yield('J_Script')
</body>
</html>
