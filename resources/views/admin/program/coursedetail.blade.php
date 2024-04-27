@extends('admin.layout.app')

@section('title', $course->course_name)

@section('content')

    <div class="m-3 fs-4">
        <a href="http://" onclick="history.back(); return false;" title="Go back">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
        </a>
    </div>

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

    @if ($course->user_id == Auth::user()->id)
        <div class="row justify-content-end">
            <div class="col-3 text-center">
                <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#topicModal">
                    <i class="fa-solid fa-file-medical"></i>
                </div>
            </div>
        </div>

        {{-- topic modal start --}}
        <div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 720px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Topic Create</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('admin.topic.create') }}" method="post"
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

    <div class="row bg-body rounded p-2 m-2 position-relative">
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
                    <a href="{{ route('admin.user.detail', $course->user_id) }}"
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
                                    <a href="{{ route('admin.course.delete', $course->id) }}"
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
                        <form enctype="multipart/form-data" action="{{ route('admin.course.edit') }}" method="post">
                            @csrf
                            <input type="hidden" name="courseId" value="{{ $course->id }}">
                            <div class="modal-body">
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
                                            <input type="file" name="courseImage" id="image" class="form-control"
                                                onchange="">
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <ul class="nav nav-tabs mt-4 ">
        <li class="nav-item">
            <a id="topic" class="nav-link active" aria-current="page" href="#">Topics</a>
        </li>
        <li class="nav-item">
            <a id="mates" class="nav-link" href="#">Classmates</a>
        </li>
    </ul>

    <input type="hidden" id="courseId" value="{{ $course->id }}">

    <div id="matesPannel" class="my-3">

    </div>

    <div id="topicPannel">
        @if (count($course->topics) > 0)
            <div class="accordion accordion-flush m-3" id="accordionFlushTopics">
                @foreach ($course->topics as $topic)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $topic->id }}" aria-expanded="false"
                                aria-controls="flush-collapse{{ $topic->id }}">
                                {{ $topic->topic_name }}
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $topic->id }}" class="accordion-collapse collapse"
                            style="width: auto" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{ __($topic->topic_description) }}

                                {{-- content list start --}}
                                <div>
                                    <table class="table table-hover">
                                        <tbody>
                                            @foreach ($topic->contents as $content)
                                                <hr> <a href="{{ route('admin.content.view', $content->id) }}"
                                                    class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                                    <tr>{{ $content->title }}</tr>
                                                </a>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @if ($course->user_id == Auth::user()->id)
                                    <div class="my-2 " style="height: 40px;">
                                        <button class="btn btn-outline-dark float-end mb-2" data-bs-toggle="modal"
                                            data-bs-target="#addContentModal{{ $topic->id }}">+ content</button>
                                    </div>

                                    <div class="modal fade" id="addContentModal{{ $topic->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form enctype="multipart/form-data"
                                                    action="{{ route('admin.content.add') }}" method="post"
                                                    class="Input">
                                                    @csrf
                                                    <input type="hidden" name="topicId" value="{{ $topic->id }}">
                                                    <div class="modal-body">
                                                        <div class="mb-2">
                                                            <label for="contentTitle">Content Title</label>
                                                            <input type="text" name="contentTitle" id=""
                                                                class="form-control">
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="contentType">Content Type</label>
                                                            <select id="" name="contentType"
                                                                class="form-select selectContentType2">
                                                                <option value="text">Text</option>
                                                                <option value="file">File</option>
                                                                <option value="image">Image</option>
                                                                <option value="video">Video</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-2 textArea2" id="">
                                                            <label for="contentBody">Content</label>
                                                            <textarea name="contentBody" class="form-control textContent" id="textContent" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="mb-2 fileArea2" id="">
                                                            <label for="contentBody">Content</label>
                                                            <input type="file" name="contentBody" id=""
                                                                class="form-control">
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
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
                                @endif
                                {{-- content list end --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="m-3 text-center text-muted">
                <h6>There are no topic rightnow.</h6>
            </div>
        @endif

        <div class="container my-5">
            <ul class="list-group">
                <li class="list-group-item bg-info-subtle text-info-emphasis fs-5" aria-current="true">Reviews <span
                        class="badge text-bg-info">{{ count($course->reviews) }}</span></li>
                @foreach ($course->reviews as $review)
                    <li class="list-group-item">
                        <b>{{ $review->user->name }}</b>
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
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('J_Script')
    <script>
        document.querySelectorAll('.textContent').forEach(element => {
            ClassicEditor
                .create(element)
                .then(editor => {
                    console.log('Editor initialized:', editor);
                })
                .catch(error => {
                    console.error('Error initializing the editor:', error);
                });
        });


        $(document).ready(function() {

            let programId = $('#programSelected').val();

            function takeCategories(pId) {
                let chosenCat = $('#chosenCat').text();
                $.ajax({
                    url: 'http://localhost:8000/admin/take/categories',
                    type: 'GET',
                    data: {
                        'selectProgramId': pId
                    },
                    success: function(cats) {
                        $catsList = '<label class="d-block">choose Category :</label>';
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
                console.log(programId);
                takeCategories(programId); // work for changed program id

            });

            $('#fileArea').hide();
            $('#selectContentType').on('change', function() {
                let typeSelected = $(this).val();
                if (typeSelected == 'text') {
                    $('#textArea').show();
                    $('#fileArea').hide();
                } else {
                    $('#fileArea').show();
                    $('#textArea').hide();
                }
            });

            //for only content add
            $('.fileArea2').hide();
            $('.selectContentType2').on('change', function() {
                let typeSelected2 = $(this).val();
                if (typeSelected2 == 'text') {
                    $('.textArea2').show();
                    $('.fileArea2').hide();
                } else {
                    $('.fileArea2').show();
                    $('.textArea2').hide();
                }
            });

            //when input data is too long, show spinner to wait
            $('.spin').hide();
            $('.Input').on('submit', function(e) {
                e.preventDefault();

                $(this).hide();
                $('.spin').show();

                var form = this; // Save reference to the form
                setTimeout(function() {
                    form.submit(); // Submit the form after 1000 milliseconds
                }, 1000);
            });

            $('.nav-link').on('click', function(e) {
                e.preventDefault();

                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                let tab = $(this).attr('id');
                let courseId = $('#courseId').val();


                console.log(tab);

                if (tab == "topic") {
                    $('#matesPannel').hide();
                    $('#topicPannel').show();
                } else if (tab == "mates") {
                    $('#topicPannel').hide();
                    $('#matesPannel').show();

                    let profileViewRoute = "{{ route('profile.view', ['id' => ':id']) }}";
                    $.ajax({
                        url: 'http://localhost:8000/admin/take/students',
                        type: 'GET',
                        data: {
                            'data': tab,
                            'courseId': courseId
                        },
                        success: function(response) {
                            $content = '';
                            if (response.length > 0) {
                                $content = `<table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    `;
                                response.forEach(student => {
                                    $content += `<tr>
                                                    <td>
                                                         <a href="${profileViewRoute.replace(':id', student.id)}"
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
                            } else {
                                $content = `<h3>There are no students.</h3>`;
                            }
                            $('#matesPannel').html($content);
                        }
                    });
                }
            });
        });
    </script>
@endsection
