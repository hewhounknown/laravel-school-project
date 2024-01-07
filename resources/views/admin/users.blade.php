@extends('admin.layout.app')

@section('content')
    <div class="my-3">
        <h3>
            User Management <i class="fa-solid fa-wrench"></i>
            <span class="bg-info bg-gradient badge">{{count($users)}}</span>
        </h3>
    </div>

    {{-- <div class="container"> --}}
        <div class=" text-center" style="overflow-x: auto;">
            <table class="table table-striped table-hover rounded">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->role == 'student')
                                    <span class="badge bg-secondary">{{$user->role}}</span>
                                @elseif ($user->role == 'teacher')
                                    <span class="badge bg-info">{{$user->role}}</span>
                                @else
                                    <span class="badge bg-warning">{{$user->role}}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">

                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if ($user->role == 'student')
                                            <i class="fa-solid fa-user"></i>
                                        @elseif($user->role == 'teacher')
                                            <i class="fa-solid fa-chalkboard-user"></i>
                                        @else
                                            <i class="fa-solid fa-user-tie"></i>
                                        @endif
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                      <li><a class="dropdown-item" href="#">Dropdown link</a></li>
                                    </ul>
                                </div>

                                @if ($user->account_status == 'active')
                                    <a href="#" type="button" class="btn btn-outline-info">
                                        <i class="fa-solid fa-lightbulb"></i>
                                    </a>
                                @else
                                    <a href="#" type="button" class="btn btn-outline-warning">-----</a>
                                @endif

                                @if ($user->id !== Auth::user()->id)
                                    <a href="#" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    {{-- </div> --}}

@endsection