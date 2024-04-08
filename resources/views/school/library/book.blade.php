@extends('school.layout.app')

@section('title', $book->book_name)

@section('content')

    <div class="container mt-3">
        <div class="m-2">
            <a href="http://" onclick="history.back(); return false;" title="Go back">
                <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
            </a>
        </div>

        <iframe src="{{ route('pdf.show', ['id' => $book->id]) }}" frameborder="0" width="100%" height="600px"></iframe>

        {{-- <embed src="" type=""> --}}

        {{-- <iframe src="{{asset('storage/library/books/'.$book->book_path)}}" frameborder="0"></iframe> --}}

    </div>

@endsection
