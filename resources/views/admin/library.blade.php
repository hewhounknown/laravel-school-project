@extends('admin.layout.app')

@section('content')
    <h1>Library</h1>

    <h3 class="pb-2 text-primary border-bottom border-primary">New Book</h3>
    <div class=" rounded bg-warning-subtle text-emphasis-warning">
        @if (count($books)>0)
        <div id="productCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach($books->chunk(4) as $key => $chunk)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <div class="row">
                    @foreach($chunk as $book)
                      <div class="col-md-3">
                        <div class="card mb-3" style="height: 210px;">
                            @if ($book->cover == null)
                            <img src="{{asset('img/default.png')}}" class="card-img-top" style="height: 120px" alt="...">
                            @else
                            <img src="{{asset('storage/library/cover/'.$book->cover)}}" class="card-img-top" style="height: 120px" alt="..." >
                            @endif
                          <div class="card-body">
                            <h5 class="card-title">{{ _($book->book_name) }}</h5>
                            <p class="card-text">{{ _($book->author_name) }}</p>
                            {{-- <p class="card-text"><strong>${{ _('200') }}</strong></p> --}}
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
                    <i class="fa-solid fa-arrow-left fa-xl" style="color: #63E6BE;"></i>
                </span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next" style="right: 0; margin-right: 0px;">
                <span class="" aria-hidden="true">
                    <i class="fa-solid fa-arrow-right fa-xl" style="color: #63E6BE;"></i>
                </span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        @else
            <h3>.....</h3>
        @endif


    </div>
@endsection
