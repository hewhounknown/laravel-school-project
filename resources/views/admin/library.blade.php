@extends('admin.layout.app')

@section('content')
    <h1 class="m-2 text-primary text-opacity-75">
         <i class="fa-solid fa-book-open-reader fa-xl" style="color: #14ffc4;"></i> Library
    </h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- new lists start --}}
    <h3 class="pb-2 text-warning border-bottom border-warning">New+</h3>
    <div id="newBooksList" class=" rounded bg-warning-subtle text-emphasis-warning">
        @if (count($newbooks)>0)
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach($newbooks->chunk(4) as $key => $chunk)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <div class="row">
                    @foreach($chunk as $new)
                    <div class="">
                        <a href="" class="btn col-md-3 m-2" data-bs-toggle="modal" data-bs-target="#new{{$new->id}}">
                            <div class="card mb-2" style="height: 210px;">
                                @if ($new->cover == null)
                                <img src="{{asset('img/default.png')}}" class="card-img-top" style="height: 120px" alt="...">
                                @else
                                <img src="{{asset('storage/library/cover/'.$new->cover)}}" class="card-img-top" style="height: 120px;" alt="..." >
                                @endif
                              <div class="card-body">
                                <h5 class="card-title">{{ _($new->book_name) }}</h5>
                                <p class="card-text">{{ _($new->author_name) }}</p>
                                {{-- <p class="card-text"><strong>${{ _('200') }}</strong></p> --}}
                              </div>
                            </div>
                        </a>
                        <!--Confirm Modal -->
                        <div class="modal fade" id="new{{$new->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">New book to the library</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row">
                                    <div class="col-5">
                                        @if ($new->cover == null)
                                        <img src="{{asset('img/default.png')}}" class="card-img-top" style="height: 120px" alt="...">
                                        @else
                                        <img src="{{asset('storage/library/cover/'.$new->cover)}}" class="card-img-top" style="height: 120px; width: auto" alt="..." >
                                        @endif
                                    </div>
                                    <div class="col-7">
                                        Book name : <strong>{{$new->book_name}}</strong> <br>
                                        Author name : <strong>{{$new->author_name}}</strong> <br>
                                        <a href="http://" class="text-primary">read book here>>></a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a href="{{route('book.public',$new->id)}}" type="button" class="btn btn-primary">Confirm</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev" style="left: 0; margin-left: 0px;">
                <span class="" aria-hidden="true">
                    <i class="fa-solid fa-arrow-left fa-xl" style="color: #ffb52b;"></i>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next" style="right: 0; margin-right: 0px;">
                <span class="" aria-hidden="true">
                    <i class="fa-solid fa-arrow-right fa-xl" style="color: #ffb52b;"></i>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @else
            <span class="placeholder col-12 bg-warning"></span>
        @endif
    </div>
    {{-- new lists end --}}

    {{-- book lists start --}}
    <h3 class="pb-2 text-info border-bottom border-info">Book</h3>
    <div id="BooksList" class=" rounded bg-info-subtle text-emphasis-info">
        @if (count($books)>0)
        <div id="bookCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach($books->chunk(4) as $key => $chunk)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <div class="row">
                        @foreach($chunk as $book)
                          <div class="col-md-3 m-2">
                            <div class="card" style="height: 210px;">
                                @if ($book->cover == null)
                                <img src="{{asset('img/default.png')}}" class="card-img-top" style="height: 120px" alt="...">
                                @else
                                <img src="{{asset('storage/library/cover/'.$book->cover)}}" class="card-img-top" style="height: 120px" alt="..." >
                                @endif
                              <div class="card-body">
                                <h5 class="card-title">{{ _($book->book_name) }}</h5>
                                <p class="card-text">{{ _($book->author_name) }}</p>
                              </div>
                            </div>
                          </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bookCarousel" data-bs-slide="prev" style="left: 0; margin-left: 0px;">
                <span class="" aria-hidden="true">
                    <i class="fa-solid fa-arrow-left fa-xl" style="color: #63E6BE;"></i>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bookCarousel" data-bs-slide="next" style="right: 0; margin-right: 0px;">
                <span class="" aria-hidden="true">
                    <i class="fa-solid fa-arrow-right fa-xl" style="color: #63E6BE;"></i>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @else
            <span class="placeholder col-12 bg-info"></span>
        @endif
    </div>
    {{-- book lists end --}}

    {{-- book add --}}
    <div class="m-3">
        <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="modal" data-bs-target="#addBookModal">
            <i class="fa-solid fa-plus" style="color: #63E6BE;"></i> Add here
        </button>

        <!-- Book adding Modal -->
        <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="{{route('admin.book.add')}}" method="post">
                        @csrf
                        <div class="modal-body">
                                <div class="mt-2">
                                    <label for="coverImg">Cover Image</label>
                                    <img id="coverImg" src="{{asset('img/default.png')}}" alt="profile picture" class="rounded d-block mb-2"  style="width:27rem; hieght: 35rem;">
                                    <input type="file" name="bookCover" id="bookCover" class="form-control d-none" onchange="readURL(this)">
                                </div>
                                <div class="mt-2">
                                    <label for="bookName">Book Name</label>
                                    <input type="text" name="bookName" id="bookName" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label for="authorName">Author Name</label>
                                    <input type="text" name="authorName" id="authorName" class="form-control">
                                </div>
                                <div class="mt-2">
                                    <label for="book">Add your book here</label>
                                    <input type="file" name="book" id="book" class="form-control">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger w-25" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
                            <button type="submit" class="btn btn-primary w-25"><i class="fa fa-check" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- book add end --}}
@endsection

@section('J_Script')
<script>
    document.getElementById('coverImg').addEventListener('click', e =>{
        document.getElementById('bookCover').click();
    })

    function readURL(input){
        if(input.files && input.files[0]){
            let reader = new FileReader();
            //let img = document.getElementById('img');

            reader.onload = e => $('#coverImg').attr('src', e.target.result);

            reader.readAsDataURL(input.files[0]);
            //console.log(reader);
        }
    }
</script>
@endsection
