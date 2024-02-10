@extends('admin.layout.app')

@section('content')
    <h4>Program</h4>

    <div class="card p-2 m-2">
        <h4 class="border-bottom border-info">Add new program</h4>
         <form action="">
            <div class="row">
                <div class="col-6 p-3">
                    <h6>program name</h6>
                    <input type="text" name="programName" id="" class="form-control" placeholder="languanges">
                </div>
                <div class="col-6 p-3">
                    <h6>create categories here</h6>
                    <div>
                        <input type="text" name="" id="" class="form-control mb-2" placeholder="english">
                        <input type="text" name="" id="" class="form-control mb-2" placeholder="japanese">
                        <input type="text" name="" id="" class="form-control mb-2" placeholder="spanish">
                    </div>
                    <div id="gpCat"></div>
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
            $('#moreCat').on('click', function(e){
                e.preventDefault();
                let newBox = $('<input type="text" name="" id="" class="form-control mb-2" placeholder="category">');
                $('#gpCat').append(newBox);
            });
            console.log(a);
        });
    </script>
@endsection
