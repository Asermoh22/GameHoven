@extends('layout')

@section('title')
    All Categories
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/cat.css') }}">
    


<nav class="navbar navbar-light" style="background-color: rgb(39, 39, 39); height : 80px; position: fixed; width : 100% ; top : 0; z-index: 1000;">
    <div class="header">
        <i class="fa-solid fa-gamepad fa-bounce"></i>
        <h1>GameHoven</h1>
    </div>

    <h3 style="color: white; position: relative; left : 700px; top : 5px;">{{ Auth::user()->name }}</h3>

    <a class="navbar-brand" id="nav" style="color: white;">
        <a href="{{ route('auth.logout') }}" class="btn btn-danger" style="position: relative; right : 4px;">Logout</a>
    </a>
</nav>

@foreach ($categries as $item)

<h1 style="position: relative; top :100px">{{$item->namecate}}</h1>
    
@endforeach


@endsection

