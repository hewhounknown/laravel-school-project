@extends('school.acc.index')

@section('title', Auth::user()->name . "'s profile")

@section('section')


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
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a id="forDash" class="nav-link active" aria-current="page" href="#">
                <i class="fa-solid fa-house"></i>
                <span class="d-none d-lg-inline">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-users"></i>
                <span class="d-none d-lg-inline">Students</span>
            </a>
            {{-- <span class="badge bg-danger rounded-pill float-end text-white d-none d-lg-inline">20</span> --}}
        </li>
        <li class="nav-item">
            <a class="nav-link" aria-disabled="true">
                <i class="fas fa-flag"></i>
                <span class="d-none d-lg-inline">Reports</span>
            </a>
        </li>
    </ul>

    <!-- Modal for edit profile -->
    <div class="modal" id="editForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 730px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Your form content goes here -->
                    <form id="myForm" enctype="multipart/form-data" method="post" action="{{ route('profile') }}">
                        @csrf
                        <div class="row justify-content-evenly">
                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                            <div class="col-4">
                                @if (Auth::user()->image == null)
                                    <img id="img" src="{{ asset('img/defaultprofile.jpg') }}" alt="profile picture"
                                        class="rounded mx-auto d-block mb-2" style="width:20rem; hieght: 38rem;">
                                @else
                                    <img id="img" src="{{ asset('storage/uploads/' . Auth::user()->image) }}"
                                        alt="profile picture" class="rounded mx-auto d-block mb-2"
                                        style="width: 15rem; hieght: 38rem;">
                                @endif
                                <div>
                                    {{-- <input type="file" name="image" id="" class="form-control"> --}}
                                    <input type="file" name="image" id="" class="form-control"
                                        onchange="readURL(this)">
                                </div>
                                <div class="mt-3">
                                    <input type="submit" value="Update" class="btn btn-outline-dark form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" required autocomplete="name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label for="phone" class="form-label">{{ __('phone') }}</label>
                                    <input id="phone" type="number" class="form-control" name="phone"
                                        value="{{ old('phone', Auth::user()->phone) }}" autocomplete="phone">
                                    {{-- @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                                <div class="mb-2">
                                    <label for="address" class="form-label">{{ __('address') }}</label>
                                    <textarea name="address" id="" class="form-control" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                    {{-- @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="content">

    </div>

    <div id="dashboard" class="container">

        <div class="row justify-content-end mb-4">
            <div class="col-3 text-center">
                <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#courseModal">
                    <i class="fa-solid fa-folder-plus"></i>
                </div>
            </div>
        </div>

        {{-- Courses Create modal start --}}
        <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 730px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.course.create') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <select name="programSelected" id="programSelected" class="form-select mb-2">
                                        <option value="">select program</option>
                                        @foreach ($programs as $program)
                                            <option value="{{ $program->id }}">{{ $program->name }}</option>
                                        @endforeach
                                    </select>

                                    <div id="cats" class="my-2">

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-2">
                                        <label for="image">
                                            <img id="img" src="{{ asset('img/add_image.png') }}"
                                                alt="profile picture" class="rounded"
                                                style="width:230px; hieght: 180px;">
                                        </label>
                                        <input type="file" name="courseImage" id="image" class="form-control"
                                            onchange="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Course Name</label>
                                        <input type="text" name="courseName" id=""
                                            class="form-control mb-2">
                                    </div>

                                    <div class="mb-2">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Courses Create modal end --}}

        <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
            <h3 class="default">Your courses</h3>
            @foreach ($courses as $c)
                <div class="col-md-3 m-2">
                    <div class="card " style="">
                        @if ($c->course_image == null)
                            <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="...">
                        @else
                            <img src="{{ asset('storage/course/' . $c->course_image) }}" class="card-img-top"
                                style="height: 10rem" alt="...">
                        @endif
                        <div class="card-body" style="">
                            <h5 class="card-title">{{ $c->course_name }}</h5>
                            <p class="card-text">{{ $c->course_description }}</p>
                            @if ($c->course_status == false)
                                <a href="{{ route('course.detail', $c->id) }}"
                                    class="btn btn-warning bg-warning-subtle text-warning-emphasis">View</a>
                            @else
                                <a href="{{ route('course.detail', $c->id) }}"
                                    class="btn btn-primary bg-info-subtle text-info-emphasis">View</a>
                            @endif
                        </div>
                        {{-- @if ($c->course_status == false)
                            <div class="card-footer bg-warning-subtle text-warning-emphasis">
                                <a href="{{ route('course.detail', $c->id) }}" class="btn btn-warning">View</a>
                            </div>
                        @else
                            <div class="card-footer bg-info-subtle text-info-emphasis">
                                <a href="{{ route('course.detail', $c->id) }}" class="btn btn-primary">View</a>
                            </div>
                        @endif --}}
                    </div>
                </div>
            @endforeach
        </div>

        @if ($list != null)
            <div class="container my-5">
                <div class="row shadow-sm justify-content-md-evenly p-2 bg-body-tertiary rounded">
                    <h3 class="default">Your enrolled courses</h3>

                    @foreach ($list as $l)
                        @foreach ($l['course'] as $course)
                            <div class="col-md-3 m-2">
                                <div class="card " style="">
                                    @if ($course->course_image == null)
                                        <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="...">
                                    @else
                                        <img src="{{ asset('storage/course/' . $course->course_image) }}"
                                            class="card-img-top" style="height: 10rem" alt="...">
                                    @endif
                                    <div class="card-body" style="">
                                        <h5 class="card-title">{{ $course->course_name }}
                                            <span
                                                class="badge text-bg-secondary">{{ $course->category->category_name }}</span>
                                        </h5>
                                        <p class="card-text">{{ $course->course_description }}</p>
                                        @if ($l['enroll']->status == false)
                                            <a href="//" class="btn btn-outline-dark" data-bs-toggle="modal"
                                                data-bs-target="#enrollModal">pls wait</a>

                                            <div id="enrollModal" class="modal" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Modal title</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>You can unenroll this {{ $course->course_name }} , Do you
                                                                want to?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancle</button>
                                                            <a href="{{ route('course.unenroll', $course->id) }}"
                                                                type="button" class="btn btn-primary">Unenroll</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <a href="{{ route('courseDetail', $course->id) }}"
                                                class="btn btn-outline-primary">View Courses</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        @endif
    </div>



@endsection

@section('J_Script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                //let img = document.getElementById('img');

                reader.onload = e => $('#img').attr('src', e.target.result);

                reader.readAsDataURL(input.files[0]);
                //console.log(reader);
            }
        }

        $(document).ready(function() {
            $('.nav-link').on('click', function(e) {
                e.preventDefault();

                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                let choice = $(this).text();

                console.log($(this).attr('id'));

                if ($(this).attr('id') == 'forDash') {
                    console.log('lll');
                    $('#content').hide();
                    $('#dashboard').show();
                } else {
                    $('#content').show();
                    $('#dashboard').hide();

                    let studentKickRoute =
                        "{{ route('student.kick', ['studentId' => ':studentId', 'courseName' => ':courseName']) }}";
                    let studentAcceptRoute =
                        "{{ route('student.accept', ['studentId' => ':studentId', 'courseName' => ':courseName']) }}";
                    let studentProfileRoute = "{{ route('profile.view', ['id' => ':id']) }}";

                    $.ajax({
                        url: 'http://localhost:8000/select/choices',
                        type: 'GET',
                        data: {
                            'userChoice': choice
                        },
                        success: function(response) {
                            console.log(response);

                            $content = '';
                            if (response.students) {
                                console.log(response.student);

                                Object.entries(response.students).forEach(([course,
                                    enrolls
                                ]) => { //change obj to arr and loop
                                    //console.log(jQuery.type(students));
                                    $content += `<div class="card m-3">
                                                <div class="card-header">
                                                   <h4 class="text-primary-emphasis">${course}</h4>
                                                </div>
                                                <div class="card-body">
                                                    <table class="table table-striped text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th></th>
                                                                <th>Control</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>`;
                                    enrolls.forEach(enroll => {
                                        console.log(enroll.enrollStatus);
                                        $content += `
                                                                        <tr>
                                                                            <td>
                                                                                <a href="${studentProfileRoute.replace(':id', enroll.stuInfo.id)}"
                                                                                    class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                                                                    ${enroll.stuInfo.name}
                                                                                </a>
                                                                            </td>
                                                                            <td></td>`;
                                        if (enroll.enrollStatus) {
                                            $content += `<td>
                                                                                                <a href="${studentKickRoute.replace(':studentId', enroll.stuInfo.id).replace(':courseName', course)}" class="btn btn-outline-danger">
                                                                                                    Kick
                                                                                                </a>
                                                                                                <a href="" class="btn btn-outline-warning">
                                                                                                    Ban
                                                                                                </a>
                                                                                            </td>`;
                                        } else {
                                            $content += `<td>
                                                                                                <a class="btn btn-outline-primary" href="${studentAcceptRoute.replace(':studentId', enroll.stuInfo.id).replace(':courseName', course)}">
                                                                                                    Accept
                                                                                                </a>
                                                                                                <a class="btn btn-outline-danger" href="http://">
                                                                                                    Cancle
                                                                                                </a>
                                                                                            </td>`;
                                        }
                                        $content += ` </tr>`;
                                    })
                                    $content += `</tbody>
                                                    </table>
                                                </div>
                                            </div>`;
                                })

                            } else if (response.reports) {
                                console.log(response);
                                $content = `<h4>Re,w,v</h4>`;
                            } else {
                                console.log($('#dashboard'));
                            }

                            $('#content').html($content);
                        }
                    });
                }

            });

            $('#programSelected').on('change', function() {
                let programId = $(this).val();
                console.log(programId);

                $.ajax({
                    url: 'http://localhost:8000/teacher/categories/take',
                    type: 'GET',
                    data: {
                        'selectProgramId': programId
                    },
                    success: function(cats) {
                        $catsList = '<label class="d-block">choose Category :</label>';
                        //console.log(cats);
                        cats.forEach(cat => {
                            $catsList += `
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="catId" id="cat${cat.id}" value="${cat.id}">
                                    <label class="form-check-label" for="cat">
                                      ${cat.category_name}
                                    </label>
                                </div>`;
                        });
                        $('#cats').html($catsList);
                    }
                })
            });

        });
    </script>
@endsection
