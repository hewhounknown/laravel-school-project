@extends('admin.layout.app')

@section('content')
    course detail
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
