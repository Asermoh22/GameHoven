@extends('layout')

@section('title')
    Register Form
@endsection

@section('content')
<div class="header">
  <i class="fa-solid fa-gamepad fa-bounce"></i>
  <h1>GameHoven</h1>
</div>
<link rel="stylesheet" href="{{ url('css/form.css') }}">

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif





<div class="formm"> 
  <div class="content">
     
<form action="{{route('auth.handelregister')}}" method="post">

  @csrf
  <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{old('name')}}">
        </div>
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{old('email')}}">
        <div id="emailHelp" class="form-text" style="color: #355e3b">We'll never share your email with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
     
      <button type="submit" class="btn btn-primary" style="background-color:#355e3b; border-color: #355e3b;">Sign Up</button>
    </form>
@endsection

