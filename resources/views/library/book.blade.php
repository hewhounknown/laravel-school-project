@extends('layout.app')

@section('title', $book->book_name)

@section('content')
    <div class="container mt-3">

        <embed src='{{asset('storage/library/books/'.$book->book_path)}}'
        type='application/pdf'
        width='100%'
        height='700px'>

        {{-- <embed src="" type=""> --}}

            {{-- <iframe src="{{asset('storage/library/books/'.$book->book_path)}}" frameborder="0"></iframe> --}}

    </div>

@endsection
