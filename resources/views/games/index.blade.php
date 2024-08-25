@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ url('css/index.css') }}">

<nav class="navbar navbar-light" style="background-color: rgb(39, 39, 39); height : 80px; position: fixed; width : 100% ; top : 0; z-index: 1000;">
    <div class="header">
        <i class="fa-solid fa-gamepad fa-bounce"></i>
        <h1>GameHoven</h1>
    </div>

    @if (Auth::user()->is_admin == 1)
    <a href="{{ route('games.create') }}" class="nav-link add-game-link" style="position: relative; left : -100px; top : 9px;">Add Game</a>
    <a href="{{ route('categories.create') }}" class="nav-link add-game-link" style="position: relative; left : -260px; top : 9px;">Add Category</a>
    <h3 style="color: white; position: relative; left : 350px; top : 5px;">{{ Auth::user()->name }}</h3>
@else
    <h3 style="color: white; position: relative; left : 700px; top : 5px;">{{ Auth::user()->name }}</h3>
@endif
   
   


    <a class="navbar-brand" id="nav" style="color: white;">
        <a href="{{ route('auth.logout') }}" class="btn btn-danger" style="position: relative; right : 4px;">Logout</a>
    </a>

   
</nav>

<h1 id="rr" style="position: relative; top :110px; left :20px;">Most Viewed</h1>
<div class="container" style="padding-top : 130px;">
    <div class="row d-flex flex-wrap" style="margin-top : 15px;">
        @foreach ($games as $item)
        <div class="col-md-3 mb-4">
            <a href="{{route('games.show', $item->id)}}" style="text-decoration: none; color: inherit;">
               
                <div class="card" style="width : 20rem; margin-left : 15px; margin-right :5px">
                  
                    <img src="{{ asset('uploads/games/' . $item->img) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <h3 id="rr" class="card-title">{{$item->price}} <span style="color: rgb(1, 91, 1)" > $ </span> </h3>

                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<hr>

<h1 id="rr" style="position: relative; left :20px ; top :40px">Last Added</h1>

<div class="container" style="padding-top : 80px;">
    <div class="row d-flex flex-wrap" style="margin-top : 15px;">
        @if ($mostviewd && $mostviewd->isNotEmpty())
            @foreach ($mostviewd as $item)
            <div class="col-md-3 mb-4">
                <a href="{{route('games.show', $item->id)}}" style="text-decoration: none; color: inherit;">
                   
                    <div class="card" style="width : 20rem; margin-left : 15px; margin-right :5px">
                        <img src="{{ asset('uploads/games/' . $item->img) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <h3 id="rr" class="card-title">{{$item->price}} <span style="color: rgb(1, 91, 1)" > $ </span> </h3>

                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            <p>No most viewed games found.</p>
        @endif
    </div>
</div>
@endsection
