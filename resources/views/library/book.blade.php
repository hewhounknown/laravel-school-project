@extends('layout.app')

@section('title', 'book')

@section('content')
    <div class="container mt-3">

        <object data='{{asset('file/f2.pdf')}}'
        type='application/pdf'
        width='100%'
        height='700px'>

    </div>

@endsection
