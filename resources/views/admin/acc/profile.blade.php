<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Profile</title>

        {{-- bootstrap css --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        {{-- fontawesome css  --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav class="navbar p-3 text-primary-emphasis bg-primary-subtle sticky-top">
        <div class="nav-item ms-3 fs-4">
            <a href="http://" onclick="history.back(); return false;" title="Go back">
                <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
            </a>
        </div>
    </nav>

    <main>

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

        <div class="card m-5 shadow-sm position-relative">
            <div class="row p-2">
                <div class="col-sm-4 text-center">
                    @if (Auth::user()->image != null)
                    <img src="{{asset('storage/uploads/'.Auth::user()->image)}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                    @else
                    <img src="{{asset('img/default.png')}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                    @endif
                </div>
                <div class="col-sm-8 p-2 mt-2">
                    <div class="mb-2">
                        <h3> {{Auth::user()->name}} | <i class="fa-solid fa-user-tie"></i> </h3>
                    </div>
                    <div class="mb-2">
                        <i class="fa-solid fa-envelope"></i>  <small>{{Auth::user()->email}}</small>
                    </div>
                    @if (Auth::user()->address != null)
                    <div class="mb-2">
                        <i class="fa-solid fa-location-dot"></i> <small>{{Auth::user()->address}}</small>
                    </div>
                    @endif
                    @if (Auth::user()->phone != null)
                    <div class="mb-2">
                        <i class="fa-solid fa-mobile"></i> <small>{{Auth::user()->phone}}</small>
                    </div>
                    @endif
                </div>
            </div>
            <span class="position-absolute top-0 end-0" style="width: auto;">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="fa-solid fa-pen-fancy fa-xl"></i>
                </button>
            </span>

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 730px;">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Edit form</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('profile')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row justify-content-evenly">
                                <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                <div class="col-sm-4">
                                    @if (Auth::user()->image == null)
                                        <img id="img" src="{{asset('img/defaultprofile.jpg')}}" alt="profile picture" class="rounded img-fluid mx-auto d-block mb-2"  style="max-width:230px; max-hieght: 140px;">
                                    @else
                                        <img id="img" src="{{asset('storage/uploads/'.Auth::user()->image)}}" alt="profile picture" class="rounded img-fluid mx-auto d-block mb-2"  style="max-width:230px; max-hieght: 140px;">
                                    @endif
                                    <div>
                                        {{-- <input type="file" name="image" id="" class="form-control"> --}}
                                        <input type="file" name="image" id="" class="form-control" onchange="readURL(this)">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-2">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-2">
                                        <label for="phone" class="form-label">{{ __('phone') }}</label>
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', Auth::user()->phone) }}" autocomplete="phone">
                                    </div>
                                    <div class="mb-2">
                                        <label for="address" class="form-label">{{ __('address') }}</label>
                                        <textarea name="address" id="" class="form-control" cols="30" rows="10">{{ old('address',Auth::user()->address) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>

        <div class="container mb-5">
            <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
                <h3 class="default border-bottom border-primary">Your courses</h3>
                @foreach (Auth::user()->courses as $c)
                <div class="col-md-3 mx-5 my-3">
                    <div class="card " style="width: 20rem;">
                        @if ($c->course_image == null)
                            <img src="{{asset('img/default.png')}}" class="card-img-top" alt="...">
                        @else
                            <img src="{{asset('storage/course/'.$c->course_image)}}" class="card-img-top" style="height: 10rem" alt="..." >
                        @endif
                        <div class="card-body" style="height: 9rem">
                            <h5 class="card-title">{{$c->course_name}}</h5>
                            <p class="card-text">{{$c->course_description}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </main>



    {{-- bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    {{-- jQuery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js" integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function readURL(input){
                if(input.files && input.files[0]){
                    let reader = new FileReader();
                    //let img = document.getElementById('img');

                    reader.onload = e => $('#img').attr('src', e.target.result);

                    reader.readAsDataURL(input.files[0]);
                    //console.log(reader);
                }
            }
    </script>
</body>
</html>
