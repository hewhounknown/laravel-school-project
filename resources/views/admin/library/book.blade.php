@extends('admin.layout.app')

@section('content')
    <div class="m-3">
        <iframe src="https://docs.google.com/viewer?url={{ urlencode(asset('storage/library/books/'.$book->book_path)) }}&embedded=true"></iframe>
    </div>
@endsection
