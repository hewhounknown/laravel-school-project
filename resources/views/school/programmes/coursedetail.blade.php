@extends('school.layout.app')

@section('title', 'course detail')

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
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="container mt-5 ">
        <div class="row align-items-center justify-content-center shadow-lg p-3 rounded position-relative ">

            @if (Auth::user()->id == $course->user_id)
            <span class="position-absolute top-0 end-0" style="width: auto;">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCourseModal">
                    <i class="fa-solid fa-bars fa-xl"></i>
                </button>
            </span>

            <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Course Edit</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="col-5">
                @if ($course->course_image == null)
                <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: 230px; height: 170px" alt="">
                @else
                <img src="{{asset('storage/course/'.$course->course_image)}}" class="img-fluid" style="width: 230px; height: 170px" alt="">
                @endif
            </div>
            <div class="col-7">
                <div class="row">
                    <div class="col-sm-3"><strong>Name</strong></div>
                    <div class="col-sm-9">{{_($course->course_name)}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>Category</strong></div>
                    <div class="col-sm-9">{{_($course->category->category_name)}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>By</strong></div>
                    <div class="col-sm-9">{{_($course->teacher->name)}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-3"><strong>Date</strong></div>
                    <div class="col-sm-9">{{_($course->created_at->format('d/m/y'))}}</div>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-sm-3"><strong>Description</strong></div>
                <div class="col-sm-9">{{_($course->course_description)}}</div>
            </div>

            @if (Auth::user()->id != $course->user_id)
                @if ($course->enrolls->isEmpty())
                    <div class="">
                        <a href="{{route('course.enroll', $course->id)}}" class="btn btn-outline-primary float-end">Enroll Now</a>
                    </div>
                @else
                    <div>
                        <a href="{{route('course.unenroll', $course->id)}}" class="btn btn-outline-danger float-end">Unenroll</a>
                    </div>
                @endif
            @endif

        </div>
    </div>


    @if (Auth::user()->id == $course->user_id)
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addTopicModal">+ Add Topic</button>
                </div>
            </div>
        </div>

        <!-- Modal for add topic start -->
        <div class="modal fade" id="addTopicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Topic</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('topicAdd',$course->course_name)}}" method="post">
                        @csrf
                        <div class="modal-body">

                                <input type="hidden" name="courseId" value="{{$course->id}}">

                                <div class="mb-3">
                                    <label for="topicTitle">Your Topic title</label>
                                    <input type="text" name="topicTitle" id="topicTitle" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="topicDescription">Description</label>
                                    <textarea name="topicDescription" id="topicDescription" class="form-control" cols="30" rows="10"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal for add topic end --}}
    @endif


    @if (Auth::user()->id == $course->user_id || $enrollStatus == true)
    {{-- Topic session start --}}
    <div class="container mt-5">
        <div class="row shadow-lg p-3 rounded">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @if ($course->topics->isEmpty())
                    <h2 class="default">There are no topic to learn</h2>
                @else
                @foreach($course->topics as $t)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $t->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $t->id }}" aria-expanded="true" aria-controls="collapse{{ $t->id }}">
                            {{ $t->topic_name }}
                        </button>
                    </h2>

                    {{-- content session start --}}
                    <div id="collapse{{ $t->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $t->id }}" data-bs-parent="#accordionTopics">
                        <div class="accordion-body">
                            {{ $t->topic_description }}
                            <div>
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($t->contents as $content)
                                            <hr> <a href="{{route('contentView',['topicId'=>$t->id, 'contentId'=>$content->id])}}">
                                                <tr>{{$content->title}}</tr>
                                            </a>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if (Auth::user()->id == $t->course->user_id)
                                <div class="my-2" style="height: 3rem">
                                    <button class="btn btn-outline-dark float-end mb-2" data-bs-toggle="modal" data-bs-target="#addContentModal{{$t->id}}">+ content {{$t->id}}</button>
                                </div>
                                {{-- modal for add content start --}}
                                <div class="modal fade" id="addContentModal{{$t->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title {{$t->id}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <form id="contentInput" class="contentInput" enctype="multipart/form-data" action="{{route('contentAdd', $t->topic_name)}}" method="post" >
                                                @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="topicId" value="{{$t->id}}">

                                                <div class="mb-3">
                                                    <label for="contentTitle">Title</label>
                                                    <input type="text" name="contentTitle" id="contentTitle" class="form-control">
                                                </div>

                                                <div class="mb-3">
                                                    <select id="selectBox" name="contentType" class="form-select choiceContentType" aria-label="Default select example">
                                                        <option selected>Choose your content type</option>
                                                        <option value="text">Text</option>
                                                        <option value="video">video</option>
                                                        <option value="image">image</option>
                                                        <option value="file">file</option>
                                                    </select>
                                                </div>

                                                <div id="textBox" class="mb-3 textBox">
                                                    <label for="contentBody">content</label>
                                                    <textarea name="textContent" id="contentBody" cols="30" rows="10" class="form-control contentBody"></textarea>
                                                </div>

                                                <div id="inputFile" class="mb-3 inputFile">
                                                    <label for="contentBody">content</label>
                                                    <input type="file" name="fileContent" id="contentBody" class="form-control">
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-primary">Save</button>
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
            Wait a while for you're accepted by the teacher!
        </h5>
    @endif

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

        $(document).ready(function(){

            //when user select text or file input
            $('.textBox').hide();
            $('.inputFile').hide();
            $('.choiceContentType').on('click', function(){
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
        });
    </script>
@endsection
