@extends('admin.layout.app')

@section('title', 'User Management')

@section('content')
    <div class="my-3">
        <h3>
            User Management <i class="fa-solid fa-wrench"></i>
            <span class="bg-info bg-gradient badge">{{ count($users) }}</span>
        </h3>
    </div>

    @if (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (count($users) > 15)
        <div class="mx-5 my-3 text-center">
            <form class="input-group">
                <input id="search" class="form-control w-75" type="text" placeholder="Search">
                <button type="button" class=" btn btn-primary input-group-text"> <i
                        class="fa-solid fa-magnifying-glass"></i> </button>
            </form>
        </div>
    @endif

    {{-- <div class="container"> --}}
    <div id="userList" class=" text-center" style="overflow-x: auto;">
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
                        <td>
                            <a href="{{ route('admin.user.detail', $user->id) }}"
                                class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role == 'student')
                                <span class="badge bg-secondary">{{ $user->role }}</span>
                            @elseif ($user->role == 'teacher')
                                <span class="badge bg-info">{{ $user->role }}</span>
                            @else
                                <span class="badge bg-warning">{{ $user->role }}</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->role == 'student')
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-user"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.user.role', ['id' => $user->id, 'role' => 'teacher']) }}">Teacher</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.user.role', ['id' => $user->id, 'role' => 'admin']) }}">Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            @elseif ($user->role == 'teacher')
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-chalkboard-user"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.user.role', ['id' => $user->id, 'role' => 'student']) }}">Student</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="{{ route('admin.user.role', ['id' => $user->id, 'role' => 'admin']) }}">Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <button type="button" class="btn btn-outline-secondary">
                                    <i class="fa-solid fa-user-tie"></i>
                                </button>
                            @endif

                            @if ($user->account_status == 'active')
                                <a href="{{ route('admin.user.status', ['id' => $user->id, 'status' => 'suspend']) }}"
                                    type="button" class="btn btn-outline-info"
                                    onclick="return confirm('Are you sure, ban this account?')">
                                    <i class="fa-solid fa-lightbulb"></i>
                                </a>
                            @else
                                <a href="{{ route('admin.user.status', ['id' => $user->id, 'status' => 'active']) }}"
                                    type="button" class="btn btn-outline-warning">
                                    <i class="fa-solid fa-ban"></i>
                                </a>
                            @endif

                            @if ($user->id !== Auth::user()->id)
                                <a href="{{ route('admin.user.delete', $user->id) }}" type="button"
                                    class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
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

@section('J_Script')
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function() {
                let query = $(this).val();
                //console.log(query);

                let userRoleRoute = "{{ route('admin.user.role', ['id' => ':id', 'role' => ':role']) }}";
                let userDetailRoute = "{{ route('admin.user.detail', ['id' => ':id']) }}";
                let userStatusRoute =
                    "{{ route('admin.user.status', ['id' => ':id', 'status' => ':status']) }}";
                let userDeleteRoute = "{{ route('admin.user.delete', ['id' => ':id']) }}";

                $.ajax({
                    url: 'http://localhost:8000/admin/search/user',
                    type: 'GET',
                    data: {
                        'search': query
                    },
                    success: function(response) {
                        // console.log(response);
                        $table = '';
                        if (response.length > 0) {
                            $table = `
                                    <div id="userList" class=" text-center" style="overflow-x: auto;">
                                    <table class="table table-striped table-hover rounded">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                            response.forEach(user => {
                                $table += `<tr>
                                            <td>
                                                <a href="${userDetailRoute.replace(':id', user.id)}" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                                    ${user.name}
                                                </a>
                                            </td>
                                            <td>${user.email}</td>
                                            <td>`;
                                if (user.role == 'student') {
                                    $table +=
                                        `<span class="badge bg-secondary">${user.role}</span>`;
                                } else if (user.role == 'teacher') {
                                    $table +=
                                        `<span class="badge bg-info">${user.role}</span>`;
                                } else {
                                    $table +=
                                        `<span class="badge bg-warning">${user.role}</span>`;
                                };
                                $table += `</td>
                                            <td>`;
                                if (user.role == 'student') {
                                    $table += `<div class="btn-group" role="group">
                                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa-solid fa-user"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="${userRoleRoute.replace(':id', user.id).replace(':role', 'teacher')}">Teacher</a></li>
                                                                            <li><a class="dropdown-item" href="${userRoleRoute.replace(':id', user.id).replace(':role', 'admin')}">Admin</a></li>
                                                                        </ul>
                                                                    </div>`;
                                } else if (user.role == 'teacher') {
                                    $table += `<div class="btn-group" role="group">
                                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <i class="fa-solid fa-chalkboard-user"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="${userRoleRoute.replace(':id', user.id).replace(':role', 'student')}">Student</a></li>
                                                                            <li><a class="dropdown-item" href="${userRoleRoute.replace(':id', user.id).replace(':role', 'admin')}">Admin</a></li>
                                                                        </ul>
                                                                    </div>`;
                                } else {
                                    $table += `<button type="button" class="btn btn-outline-secondary">
                                                                            <i class="fa-solid fa-user-tie"></i>
                                                                    </button>`;
                                };

                                if (user.account_status == 'active') {
                                    $table += `<a href="${userStatusRoute.replace(':id', user.id).replace(':status', 'suspend')}" type="button" class="btn btn-outline-info" onclick="return confirm('Are you sure, ban this account?')">
                                                                            <i class="fa-solid fa-lightbulb"></i>
                                                                        </a>`;
                                } else {
                                    $table += `<a href="${userStatusRoute.replace(':id', user.id).replace(':status', 'suspend')}" type="button" class="btn btn-outline-warning">
                                                                            <i class="fa-solid fa-ban"></i>
                                                                        </a>`;
                                }

                                if (user.id != {{ Auth::id() }}) {
                                    $table += `<a href="${userDeleteRoute.replace(':id', user.id)}" type="button" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                        </a>`;
                                }
                                $table += `</td>
                                        </tr>`;
                            });
                            $table += ` </tbody>
                                     </table>`;
                        } else {
                            $table = 'no user';
                        }

                        $('#userList').html($table);
                    }
                });
            });
        });
    </script>
@endsection
