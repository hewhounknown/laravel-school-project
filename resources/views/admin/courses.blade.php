@extends('admin.layout.app')

@section('content')
    <h4>Courses Manage </h4>

    <div class="row justify-content-end">
        <div class="col-3 text-center">
            <div class="btn btn-outline-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#courseModal">
                <i class="fa-solid fa-folder-plus"></i>
            </div>
        </div>
    </div>

    {{-- Courses Create modal start --}}
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 730px;">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form enctype="multipart/form-data" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <select name="programSelected" id="programSelected" class="form-select mb-2">
                                <option value="">select program</option>
                                @foreach ($programs as $program)
                                <option value="{{$program->id}}">{{$program->name}}</option>
                                @endforeach
                            </select>

                            <div id="cats" class="my-2">

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mt-2">
                                <label for="image">
                                    <img id="img" src="{{asset('img/add_image.png')}}" alt="profile picture" class="rounded"  style="width:230px; hieght: 180px;">
                                </label>
                                <input type="file" name="image" id="image" class="form-control" onchange="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label for="" class="form-label">Course Name</label>
                                <input type="text" name="courseName" id="" class="form-control mb-2">
                            </div>

                            <div class="mb-2">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    {{-- Courses Create modal end --}}

    <div class="mx-5 my-3 text-center">
        <form class="input-group">
            <input id="search" class="form-control w-75" type="text" placeholder="Search">
            <button type="button" class=" btn btn-secondary input-group-text"> <i class="fa-solid fa-magnifying-glass"></i> </button>
        </form>
    </div>

    <div id="newCourses" class=" p-3 m-2">
        <div class="card  my-1" style="height: 120px">
            <div class="row bg-info-subtle text-emphasis-info g-0">
                <div class="col-3">
                    <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: auto; height: 120px" alt="">
                </div>
                <div class="col-7 p-2">
                    <div class="row">
                        <div class="col-sm-3"><strong>Name</strong></div>
                        <div class="col-sm-9">IELTS</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Category</strong></div>
                        <div class="col-sm-9">English</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>By</strong></div>
                        <div class="col-sm-9">sayar sayar sayar</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Date</strong></div>
                        <div class="col-sm-9">3/9/2023</div>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    <a href="" class="btn btn-outline-success btn-lg">
                        <i class="fa-solid fa-info"></i>
                    </a>
                    <a href="" class="btn btn-outline-info btn-lg">
                        <i class="fa-solid fa-check"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card my-1" style="height: 120px">
            <div class="row bg-info-subtle text-emphasis-info g-0">
                <div class="col">
                    <img src="{{asset('img/default.png')}}" class="img-fluid" style="width: auto; height: 120px" alt="">
                </div>
                <div class="col-7 p-2">
                    <div class="row">
                        <div class="col-sm-3"><strong>Name</strong></div>
                        <div class="col-sm-9">IELTS</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Category</strong></div>
                        <div class="col-sm-9">English</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>By</strong></div>
                        <div class="col-sm-9">sayar sayar sayar</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>Date</strong></div>
                        <div class="col-sm-9">3/9/2023</div>
                    </div>
                </div>
                <div class="col-2 align-self-center">
                    <a href="" class="btn btn-outline-success btn-lg">
                        <i class="fa-solid fa-info"></i>
                    </a>
                    <a href="" class="btn btn-outline-info btn-lg">
                        <i class="fa-solid fa-check"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="avaliableCources" class="m-2" style="overflow-x: auto;">
        <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>By Teacher</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{asset('img/default.png')}}" style="height: 80px; width: 100px;" alt="">
                    </td>
                    <td>N1</td>
                    <td>Japanese</td>
                    <td>Oishimaru</td>
                    <td>3/8/2023</td>
                </tr>
                <tr>
                    <td>
                        <img src="{{asset('img/default.png')}}" style="height: 80px; width: 100px;" alt="">
                    </td>
                    <td>N2</td>
                    <td>Japanese</td>
                    <td>Oishimaru</td>
                    <td>3/8/2023</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('J_Script')
    <script>
        $(document).ready(function(){
            $('#programSelected').on('change', function(){
                let programId = $(this).val();
                //console.log(programId);

                $.ajax({
                    url : 'http://localhost:8000/admin/take/categories',
                    type : 'GET',
                    data : {'selectProgramId' : programId},
                    success: function(cats){
                        $catsList = '<label class="d-block">choose Category :</label>';
                        //console.log(cats);
                        cats.forEach(cat => {
                            $catsList += `
                                <div class="form-check d-inline-block">
                                    <input class="form-check-input" type="radio" name="cat" id="cat">
                                    <label class="form-check-label" for="cat">
                                      ${cat.category_name}
                                    </label>
                                </div>`;
                        });
                        $('#cats').html($catsList);
                    }
                })
            });
        });
    </script>
@endsection
