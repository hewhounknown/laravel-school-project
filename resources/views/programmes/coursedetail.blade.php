@extends('layout.app')

@section('title', 'course detail')

@section('content')

    {{-- <nav style="--bs-breadcrumb-divider: '>';" class="fs-3"  aria-label="breadcrumb">
        <ol class="breadcrumb bg-white">
            <!-- Loop through each breadcrumb item -->
            @foreach ($breadcrumbs as $breadcrumb)
                <!-- Check if it's the last item in the breadcrumbs array -->
                @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb->title }}</li>
                @else
                    <!-- Output the breadcrumb link -->
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @endif
            @endforeach
        </ol>
    </nav> --}}
    {{-- {{$course->topics}} --}}

    @if ($errors->any())
            @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            @endforeach
    @endif

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="container mt-5 ">
        <div class="row align-items-center justify-content-center shadow-lg p-3 rounded position-relative ">
            <div class="col-md-7 mb-2">
                <h4>{{__($course->course_description)}}</h4> <hr> <br>
                <h2 class="fs-1 text-dark">{{__($course->course_name)}}</h2>
            </div>
            <div class="col-md-5">
                <div class="text-center">
                    <img src="{{asset('storage/course/'.$course->course_image)}}"  alt="course image" style="width: 23rem; hieght: 15rem;">
                </div>
            </div>
        </div>
    </div>


    @if (Auth::user()->role == 'teacher')
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


    {{-- Topic session start --}}
    <div class="container mt-5">
        <div class="row shadow-lg p-3 rounded">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @if ($topic == null)
                    <h2 class="default">There are no topic to learn</h2>
                @else
                @foreach($topic as $t)
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

                            @if (Auth::user()->role == 'teacher')
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

        // when user select text or file input
        const textBox = Array.from(document.getElementsByClassName('textBox'));
        textBox.forEach(t => t.style.display = 'none');

        const inputFile = Array.from(document.getElementsByClassName('inputFile'));
        inputFile.forEach(i => i.style.display = 'none');

        const contentChoice = Array.from(document.getElementsByClassName('choiceContentType'));
        contentChoice.forEach(choice => {

            choice.addEventListener('click', e => {
               let  val = e.target.value;
               console.log(val);

                if (val == 'text') {
                    inputFile.forEach(i => i.style.display = 'none');
                    textBox.forEach(t => t.style.display = 'block');
                }else if (val == 'image' || val == 'video' || val == 'file'){
                    textBox.forEach(t => t.style.display = 'none');
                    inputFile.forEach(i => i.style.display = 'block');
                } else{
                    textBox.forEach(t => t.style.display = 'none');
                    inputFile.forEach(i => i.style.display = 'none');
                }
            });
        })

        // when input data is too long, show spinner to wait
        const spinner = Array.from(document.getElementsByClassName('spin'));
        spinner.forEach(s => s.style.display = 'none');

        const contentForm = Array.from(document.getElementsByClassName('contentInput'));
        contentForm.forEach(form => {
            //console.log(form);
            form.addEventListener('submit', e=>{
                e.preventDefault();

                form.style.display = 'none';
                spinner.forEach(s => s.style.display = 'block');

                setTimeout(() => {
                    form.submit();
                }, 1000);
            })
        })
    </script>
@endsection
