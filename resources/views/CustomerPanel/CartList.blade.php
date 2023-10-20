@extends('layouts.app')

@section('content')
<body style="background-color: aliceblue">
    
    
    <div class="container" style="background-color: rgb(255, 255, 255); padding: 20px;">
        <div class="text-left">
            <a href="/" class="btn btn-primary">Back</a><br><br>
        </div>
        <h1>Your Cart</h1>
        <table id="cart-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $item)
                <tr>
                <td>{{ $item->pro_name }}</td>
                <td>${{ $item->price }}</td>
                <td>{{ $item->details }}</td>
                <td>
                    <img src="{{ asset($item->image) }}" alt="{{ $item->pro_name }}" style="width: 100px; height: 100px;">
                </td>
                <td>
                    <form action="{{ route('removeFromCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pro_id" value="{{ $item->pro_id }}">
                        <button class="btn btn-danger remove-from-cart" data-id="{{ $item->pro_id }}">Remove</button>
                    </form>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div >
    @php
        $totalAmount = 0;
    @endphp

    @foreach($products as $item)
        @php
            $totalAmount += $item->price;
        @endphp
    @endforeach

        <h3>Total Amount: ${{ $totalAmount }}</h3>
        <form action="{{ route('proceedToPayment') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
            <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </form>
    </div>
        @include('footer')
</div>

</body>
@endsection
