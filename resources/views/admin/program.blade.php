@extends('admin.layout.app')

@section('content')
    <h4>Program</h4>

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

    <div class="card p-2 m-2">
        <h4 class="border-bottom border-info">Add new program</h4>
         <form method="post" action="{{route('program.create')}}">
            @csrf
            <div class="row">
                <div class="col-6 p-3">
                    <h6>program name</h6>
                    <input type="text" name="programName" id="" class="form-control" placeholder="languanges">
                </div>
                <div class="col-6 p-3">
                    <h6>create categories here</h6>
                    <div>
                        <input type="text" name="cat1" id="" class="form-control mb-2" placeholder="english">
                        <input type="text" name="cat2" id="" class="form-control mb-2" placeholder="japanese">
                        <input type="text" name="cat3" id="" class="form-control mb-2" placeholder="spanish">
                    </div>
                    <div id="newCat"></div>
                    <button id="moreCat" class="btn btn-sm btn-outline-dark">more>></button>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-info float-end">Create</button>
                </div>
            </div>
         </form>
    </div>
@endsection

@section('J_Script')
    <script>
        $(document).ready(function(){
            let cat = 4;
            $('#moreCat').on('click', function(e){
                e.preventDefault();

                let newBox = $('<input type="text" name="cat'+cat+'" id="" class="form-control mb-2" placeholder="category">');
                $('#newCat').append(newBox);
                cat ++;
            });

        });
    </script>
@endsection
