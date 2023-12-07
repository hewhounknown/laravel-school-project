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
                                        <hr>  <a href="http://">
                                            <tr><h5>1</h5></tr>
                                                </a>
                                        <hr>   <tr><h5>2</h5></tr>
                                        <hr>   <tr><h5>3</h5></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="my-2" style="height: 3rem">
                                <button class="btn btn-outline-dark float-end mb-2">+ content</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


                @endif
            </div>
        </div>
    </div>
@endsection
