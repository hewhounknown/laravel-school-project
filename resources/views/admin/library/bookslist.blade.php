@extends('admin.layout.app')

@section('content')
    avaliable book


    <div class="mx-5 my-3 text-center">
        <form class="input-group shadow">
            <input id="search" class="form-control w-75" type="text" placeholder="Search">
            <button type="button" class=" btn btn-primary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
        </form>
    </div>

    <div class="row" id="bookList">
        @foreach ($books as $book)
        <div class="col-md-3 m-2">
            <!-- Card -->
            <div class="card">
                <!-- Card image -->
                <div class="view overlay">
                    @if ($book->cover == null)
                        <img class="card-img-top" src="{{asset('img/default.png')}}" style="height: 120px" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="{{asset('storage/library/cover/'.$book->cover)}}" style="height: 120px" alt="Card image cap">
                    @endif
                </div>
                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title text-center">{{$book->book_name}}</h4>
                    <!-- Text -->
                    <p class="card-text fs-6"><i class="fa-solid fa-feather-pointed fa-lg"></i> {{$book->author_name}}</p>
                    <p class="card-text fs-6"><i class="fa-solid fa-share fa-lg"></i> {{$book->user->name}}</p>
                    <!-- Button -->
                    <a href="#" class="btn btn-outline-warning w-100">View</a>
                </div>
            </div>
            <!-- Card -->
        </div>
        @endforeach
    </div>
@endsection

@section('J_Script')
    <script>
        $(document).ready(function(){
            $('#search').on('keyup', function(){
                let searchItem = $(this).val();

                $.ajax({
                    url : 'http://localhost:8000/admin/search/book',
                    type : 'GET',
                    data : {'item' : searchItem},
                    success: function(response){
                        $list = '';
                        if (response.length > 0) {
                            $list += `<div class="row">`;
                            response.forEach(book => {
                                // console.log(book.user.name);
                                $list += `<div class="col-md-3 m-2">
                                            <div class="card">
                                                <div class="view overlay">`;
                                                if (book.cover == null) {
                                                    $list += `<img class="card-img-top" src="{{asset('img/default.png')}}" style="height: 120px" alt="Card image cap">`;
                                                } else {
                                                    $list += `<img class="card-img-top" src="{{ asset('storage/library/cover/') }}/${book.cover}" style="height: 120px" alt="Card image cap">`;
                                                }
                                            $list += `</div>
                                                <div class="card-body">
                                                    <h4 class="card-title text-center">${book.book_name}</h4>
                                                    <p class="card-text fs-6"><i class="fa-solid fa-feather-pointed fa-lg"></i> ${book.author_name}</p>
                                                    <p class="card-text fs-6"><i class="fa-solid fa-share fa-lg"></i> ${book.user.name}</p>
                                                    <a href="#" class="btn btn-outline-warning w-100">View</a>
                                                </div>
                                            </div>
                                        </div>`;
                            });
                            $list += `</div>`;
                        } else {
                            $list = `<h5 class="text-center text-muted m-3">not found...</h5>`;
                        }
                        $('#bookList').html($list);
                    },
                });
            });
        });
    </script>
@endsection
