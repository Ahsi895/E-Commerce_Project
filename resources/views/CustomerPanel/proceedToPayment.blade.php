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
                <th>Quantity</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        @if(count($products) > 0)
            @foreach($products as $item)
                        <tr>
                            <td>{{ $item->pro_name }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->details }}</td>
                            <td>
                                <img src="{{ asset($item->image) }}" alt="{{ $item->pro_name }}" style="width: 100px; height: 100px;">
                            </td>
                        </tr>
                    @endforeach
                @endif
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
            @if(count($products) > 0)
                @php
                    $totalAmount = 0;
                    $totalQuantity = 0;
                @endphp

                @foreach($products as $product)
                    @php
                        $subTotal = $product->price * $product->quantity;
                        $totalAmount += $subTotal;
                        $totalQuantity += $product->quantity;
                    @endphp
                @endforeach

            @endif
                <h3>Total Quantity: {{ $totalQuantity }}</h3>
                <h3 name="total">Total Amount: ${{ $totalAmount }}</h3>
                @if(session()->has('coupon'))
                <h3>Coupoun: {{ session('coupon.name') }}</h3>
                <h3>Discount: -{{ session()->get('coupon')['discount'] }}</h3>
                <h3>New Total: {{ session('coupon.newTotal') }}</h3>
                @endif
            
                
            </div>
            <a href="#" class="have-code">Have a Code?</a>
        <div class="have-code-container">
            <form method="POST" action="{{ route('coupon.store') }}">
                @csrf
                <input type="text" name="coupon_code" id="coupon_code">
                <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
                <button type="submit" class="button button-plain">Apply</button>
            </form>
        </div>
    
            <div class="text-center mt-4">
                <form id="confirmOrderForm" method="post" action="{{ route('saveOrder') }}">
                    @csrf
                    <input type="hidden" name="totalAmount" value="{{ session('coupon.newTotal') }}">
                    <input type="hidden" name="address" value="{{ $user->address }}">
                    <button type="submit" class="btn btn-success" id="confirmOrderButton">Confirm Order</button>
                </form>
            </div>
    </div>
    
</div>
@endsection
