@extends('admin.layout.app')

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


    <div class="border-info border-start border-5 m-3 text-muted p-2 ">
        <h3>{{__($content->title)}}</h3>
    </div>

    <div class="shadow-lg p-2 position-relative m-3">

        @if (Auth::user()->role == 'admin')
        <span class="position-absolute top-0 start-100 translate-middle p-2 border border-light rounded-circle" style="width: auto;">
            <button type="button" class="btn" data-bs-toggle="dropdown">
                <i class="fa-solid fa-bars fa-xl"></i>
            </button>

            <ul class="dropdown-menu">
                <li>
                    <a class="dropdown-item" href="http://" data-bs-toggle="modal" data-bs-target="#editForm">Edit</a>
                </li>
                <li><a class="dropdown-item" href="{{route('admin.content.delete', ['id'=>$content->id, 'topicId'=>$content->topic_id])}}"  onclick="return confirm('Are you sure, delete this content?')">Delete</a></li>
            </ul>
        </span>

        <!-- edit Modal start-->
        <div class="modal fade" id="editForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form enctype="multipart/form-data" action="{{route('admin.content.edit',$content->id)}}" method="post">

                    @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="contentTitle">Title</label>
                                <input type="text" name="contentTitle" id="contentTitle" class="form-control" value="{{old('contentTitle', $content->title)}}">
                            </div>

                            <div class="mb-3">
                                <select id="selectBox" name="contentType" class="form-select choiceContentType" aria-label="Default select example">
                                    <option value="text" {{$content->content_type == 'text' ? 'selected' : ''}}>Text</option>
                                    <option value="video" {{$content->content_type == 'video' ? 'selected' : ''}}>video</option>
                                    <option value="image"  {{$content->content_type == 'image' ? 'selected' : ''}}>image</option>
                                    <option value="file"  {{$content->content_type == 'file' ? 'selected' : ''}}>file</option>
                                </select>
                            </div>

                            <input id="topicId" type="hidden" name="topicId"  value="{{$content->topic->id}}">

                            <div id="textBox" class="mb-3 textBox">
                                <label for="contentBody">content</label>
                                <textarea name="textContent" id="contentBody" cols="30" rows="10" class="form-control contentBody">
                                    {{$content->content_body}}
                                </textarea>
                            </div>

                            <div id="inputFile" class="mb-3 inputFile">
                                <label for="contentBody">content</label>
                                <input type="file" name="fileContent" id="contentBody" class="form-control">
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
        {{-- edit modal end --}}
        @endif

        <div class="row m-auto">
            @if ($content->content_type == 'text')
            <div class="col">
                {!! $content->content_body !!}
            </div>
            @elseif ($content->content_type == 'video')
            <div class="col text-center">
                <video class="img-fluid" controls style="max-width: 100%;">
                    <source src="{{asset('storage/course/topic/content/'.$content->content_path)}}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
            @elseif ($content->content_type == 'image')
            <div class="col text-center">
                <img src="{{asset('storage/course/topic/content/'.$content->content_path)}}" alt="" class="img-fluid" style="max-height: 420px; max-width: 100%;">
            </div>
            @else
            <div class="col text-center">
                <a href="{{route('file.download',$content->content_path)}}"><h3>{{__('download file here!')}}</h3></a>
            </div>
            @endif
        </div>

    </div>

    <ul class="list-group">
        <li class="list-group-item active" aria-current="true"><b>Comments <span class="badge text-bg-info">{{count($content->comments)}}</span> </b></li>
        @foreach ($content->comments as $comment)
            <li class="list-group-item">
                <div class="fw-bold fst-italic">{{$comment->user->name}}</div>
                &nbsp; &nbsp; &nbsp;
                <div>{{$comment->body}}</div>
            </li>
        @endforeach
    </ul>

@endsection

@section('J_Script')
<script>
    ClassicEditor
        .create(document.querySelector('#contentBody'))
        .then(editor => {
        console.log('Editor initialized:', editor);
        // You can use the 'editor' instance for further operations
        })
        .catch(error => {
        console.error('Error initializing the editor:', error);
        });

    const select = document.getElementById('selectBox');
    const text = document.getElementById('textBox');
    const file = document.getElementById('inputFile');
    //const currentType = document.getElementById('currentType').value;
    // console.log(select);
    if (select.value == 'text') {
        file.style.display = 'none';
    } else {
        text.style.display = 'none';
    }

    select.addEventListener('change', e => {
        let val = e.target.value;
        if (val == 'text') {
            file.style.display = 'none';
            text.style.display = 'block';
        } else {
            text.style.display = 'none';
            file.style.display = 'block';
            text.innerHTML = '';    // clear info in textarea for $req
        }
    })
</script>
@endsection
