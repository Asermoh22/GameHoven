@extends('layout')

@section('title')
    Login Form
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
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    <p>{{ session('error') }}</p>
</div>
@endif

<div class="formm"> 
    <div class="content">
        <form action="{{ route('auth.handellogin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{ old('email') }}" style="width : 350px;">
                <div id="emailHelp" class="form-text" style="color: #355e3b">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password" style="width : 350px;">
            </div>
            <br>
            <a href="{{ route('users.redirectgoog') }}" class="btn btn-dark" ><i class="fa-brands fa-google" style="color: #355e3b;;"></i>  Sign Up With Google</a>
            
            <a href="{{route('auth.register')}}" class="btn btn-danger"> Create Account</a>
            <br>

            <button type="submit" class="btn btn-primary" style="position: relative ; top :10px; background-color:#355e3b; border-color: #355e3b;" >Sign in</button>
        </form>
    </div>
</div>
@endsection
