@extends('layout')

@section('title')
    Add category
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/form.css') }}">

<h1  style="position: relative; top :40px; left :50px">New category</h1>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="formm"> 
    <div class="content">
            <form action="{{route('categories.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Name Of category :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="namecate" >
        </div>
      
        <button type="submit" class="btn btn-danger">Add category</button>
    </form>
</div>
</div>

@endsection
