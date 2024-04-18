@extends('admin.layout.app')

@section('title', $book->book_name)

@section('content')
    <div class="m-2">
        <a href="http://" onclick="history.back(); return false;" title="Go back">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
        </a>
    </div>
    <div class="mt-5">
        <iframe src="{{ route('pdf.show', ['id' => $book->id]) }}" frameborder="0" width="100%" height="600px"></iframe>
    </div>
@endsection
