@extends('school.layout.app')

@section('title', $course->course_name)

@section('Css')
    <style>
        .rating {
            font-size: 24px;
        }

        .rating .fa-star {
            color: #ccc;
            cursor: pointer;
        }

        .rating .fa-star:hover {
            color: #FFD700;
        }

        .rating .fa-star.checked {
            color: #FFD700;
        }
    </style>
@endsection

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($course->course_status == false)
        @if (count($course->topics) < 3)
            <div class="alert alert-warning d-flex align-items-center m-3" role="alert">
                <i class="fa-solid fa-circle-info"></i> &ThickSpace;
                <div>
                    your course must have at least 3 topic for admin approve.
                </div>
            </div>
        @else
            <div class="alert alert-success d-flex align-items-center m-3" role="alert">
                <i class="fa-solid fa-circle-info"></i> &ThickSpace;
                <div>
                    please, wait for admin approve.
                </div>
            </div>
        @endif
    @endif

    <div class="container mt-5 ">
        <div class="row align-items-center justify-content-center shadow-lg p-3 rounded position-relative ">
            <div class="col-5">
                @if ($course->course_image == null)
                    <img src="{{ asset('img/default.png') }}" class="img-fluid" style="width: 230px; height: 170px"
                        alt="">
                @else
                    <img src="{{ asset('storage/course/' . $course->course_image) }}" class="img-fluid"
                        style="width: 230px; height: 170px" alt="">
                @endif
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-sm-3"><strong>Name</strong></div>
                    <div class="col-sm-9">{{ _($course->course_name) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>Category</strong></div>
                    <div class="col-sm-9">{{ _($course->category->category_name) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>By</strong></div>
                    <div class="col-sm-9">
                        <a href="{{ route('profile.view', $course->teacher->id) }}"
                            class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                            {{ _($course->teacher->name) }}
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>Date</strong></div>
                    <div class="col-sm-9">{{ _($course->created_at->format('d/m/y')) }}</div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-sm-3"><strong>Description</strong></div>
                <div class="col-sm-9">{{ _($course->course_description) }}</div>
            </div>

            @if ($course->user_id == Auth::user()->id)
                <span class="position-absolute top-0 end-0" style="width: auto;">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#controlModal">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                </span>

                <!-- Modal -->
                <div class="modal fade" id="controlModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Control</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row justify-content-between p-2">
                                    <div class="col-4">
                                        <button type="button" class="btn btn-outline-info w-100" data-bs-toggle="modal"
                                            data-bs-target="#editCourseModal">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </button>
                                    </div>
                                    <div class="col-4">
                                        <a href="{{ route('teacher.course.delete', $course->id) }}"
                                            class="btn btn-outline-danger w-100">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 730px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form enctype="multipart/form-data" action="{{ route('teacher.course.edit') }}" method="post">
                                @csrf
                                <input type="hidden" name="courseId" value="{{ $course->id }}">
                                <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <select name="programSelected" id="programSelected" class="form-select mb-2">
                                                {{-- <option value="">select program</option> --}}
                                                @foreach ($programs as $program)
                                                    <option value="{{ $program->id }}"
                                                        {{ $course->category->program->id == $program->id ? 'selected' : '' }}>
                                                        {{ $program->name }}</option>
                                                @endforeach
                                            </select>

                                            <h2 id="chosenCat" class="visually-hidden">{{ $course->category_id }}</h2>
                                            <div id="cats" class="my-2">

                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mt-2">
                                                <label for="image">
                                                    @if ($course->course_image == null)
                                                        <img src="{{ asset('img/default.png') }}" class="img-fluid"
                                                            style="" alt="">
                                                    @else
                                                        <img src="{{ asset('storage/course/' . $course->course_image) }}"
                                                            class="img-fluid" style="" alt="">
                                                    @endif
                                                </label>
                                                <input type="file" name="courseImage" id="image"
                                                    class="form-control" onchange="">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label for="" class="form-label">Course Name</label>
                                                <input type="text" name="courseName" id=""
                                                    class="form-control mb-2"
                                                    value="{{ old('courseName', $course->course_name) }}">
                                            </div>

                                            <div class="mb-2">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea id="description" name="description" class="form-control" cols="30" rows="10">{{ old('description', $course->course_description) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if (Auth::user()->id != $course->user_id)
                @if (count(Auth::user()->enrollments) < 1)
                    <div class="">
                        <a href="{{ route('course.enroll', $course->id) }}"
                            class="btn btn-outline-primary float-end">Enroll Now</a>
                    </div>
                @else
                    <div>
                        <a href="{{ route('course.unenroll', $course->id) }}"
                            class="btn btn-outline-danger float-end">Unenroll</a>
                    </div>
                @endif
            @endif

        </div>
    </div>

    <ul class="nav nav-tabs mt-4">
        <li class="nav-item">
            <a id="topic" class="nav-link active" aria-current="page" href="#">Topics</a>
        </li>
        <li class="nav-item">
            <a id="mates" class="nav-link" href="#">Classmates</a>
        </li>
        <li class="nav-item">
            <a id="reviews" class="nav-link" href="#">Reviews</a>
        </li>
    </ul>

    <input type="hidden" id="courseId" value="{{ $course->id }}">

    <div id="pannel" class="container my-3">

    </div>

    <div id="topicPannel">
        @if ($course->user_id == Auth::user()->id)
            <div class="row mt-5 justify-content-start">
                <div class="col-3 text-center">
                    <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#topicModal">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>
                </div>
            </div>

            {{-- topic modal start --}}
            <div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" style="max-width: 720px">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Topic Create</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form enctype="multipart/form-data" action="{{ route('teacher.topic.create') }}" method="post"
                            class="Input">
                            @csrf
                            <input type="hidden" name="courseId" value="{{ $course->id }}">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="mb-2 col-sm-6">
                                        <label for="topicName">Topic Name</label>
                                        <input type="text" name="topicName" id="" class="form-control">
                                    </div>
                                    <div class="mb-2 col-sm-6">
                                        <label for="topicDescription">Topic Description</label>
                                        <textarea name="topicDescription" class="form-control" id="" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <hr>

                                <div class="mb-2">
                                    <label for="contentTitle">Content Title</label>
                                    <input type="text" name="contentTitle" id="" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="contentType">Content Type</label>
                                    <select id="selectContentType" name="contentType" class="form-select">
                                        <option value="text">Text</option>
                                        <option value="file">File</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                                <div class="mb-2" id="textArea">
                                    <label for="contentBody">Content</label>
                                    <textarea name="contentBody" class="form-control textContent" id="textContent" cols="30" rows="5"></textarea>
                                </div>
                                <div class="mb-2" id="fileArea">
                                    <label for="contentBody">Content</label>
                                    <input type="file" name="contentBody" id="" class="form-control">
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary Input">Create</button>
                            </div>
                        </form>
                        <div id="spinner" class="text-center m-5 spin">
                            <div class="spinner-border text-info" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- topic modal end --}}
        @endif


        @if (Auth::user()->id == $course->user_id || $enrollStatus == true)
            {{-- Topic session start --}}
            <div class="container mt-5">
                <div class="row shadow-lg p-3 rounded">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @if ($course->topics->isEmpty())
                            <h2 class="default">There are no topic to learn</h2>
                        @else
                            @foreach ($course->topics as $t)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $t->id }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $t->id }}"
                                            aria-expanded="true" aria-controls="collapse{{ $t->id }}">
                                            {{ $t->topic_name }}
                                        </button>
                                    </h2>

                                    {{-- content session start --}}
                                    <div id="collapse{{ $t->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $t->id }}" data-bs-parent="#accordionTopics">
                                        <div class="accordion-body">
                                            {{ $t->topic_description }}
                                            <div>
                                                <table class="table table-hover">
                                                    <tbody>
                                                        @foreach ($t->contents as $content)
                                                            <hr> <a href="{{ route('contentView', $content->id) }}">
                                                                <tr>{{ $content->title }}</tr>
                                                            </a>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>

                                            @if (Auth::user()->id == $t->course->user_id)
                                                <div class="my-2" style="height: 3rem">
                                                    <button class="btn btn-outline-dark float-end mb-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#addContentModal{{ $t->id }}">+
                                                        content</button>
                                                </div>
                                                {{-- modal for add content start --}}
                                                <div class="modal fade" id="addContentModal{{ $t->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal
                                                                    title</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form id="contentInput" class="contentInput"
                                                                enctype="multipart/form-data"
                                                                action="{{ route('teacher.content.add') }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="topicId"
                                                                        value="{{ $t->id }}">

                                                                    <div class="mb-3">
                                                                        <label for="contentTitle">Title</label>
                                                                        <input type="text" name="contentTitle"
                                                                            id="contentTitle" class="form-control">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <select id="selectBox" name="contentType"
                                                                            class="form-select choiceContentType"
                                                                            aria-label="Default select example">
                                                                            <option selected>Choose your content type
                                                                            </option>
                                                                            <option value="text">Text</option>
                                                                            <option value="video">video</option>
                                                                            <option value="image">image</option>
                                                                            <option value="file">file</option>
                                                                        </select>
                                                                    </div>

                                                                    <div id="textBox" class="mb-3 textBox">
                                                                        <label for="contentBody">content</label>
                                                                        <textarea name="contentBody" id="contentBody" cols="30" rows="10" class="form-control contentBody"></textarea>
                                                                    </div>

                                                                    <div id="inputFile" class="mb-3 inputFile">
                                                                        <label for="contentBody">content</label>
                                                                        <input type="file" name="contentBody"
                                                                            id="contentBody" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-outline-primary">Save</button>
                                                                </div>
                                                            </form>

                                                            <div id="spinner" class="text-center m-5 spin">
                                                                <div class="spinner-border text-info" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal for add content end --}}
                                            @endif

                                        </div>
                                    </div>
                                    {{-- content session end --}}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            {{-- topic session end --}}
        @else
            <h5 class="text-center text-muted bg-white shadow-sm p-3">
                You need to enroll and wait a while for you're accepted by the teacher!
            </h5>
        @endif
    </div>

    <div class="container mt-5">
        <ul class="list-group">
            <li class="list-group-item bg-info-subtle text-info-emphasis fs-5" aria-current="true">Reviews <span
                    class="badge text-bg-info">{{ count($course->reviews) }}</span></li>
            @foreach ($course->reviews as $review)
                <li class="list-group-item">
                    <a href="{{ route('profile.view', $review->user_id) }}"
                        class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                        <b>{{ $review->user->name }}</b>
                    </a>
                    <div class="row mt-2">
                        <div class="col-8">
                            {{ $review->comment }}
                        </div>
                        <div class="col-4">
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span class="fa fa-star" style="color: #FFD700"></span>
                            @endfor
                        </div>
                    </div>
                    @if ($review->user_id == Auth::user()->id)
                        <a href="{{ route('course.review.delete', $review->id) }}"
                            class="btn btn-sm btn-outline-danger mt-2 float-end">
                            <i class="fa-solid fa-delete-left"></i>
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>

        @if (count(Auth::user()->reviews) < 1 && Auth::user()->id != $course->user_id && $enrollStatus == true)
            <form class="mt-3" action="{{ route('course.review.create') }}" id="addStar" method="POST">
                @csrf
                <input type="hidden" name="courseId" value="{{ $course->id }}">
                <h5 class="border-bottom border-info">Review here:</h5>
                <div class="rating">
                    <label for="rat1">
                        <span class="fa fa-star" onclick="rate(1)" id="star1"></span>
                    </label>
                    <input type="radio" name="rating" value="1" id="rat1" class="form-check-input d-none">
                    <label for="rat2">
                        <span class="fa fa-star" onclick="rate(2)" id="star2"></span>
                    </label>
                    <input type="radio" name="rating" value="2" id="rat2" class="form-check-input d-none">
                    <label for="rat3">
                        <span class="fa fa-star" onclick="rate(3)" id="star3"></span>
                    </label>
                    <input type="radio" name="rating" value="3" id="rat3" class="form-check-input d-none">
                    <label for="rat4">
                        <span class="fa fa-star" onclick="rate(4)" id="star4"></span>
                    </label>
                    <input type="radio" name="rating" value="4" id="rat4" class="form-check-input d-none">
                    <label for="rat5">
                        <span class="fa fa-star" onclick="rate(5)" id="star5"></span>
                    </label>
                    <input type="radio" name="rating" value="5" id="rat5" class="form-check-input d-none">
                </div>

                <textarea class="form-control" name="comment" id="" cols="30" rows="4"></textarea>
                <button type="submit" class="btn btn-outline-primary mt-2 float-end">Create</button>
            </form>
        @endif

    </div>

