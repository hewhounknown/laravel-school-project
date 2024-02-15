@extends('admin.layout.app')

@section('content')
    <h4>Courses Manage </h4>

    <div class="row justify-content-end">
        <div class="col-3 text-center">
            <div class="btn btn-outline-secondary btn-lg">
                <i class="fa-solid fa-folder-plus"></i>
            </div>
        </div>
    </div>

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
