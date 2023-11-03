@include('layouts.app')

<h3 style="padding: 20px">Your Cart List</h3>
<table id="cart-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($abandonedCartProducts as $abandonedCartProduct)
        <tr>
            <td>{{ $abandonedCartProduct['product']->pro_name }}</td>
            <td>${{ $abandonedCartProduct['product']->price }}</td>
            <td>{{ $abandonedCartProduct['quantity'] }}</td>
            <td>{{ $abandonedCartProduct['product']->details }}</td>
            <td>
                <img src="{{ asset($abandonedCartProduct['product']->image) }}" alt="{{ $abandonedCartProduct['product']->pro_name }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
            </td>
            <td>
                <form action="{{ route('removeFromAbandonedCart') }}" method="GET">
                    @csrf
                    <input type="hidden" name="pro_id" value="{{ $abandonedCartProduct['product']->pro_id }}">
                    <button class="btn btn-danger btn-sm remove-from-cart">Remove</button>
                </form>
            </td>
    </tr>
@endforeach

    </tbody>
</table>
<div style="padding: 20px">
    @if(count($abandonedCartProducts) > 0)
        @php
            $totalAmount = 0;
        @endphp

        @foreach($abandonedCartProducts as $abandonedCartProduct)
            @php
                $subTotal = $abandonedCartProduct['product']->price * $abandonedCartProduct['quantity'];
                $totalAmount += $subTotal;
            @endphp
        @endforeach

        
        <h3>Total Amount: ${{ $totalAmount }}</h3>
        <form action="{{ route('proceedToPayment') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
            <button type="submit" class="btn btn-primary">Proceed to Payment</button><br><br>
        </form>
    @endif
    

</div>
