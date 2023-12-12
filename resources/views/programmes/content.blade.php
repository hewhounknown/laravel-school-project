@extends('layout.app')

@section('title', 'content')

@section('content')
    <div class="border-info border-start border-5 m-3 text-muted p-2 ">
      <h3>{{__($content->title)}}</h3>
    </div>

    <div class="container bg-body-tertiary p-2">
        <div class="row m-auto">
            @if ($content->content_type == 'text')
            <div>
                {!! $content->content_body !!}
            </div>
            @elseif ($content->content_type == 'video')
            <div class="text-center">
                <video width="800" height="420" controls src="{{asset('storage/course/topic/content/'.$content->content_path)}}" type="video/mp4"></video>
            </div>
            @elseif ($content->content_type == 'image')
            <div>
            <div class="text-center">
                <img src="{{asset('storage/course/topic/content/'.$content->content_path)}}" alt="">
            </div>
            </div>
            @else
            <div class="text-center">
                <a href="{{route('file.download',$content->content_path)}}"><h3>{{__('download file here!')}}</h3></a>
            </div>
            @endif
        </div>
    </div>
@endsection
