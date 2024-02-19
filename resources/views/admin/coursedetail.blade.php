@extends('admin.layout.app')

@section('content')
    course detail

    @if ($course->teacher_id == Auth::user()->id)
    <div class="row justify-content-end">
        <div class="col-3 text-center">
            <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#topicModal">
                <i class="fa-solid fa-file-medical"></i>
            </div>
        </div>
    </div>

    {{--topic modal start--}}
    <div class="modal fade" id="topicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Topic Create</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="topicName">Topic Name</label>
                        <input type="text" name="topicName" id="" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="topicDescription">Topic Description</label>
                        <textarea name="topicDescription" class="form-control" id="" cols="30" rows="5"></textarea>
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
                        <textarea name="contentBody" class="form-control" id="textContent" cols="30" rows="5"></textarea>
                    </div>
                    <div class="mb-2" id="fileArea">
                        <label for="contentBody">Content</label>
                        <input type="file" name="contentBody" id="" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    {{--topic modal end--}}
    @endif

    <div class="row bg-body rounded p-2 m-2">
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
    </div>

    @if (count($course->topics)>0)
    <div class="accordion accordion-flush m-3" id="accordionFlushTopics">
        @foreach ($course->topics as $topic)
        <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$topic->id}}" aria-expanded="false" aria-controls="flush-collapse{{$topic->id}}">
                {{$topic->topic_name}}
              </button>
            </h2>
            <div id="flush-collapse{{$topic->id}}" class="accordion-collapse collapse"  style="width: auto" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">
                {{__($topic->topic_description)}}
                    <a href="" class="d-block mb-2 float-end">
                        >>
                    </a>
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
@endsection

@section('J_Script')
    <script>
        ClassicEditor
            .create(document.querySelector('#textContent'))
            .then(editor => {
            console.log('Editor initialized:', editor);
            // You can use the 'editor' instance for further operations
            })
            .catch(error => {
            console.error('Error initializing the editor:', error);
            });

        $(document).ready(function(){
            $('#fileArea').hide();
            $('#selectContentType').on('change', function(){
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
        });
    </script>
@endsection
