@extends('school.layout.app')

@section('content')
    <div class="card m-5 shadow-sm position-relative">
        @if (Auth::user()->account_status == 'suspend')
        <div class="alert alert-danger align-items-center" role="alert">
            <i class="fa-solid fa-triangle-exclamation"></i> This account is suspended!!
        </div>
        @endif
        <div class="row p-2">
            <div class="col-sm-4 text-center">
                @if (Auth::user()->image != null)
                <img src="{{asset('storage/uploads/'.Auth::user()->image)}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                @else
                <img src="{{asset('img/default.png')}}" class="rounded-circle img-fluid" style="width: 180px; height: 180px;" alt="">
                @endif
            </div>
            <div class="col-sm-8 p-2 mt-2 fs-5">
                <div>
                    @if (Auth::user()->role == 'student')
                        <h3> {{Auth::user()->name}} | <i class="fa-solid fa-user"></i> </h3>
                    @elseif (Auth::user()->role == 'teacher')
                        <h3> {{Auth::user()->name}} | <i class="fa-solid fa-chalkboard-user"></i> </h3>
                    @else
                        <h3> {{Auth::user()->name}} | <i class="fa-solid fa-user-tie"></i> </h3>
                    @endif
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>  <small>{{Auth::user()->email}}</small>
                </div>
                <div>
                    @if (Auth::user()->address != null)
                    <i class="fa-solid fa-location-dot"></i> <small>{{Auth::user()->address}}</small>
                    @endif
                </div>
                <div>
                    @if (Auth::user()->phone != null)
                    <i class="fa-solid fa-mobile"></i> <small>{{Auth::user()->phone}}</small>
                    @endif
                </div>
            </div>
        </div>
        <span class="position-absolute top-0 end-0" style="width: auto;">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#controlModal">
                <i class="fa-solid fa-bars fa-xl"></i>
            </button>
        </span>

        {{-- control modal start --}}
        <div class="modal fade" id="controlModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Control</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="row justify-content-between p-2">

                </div>
                </div>
                {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
            </div>
        </div>

        {{-- control modal end --}}
    </div>

    @yield('section')
@endsection
