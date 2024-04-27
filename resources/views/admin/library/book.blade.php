@extends('admin.layout.app')

@section('title', $book->book_name)

@section('content')
    <div class="m-2">
        <a href="{{ url()->previous() }}" title="Go back">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal"></i>
        </a>
    </div>

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="m-3 float-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="fa-solid fa-wrench"></i>
        </button>

        <!--Edit Modal Start-->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-evenly text-center">
                            <div class="col-4 ">
                                @if ($book->public_status == false)
                                    <a href="{{ route('book.public', $book->id) }}" title="public book"
                                        class="btn btn-outline-info w-100">
                                        <i class="fa-regular fa-face-smile"></i>
                                    </a>
                                @else
                                    <a href="{{ route('book.unpublic', $book->id) }}" title="unpublic book"
                                        class="btn btn-outline-warning w-100">
                                        <i class="fa-regular fa-face-frown"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="col-4 ">
                                <a href="{{ route('book.delete', $book->id) }}" title="delete book"
                                    class="btn btn-outline-danger w-100">
                                    <i class="fa-regular fa-trash-can"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit Modal End-->
    </div>

    <div class="mt-5">
        <iframe src="{{ route('pdf.show', ['id' => $book->id]) }}" frameborder="0" width="100%" height="600px"></iframe>
    </div>
@endsection
