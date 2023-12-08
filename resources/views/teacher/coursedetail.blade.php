@extends('layout.app')

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

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#addTopicModal">+ Add Topic</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
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

    <div class="container mt-5">
        <div class="row shadow-lg p-3 rounded">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                @if ($topic->isEmpty())
                    <h2 class="default">There are no topic to learn</h2>
                @else
                @foreach($topic as $t)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $t->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $t->id }}" aria-expanded="true" aria-controls="collapse{{ $t->id }}">
                            {{ $t->topic_name }}
                        </button>
                    </h2>
                    <div id="collapse{{ $t->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $t->id }}" data-bs-parent="#accordionTopics">
                        <div class="accordion-body">
                            <!-- Display topic content or any other relevant information -->
                            {{ $t->topic_description }}

                            <div>
                                <table class="table table-hover">
                                    <tbody>
                                        @foreach ($t->contents as $content)
                                            <hr> <a href="http://">
                                                <tr>{{$content->title}}</tr>
                                            </a>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-2" style="height: 3rem">
                                <button class="btn btn-outline-dark float-end mb-2" data-bs-toggle="modal" data-bs-target="#addContentModal">+ content</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal --}}
                <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form enctype="multipart/form-data" action="{{route('contentAdd', $t->topic_name)}}" method="post" >
                            @csrf
                        <div class="modal-body">
                            <input type="hidden" name="topicId" value="{{$t->id}}">

                            <div class="mb-3">
                                <label for="contentTitle">Title</label>
                                <input type="text" name="contentTitle" id="contentTitle" class="form-control">
                            </div>

                            <div class="mb-3">
                                <select id="selectBox" name="contentType" onclick="getOption(this.value)" class="form-select" aria-label="Default select example">
                                    <option selected>Choose your content type</option>
                                    <option value="text">Text</option>
                                    <option value="video">video</option>
                                    <option value="image">image</option>
                                    <option value="file">file</option>
                                </select>
                            </div>

                            <div id="textBox" class="mb-3">
                                <label for="contentBody">content</label>
                                <textarea name="textContent" id="contentBody" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <div id="inputFile" class="mb-3">
                                <label for="contentBody">content</label>
                                <input type="file" name="fileContent" id="contentBody" class="form-control">
                            </div>


                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-outline-primary">Save</button>
                        </div>
                       </form>
                      </div>
                    </div>
                </div>
                @endforeach

                @endif
            </div>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#contentBody'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });


        const textBox = document.getElementById('textBox');
        textBox.style.display = 'none';

        const inputFile = document.getElementById('inputFile');
        inputFile.style.display = 'none';

        getOption = (val) => {
           // console.log(val);
            if (val == 'text') {
                inputFile.style.display = 'none';
                textBox.style.display = 'block';
            } else{
                textBox.style.display = 'none';
                inputFile.style.display = 'block';
            }
        }
    </script>
@endsection