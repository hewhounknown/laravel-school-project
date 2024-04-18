@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="mt-3">Dashboard</h3>

    <div class="row mb-2">
        <div class="col-sm-4">
            <a href="{{ route('users.manage') }}" class="card m-3 p-3 link-underline link-underline-opacity-0 text-warning">
                <div class="card-body">
                    <div class="media d-flex justify-content-between">
                        <div class="align-self-center text-left">
                            <i class="fa-solid fa-user-tie fa-2x"></i>
                        </div>
                        <div class="align-self-center text-right">
                            <h3>{{ count($admins) }}</h3>
                            <span>Admins</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('users.manage') }}" class="card m-3 p-3 link-underline link-underline-opacity-0 text-primary">
                <div class="card-body">
                    <div class="media d-flex justify-content-between">
                        <div class="align-self-center text-left">
                            <i class="fa-solid fa-chalkboard-user fa-2x"></i>
                        </div>
                        <div class="align-self-center text-right">
                            <h3>{{ count($teachers) }}</h3>
                            <span>Teachers</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('users.manage') }}" class="card m-3 p-3 link-underline link-underline-opacity-0 text-success">
                <div class="card-body">
                    <div class="media d-flex justify-content-between">
                        <div class="align-self-center text-left">
                            <i class="fa-solid fa-users fa-2x"></i>
                        </div>
                        <div class="align-self-center text-right">
                            <h3>{{ count($students) }}</h3>
                            <span>Students</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mb-2">
        @foreach ($programs as $program)
            <div class="col-sm-6">
                <a href="{{ route('admin.courses.manage') }}"
                    class="card m-3 p-3 link-underline link-underline-opacity-0 text-info-emphasis">
                    <div class="card-body">
                        <div class="media d-flex justify-content-between">
                            <div class="align-self-center text-left">
                                <i class="fa-solid fa-folder-open fa-2x"></i>
                                <span class="fs-4">{{ $program->name }}</span>
                                <div class="mt-2">
                                    @foreach ($program->categories as $category)
                                        <span class="badge text-bg-secondary">{{ $category->category_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="align-self-center text-right">
                                <h3>
                                    @php
                                        $totalCourses = 0;
                                        foreach ($program->categories as $category) {
                                            $totalCourses += $category->courses->count();
                                        }
                                        echo $totalCourses;
                                    @endphp
                                </h3>
                                <span>Courses</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row mb-2">
        <div class="col-12">
            <a href="{{ route('library.manage') }}"
                class="card m-3 p-3 link-underline link-underline-opacity-0 text-info-emphasis">
                <div class="card-body">
                    <div class="media d-flex justify-content-between">
                        <div class="align-self-center text-left">
                            <h3>{{ count($books) }}</h3>
                            <span>Books</span>
                        </div>
                        <div class="align-self-center text-right">
                            <span class="fs-4">Library</span>
                            <i class="fa-solid fa-book"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
