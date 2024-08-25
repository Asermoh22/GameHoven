@extends('layout')

@section('title')
    {{ $game->name }}
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/show.css') }}">

<nav class="navbar navbar-light" style="background-color: rgb(39, 39, 39); height : 80px; position: fixed; width : 100% ; top : 0; z-index: 1000;">
    <div class="header">
        <i class="fa-solid fa-gamepad fa-bounce"></i>
        <h1>GameHoven</h1>
    </div>

    <h3 style="color: white; position: relative; left : 620px; top : 5px;">{{ Auth::user()->name }}</h3>

    <div class="navbar-brand" id="nav" style="color: white;">
        @if(Auth::check() && Auth::user()->is_admin)
            <a href="{{ route('games.update', $game->id) }}" class="btn btn-danger" style="position: relative; left : 330px;">Update</a>
            <a href="{{ route('games.delete', $game->id) }}" class="btn btn-danger" style="position: relative; left : 335px;">Delete</a>
        @endif
    </div>


   <div>
    @if (Auth::check()&&Auth::user()->is_admin==0)
    <a href="{{route('cart.view')}}" class="btn btn-danger d-flex align-items-center" style="position: relative; right :15px">
        <h5 class="mb-0">View Cart</h5>
        <i class="fa-solid fa-cart-plus mx-2"></i>
        <div>
            <span>{{$cartCount}}</span>
        </div>
    </a>
    
    @endif
   
</div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('uploads/games/' . $game->img) }}" alt="{{ $game->name }}" class="img-fluid" style="width : 500px; height : 610px; position: relative; left : 70px; top :180px; border-radius: 4px;">
        </div>
        <div class="col-md-6">
            @foreach ($game->categories as $cat)
            <h3 style=" position :relative; top :125px; margin:0; padding :0; right :80px" >category : {{ $cat->namecate}}</h3> 
         @endforeach
            <h1 style="position: relative; left :-730px; top :80px">{{ $game->name }}</h1>
                        <p class="truncate-multiline">{{ $game->desc }}</p>
                        <h3 style="position: relative; left : 10px; top : 180px; color: white;" class="btn btn-dark">
                            price: <span style="color:white;">{{$game->price}}<span style="color: rgb(1, 96, 1);"> $</span></span>
                        </h3>
                        
                                </div>
    </div>
</div>
@if (Auth::check()&&Auth::user()->is_admin==0)

<form action="{{ route('cart.add', $game->id) }}" method="post" style="position: relative; top : 150px;">
    @csrf
    <button type="submit" class="btn btn-primary d-flex justify-content-between align-items-center" style="width : 150px; height : 40px; position: relative; bottom : 20px; padding: 0 10px; left :1250px">
        Add to Cart 
        <i class="fa-solid fa-cart-plus" style="position: relative; right :7px"></i>

    </button>    </form>
    @endif

@if(Auth::check())
<form action="{{ route('comments.store', $game->id) }}" method="post">
    @csrf
    <div class="mb-3" style="position: relative; top :200px">
        <label for="comment" class="form-label" style="position: relative; left :700px">Comment:</label>
        <textarea class="form-control" id="comment" name="comment" rows="3" style="width : 500px; position: relative; left :700px"></textarea>
        <button type="submit" class="btn btn-danger" style=" position: relative; left :1250px; bottom :60px"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</form>
@endif
@if($comments)
    @foreach ($comments as $item)
        <div style="position: relative; left :700px; top : 200px; margin-bottom : 10px; padding: 10px; border-radius: 5px; background-color: #b8b8b8; border: 1px solid #ddd; width :500px; color:black">
            <h4>{{ $item->user->name }}</h4>
            <p>{{ $item->content }}</p>
            <small>Commented on: {{ $item->created_at->format('d M Y, H:i') }}</small>
            @if (Auth::user()->id == $item->user_id || Auth::user()->is_admin==1 )
                            <a href="{{route('comments.delete',$item->id)}}" class="btn btn-dark" style="position: relative; left :220px;"><i class="fa-solid fa-trash"></i></a>

            @endif
        </div>
    @endforeach
@else
    <p>No comments available.</p>
@endif



<style>
    .truncate-multiline {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 70; /* Adjust line count as needed */
        overflow: hidden;
        text-overflow: ellipsis;
        width : 100%;
        line-height: 2;
        position: relative;
        top : 130px;
        left :-80px;
    }
</style>
@endsection
