@extends('admin.layout.app')

@section('title', 'Program Management')

@section('content')
    <h4 class="my-3">Program Management</h4>

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
        <form method="post" action="{{ route('program.create') }}">
            @csrf
            <div class="row">
                <div class="col-6 p-3">
                    <h6>program name</h6>
                    <input type="text" name="programName" id="" class="form-control" placeholder="languanges">
                </div>
                <div class="col-6 p-3">
                    <h6>create categories here</h6>
                    <div id="createCat">
                        <input type="text" name="cat1" id="" class="form-control mb-2" placeholder="english">
                        <input type="text" name="cat2" id="" class="form-control mb-2"
                            placeholder="japanese">
                        <input type="text" name="cat3" id="" class="form-control mb-2" placeholder="spanish">
                    </div>
                    <div id="newCreateCat"></div>
                    <a href="" id="btnCreateCat" class="text-dark">more>></a>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-info float-end">Create</button>
                </div>
            </div>
        </form>
    </div>

    @if (count($programs) > 0)
        <div class="card p-2 m-2">
            <h4 class="border-bottom border-success">Avaliable program</h4>
            @foreach ($programs as $index => $program)
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapse{{ $program->name }}" aria-expanded="false"
                                aria-controls="#flush-collapse{{ $program->name }}">
                                <h5>{{ $program->name }}</h5>
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $program->name }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <button class="btn btn-outline-dark float-end" data-bs-toggle="modal"
                                    data-bs-target="#{{ $program->name }}Modal">
                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                </button>
                                @foreach ($program->categories as $cat)
                                    <div class="fs-6 mt-2">
                                        <a href="#"
                                            class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">{{ $cat->category_name }}</a>
                                    </div>
                                @endforeach
                                <!-- edit Modal start -->
                                <div class="modal fade" id="{{ $program->name }}Modal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form method="post" action="{{ route('program.edit', $program->id) }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6 p-3">
                                                            <h6>program name</h6>
                                                            <input type="text" name="programName" id=""
                                                                class="form-control" value="{{ $program->name }}">
                                                        </div>
                                                        <div class="col-6 p-3">
                                                            <h6>create categories here</h6>
                                                            <div id="editCat{{ $index }}">
                                                                @if (count($program->categories) > 0)
                                                                    @foreach ($program->categories as $cIndex => $cat)
                                                                        <input type="hidden"
                                                                            name="catId{{ $cIndex }}"
                                                                            value="{{ $cat->id }}">
                                                                        <input type="text" name="cat{{ $cIndex }}"
                                                                            id="" class="form-control mb-2"
                                                                            value="{{ $cat->category_name }}">
                                                                    @endforeach
                                                                @else
                                                                    <input type="text" name="cat1" id=""
                                                                        class="form-control mb-2" placeholder="category">
                                                                    <input type="text" name="cat2" id=""
                                                                        class="form-control mb-2" placeholder="category">
                                                                    <input type="text" name="cat3" id=""
                                                                        class="form-control mb-2" placeholder="category">
                                                                @endif
                                                            </div>
                                                            <div id="newEditCat{{ $index }}"></div>
                                                            <a href="" id="btnEditCat{{ $index }}"
                                                                class="text-dark">more>></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- edit Modal end --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif


@endsection

@section('J_Script')
    <script>
        $(document).ready(function() {

            let numOfCreateTag = $('#createCat').find('input[type="text"]').length + 1;
            $('#btnCreateCat').on('click', function(e) {
                e.preventDefault();

                let newCreateTag = $('<input type="text" name="cat' + numOfCreateTag +
                    '" id="" class="form-control mb-2" placeholder="category">');
                $('#newCreateCat').append(newCreateTag);
                numOfCreateTag++;
            });

            @foreach ($programs as $index => $program)
                let numOfEditCat{{ $index }} = $('#editCat{{ $index }}').find('input[type="text"]')
                    .length;
                $('#btnEditCat{{ $index }}').on('click', function(e) {
                    e.preventDefault();

                    //console.log(numOfEditCat);
                    let newEditTag = $('<input type="text" name="cat' + numOfEditCat{{ $index }} +
                        '" id="" class="form-control mb-2" placeholder="category">')
                    $('#newEditCat{{ $index }}').append(newEditTag);
                    numOfEditCat{{ $index }}++;
                });
            @endforeach

        });
    </script>
@endsection
