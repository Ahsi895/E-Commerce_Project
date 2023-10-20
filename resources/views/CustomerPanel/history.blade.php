@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-left">
        <a href="/" class="btn btn-primary">Back</a><br><br>
    </div>
    <h1>Your Order History</h1>

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
            @foreach ($orderedProducts as $product)
                <tr>
                    <td>{{ $product->pro_name }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->details }}</td>
                    <td>
                        <img src="{{ asset($product->image) }}" alt="{{ $product->pro_name }}" style="width: 100px; height: 100px;">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