@endsection

@section('J_Script')
    <script>
        // add ckeditor to each content textarea
        document.querySelectorAll('.contentBody').forEach(element => {
            ClassicEditor
                .create(element)
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        });

        let currentRating = 0;

        function rate(stars) {
            currentRating = stars;
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star' + i);
                if (i <= stars) {
                    star.classList.add('checked');
                } else {
                    star.classList.remove('checked');
                }
            }
            // You can perform additional actions here, like sending the rating to the server via AJAX.
        }

        $(document).ready(function() {

            let programId = $('#programSelected').val();

            function takeCategories(pId) {
                let chosenCat = $('#chosenCat').text();
                //console.log(chosenCat);
                $.ajax({
                    url: 'http://localhost:8000/teacher/categories/take',
                    type: 'GET',
                    data: {
                        'selectProgramId': pId
                    },
                    success: function(cats) {
                        $catsList = '<label class="d-block">choose Category :</label>';
                        //console.log(cats);
                        cats.forEach(cat => {
                            $catsList += `
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="catId" id="cat${cat.id}" value="${cat.id}" ${chosenCat == cat.id ? 'checked' : ''}>
                                    <label class="form-check-label" for="cat">
                                    ${cat.category_name}
                                    </label>
                                </div>`;
                        });
                        $('#cats').html($catsList);
                    }
                });
            }

            takeCategories(programId); // work for initial program id

            $('#programSelected').on('change', function() {
                programId = $(this).val();
                console.log(programId);
                takeCategories(programId); // work for changed program id

            });

            $('#fileArea').hide();
            $('#selectContentType').on('change', function() {
                let typeSelected = $(this).val();
                console.log(typeSelected);
                if (typeSelected == 'text') {
                    $('#textArea').show();
                    $('#fileArea').hide();
                } else {
                    $('#fileArea').show();
                    $('#textArea').hide();
                }
            });

            //when user select text or file input
            $('.textBox').hide();
            $('.inputFile').hide();
            $('.choiceContentType').on('click', function() {
                let val = $(this).val();

                if (val === 'text') {
                    $('.inputFile').hide();
                    $('.textBox').show();
                } else if (val === 'image' || val === 'video' || val === 'file') {
                    $('.textBox').hide();
                    $('.inputFile').show();
                } else {
                    $('.textBox').hide();
                    $('.inputFile').hide();
                }
            });

            //when input data is too long, show spinner to wait
            $('.spin').hide();
            $('.contentInput').on('submit', function(e) {
                e.preventDefault();

                $(this).hide();
                $('.spin').show();

                var form = this; // Save reference to the form
                setTimeout(function() {
                    form.submit(); // Submit the form after 1000 milliseconds
                }, 1000);
            });

            $('#pannel')
            $('.nav-link').on('click', function(e) {
                e.preventDefault();

                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                let tab = $(this).text();
                let courseId = $('#courseId').val();

                console.log(courseId);

                if ($(this).attr('id') == "topic") {
                    $('#pannel').hide();
                    $('#topicPannel').show();
                } else if ($(this).attr('id') == "mates") {
                    $('#topicPannel').hide();
                    $('#pannel').show();

                    $.ajax({
                        url: 'http://localhost:8000/course/take/about',
                        type: 'GET',
                        data: {
                            'data': tab,
                            'courseId': courseId
                        },
                        success: function(response) {
                            console.log(response);
                            $content = '';
                            if (response.students) {
                                $content = `<table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    `;
                                Object.entries(response.students).forEach(([tmp, student]) => {
                                    console.log(student);
                                    $content += `<tr>
                                                    <td>
                                                         <a href="//"
                                                                class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                                                href="#">
                                                                ${student.name}
                                                        </a>
                                                    </td>
                                                </tr>`;
                                });
                                $content += `
                                                </tbody>
                                            </table>`;
                            }
                            $('#pannel').html($content);
                        }
                    })
                }
            });
        });
    </script>
@endsection
