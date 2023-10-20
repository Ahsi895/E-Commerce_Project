@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-left">
        <a href="/CartList" class="btn btn-primary">Back</a><br><br>
    </div>
    <h1>Proceed to Payment</h1>

    <h2>User Information</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        @if(isset($user))
        <tbody>
           
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->address }}</td>
                </tr>
            
        </tbody>
        @else
        <p>No user data available.</p>
        @endif
    </table>

    <h2>Selected Products</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartProducts as $cartProduct)
                <tr>
                    <td>{{ $cartProduct->product->pro_name }}</td>
                    <td>${{ $cartProduct->product->price }}</td>
                    <td>{{ $cartProduct->product->details }}</td>
                    <td>
                        <img src="{{ asset($cartProduct->product->image) }}" alt="{{ $cartProduct->product->pro_name }}" style="width: 100px; height: 100px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table><br>
    <div class="container">
        <h1>Available Payment Methods</h1>
        <div class="row">
            
    
            <div class="col-md-4">
                <div class="card" onclick="toggleSelection(this)">
                    <div class="card-body">
                        <h5 class="card-title">Cash on Delivery</h5>
                        <p class="card-text">Pay when your order arrives.</p>
                        <button class="btn btn-primary">Select</button>
                    </div>
                </div>
            </div>
            
            <style>
                .selected-card {
                    border: 2px solid blue;
                }
            </style>
            
            <script>
                function toggleSelection(card) {
                    card.classList.toggle('selected-card');
                }
            </script>
            
        </div><br>
        <div >
            @php
                $total = 0;
            @endphp
        
            @foreach($cartProducts as $item)
                @php
                    $total += $item->product->price;
                @endphp
            @endforeach
        
                <h3 name="total">Total Amount: ${{ $total }}</h3>
                
            </div>
    
            <div class="text-center mt-4">
                <form id="confirmOrderForm" method="post" action="{{ route('saveOrder') }}">
                    @csrf
                    <input type="hidden" name="total" value="{{ $total }}">
                    <input type="hidden" name="address" value="{{ $user->address }}">
                    <button type="submit" class="btn btn-success" id="confirmOrderButton">Confirm Order</button>
                </form>
            </div>
    </div>
    
</div>
@endsection
