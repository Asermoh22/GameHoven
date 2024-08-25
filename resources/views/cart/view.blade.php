@extends('layout')

@section('title')
Your Cart 
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/index.css') }}">


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

@if (session('success'))
    <div class="alert alert-success" style="position: relative; top :95px">
        {{ session('success') }}
    </div>
@endif





 
<div class="container" style="position: relative; top :150px">
    <h1 style="color: black">Your Cart</h1>
    
    @if(session('cart') && count(session('cart')) > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Game</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                    <th>Total</th>


                </tr>
            </thead>
            <tbody>
                @php
                $grandTotal = 0;
            @endphp
            
            @foreach(session('cart') as $id => $item)
                @php
                    $itemTotal = $item['quantity'] * $item['price'];
                    $grandTotal += $itemTotal;
                @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ isset($item['price']) ? $item['price'] : 'Price not available' }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                    <td>{{ $itemTotal }}</td>
                </tr>
            @endforeach
            
            <tr>
                <td colspan="4" style="text-align : right;"><strong>Total Payment:</strong></td>
                <td>{{ $grandTotal }}</td>
            </tr>

            </tbody>
        </table>
        <a href="{{ route('games.index') }}" class="btn btn-primary">Continue Shopping</a>
        <a href="{{ route('cart.buy') }}" class="btn btn-danger" 
        onclick="return confirm('Are you sure you want to proceed with the purchase?');">
        Confirm Buy
     </a>
    @else
        <p>Your cart is empty.</p>
        <a href="{{ route('games.index') }}" class="btn btn-primary">Browse Games</a>
    @endif
</div>


@endsection
