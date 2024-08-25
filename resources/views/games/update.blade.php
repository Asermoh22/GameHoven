@extends('layout')

@section('title')
    Edit Game : {{$game->name}}
@endsection

@section('content')

<link rel="stylesheet" href="{{ url('css/form.css') }}">

<h1 style="position: relative; top :40px; left :20px">  Edit Game : {{$game->name}}
</h1>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="formm"> 
    <div class="content">    <form action="{{route('games.edit',$game->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Name :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name"  value="{{$game->name}}">
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description : </label>
            <textarea class="form-control" id="exampleInputPassword1" name="desc" rows="3" >{{$game->desc}}</textarea>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Price :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="price"  value="{{$game->price}}">
        </div>
        <div class="mb-3">
            <label for="formFileSm" class="form-label">Upload Image :</label>
            <input class="form-control form-control-sm" id="formFileSm" type="file" name='img'>
          </div>
        <button type="submit" class="btn btn-danger">Edit Game</button>
    </form>
</div>
</div>

@endsection
